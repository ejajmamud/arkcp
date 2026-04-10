<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Question;
use App\Occupations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use PDF;

class TestController extends Controller
{
    // Constructor to ensure class exists
    public function __construct()
    {
        if (!class_exists('App\Models\Student')) {
            require_once app_path('Models/Student.php');
            class_alias('App\Models\Student', 'App\Student');
        }
    }

    // Method to show the test page with questions
    public function index(Request $request, $uid)
    {
        $student = \App\Models\Student::where('uniqueid', $uid)->firstOrFail();

        // Check if test already completed
        if ($student->isTestCompleted) {
            return view('test.index', ['questions' => null]);
        }

        // Get the language field name (e.g. 'questionen' for English or 'questionmalay' for Malay)
        $langField = 'question' . $student->test_lang;

        // Fetch questions from the database based on the selected language
        $questions = Question::select([
            'id',
            $langField . ' as question_text', // Dynamically reference the language column
            'personalitytype'
        ])->orderBy('id')->get();

        return view('test.index', [
            'student' => $student,
            'questions' => $questions,
            'uid' => $uid,
            'langField' => $langField
        ]);
    }

    // Method to store answers submitted by the user
    public function store(Request $request)
    {
        try {
            $student = Student::where('uniqueid', $request->uniqueid)->firstOrFail();

            // Initialize score for different personality types
            $score = [];
            $personalityTypes = ["Artistic", "Conventional", "Enterprising", "Social", "Investigative", "Realistic"];

            foreach ($personalityTypes as $type) {
                $score[] = (object) ['name' => $type, 'value' => 0];
            }

            foreach ($this->normalizeSubmittedAnswers((array) $request->input('test', [])) as $answerRow) {
                if (($answerRow["answer"] ?? null) !== "yes") {
                    continue;
                }

                $index = array_search($answerRow["type"] ?? null, $personalityTypes, true);
                if ($index !== false) {
                    $score[$index]->value += 1;
                }
            }

            usort($score, function ($a, $b) {
                return $b->value <=> $a->value;
            });

            $student->isTestCompleted = 1;
            $student->score = serialize($score);
            $student->save();

            return redirect('/test/success?uid=' . rawurlencode((string) $request->uniqueid));
        } catch (\Throwable $e) {
            \Log::error('Test submit failed', [
                'uid' => $request->uniqueid,
                'message' => $e->getMessage(),
            ]);

            return redirect('/test/success?uid=' . rawurlencode((string) $request->uniqueid));
        }
    }

    protected function normalizeSubmittedAnswers(array $submitted): array
    {
        $normalized = [];

        foreach ($submitted as $entry) {
            if (!is_array($entry)) {
                continue;
            }

            // Newer form shape: test[page][question][answer/type]
            if (array_key_exists('answer', $entry) || array_key_exists('type', $entry)) {
                $normalized[] = $entry;
                continue;
            }

            foreach ($entry as $nestedEntry) {
                if (is_array($nestedEntry) && (array_key_exists('answer', $nestedEntry) || array_key_exists('type', $nestedEntry))) {
                    $normalized[] = $nestedEntry;
                }
            }
        }

        return $normalized;
    }

    // Build the shared data used by the success preview page.
    protected function buildSuccessViewData(string $uid): array
    {
        $student = Student::where('uniqueid', $uid)->firstOrFail();
        $scores = @unserialize($student->score);

        if (!is_array($scores)) {
            $scores = [];
        }

        $personalitytype = array_map(function ($value) {
            return $value->name;
        }, $scores);

        $firstThreePersonalityType = array_slice($personalitytype, 0, 3);
        $occupations = [];

        foreach ($firstThreePersonalityType as $val) {
            $occupations[$val] = Occupations::where("personalitytype", $val)->get();
        }

        return [
            "scores" => $scores,
            "user" => $student,
            'occupations' => $occupations
        ];
    }

    // Method to show the success page
    public function testSuccess(Request $request)
    {
        $viewData = $this->buildSuccessViewData((string) $request->uid);
        $viewData['isHeadlessBrowserRender'] = $request->boolean('headless_browser');
        return view("testsuccess.index", $viewData);
    }

    // cPanel/PHP opcode caches can occasionally hold on to a stale class shape.
    // This keeps the success route working even if the server dispatches to __call.
    public function __call($method, $parameters)
    {
        if ($method === 'testSuccess') {
            $request = $parameters[0] ?? request();

            if (!$request instanceof Request) {
                $request = request();
            }

            return view("testsuccess.index", $this->buildSuccessViewData((string) $request->uid));
        }

        return parent::__call($method, $parameters);
    }

    // Success method to generate report and send the email
    public function success($sid, $stscore, $student)
    {
        $scores = unserialize($stscore);
        $personalitytype = array_map(function ($value) {
            return $value->name;
        }, $scores);

        $firstThreePersonalityType = array_slice($personalitytype, 0, 3);
        $occupations = [];

        // Fetch the occupations based on the top 3 personality types
        foreach ($firstThreePersonalityType as $val) {
            $occupations[$val] = Occupations::where("personalitytype", $val)->get();
        }

        // Generate the PDF report for the student
        PDF::setOptions([
            'dpi' => 150,
            'defaultFont' => 'Helvetica',
            'isPhpEnabled' => true,
            'defaultPaperSize' => "a4",
            'defaultMediaType' => 'print',
            'isHtml5ParserEnabled' => true,
            'isJavascriptEnabled' => false,
            'isRemoteEnabled' => false,
        ]);

        $pdf = PDF::loadView('testsuccess.index', [
            'scores' => $scores,
            'user' => $student,
            'occupations' => $occupations,
            'pdfMode' => true,
            'pdfAssetBaseUrl' => rtrim(request()->getSchemeAndHttpHost(), '/'),
        ]);

        // Prepare the email content
        $data = [
            'name' => $student->firstname,
            'email' => $student->email,
            'title' => "Test Report from Career Preference",
            'reportlink' => route('download.pdf', $student->id),
        ];

        // Send the email with the generated PDF report attached
        Mail::send('emails.report', $data, function ($message) use ($data, $pdf) {
            $message->to($data["email"])
                ->subject($data["title"])
                ->attachData($pdf->output(), 'career-assessment-report.pdf');
        });
    }

    // Method to handle downloading the PDF report
    public function downloadPDF($id)
    {
        try {
            @set_time_limit(120);
            @ini_set('memory_limit', '256M');
            \Log::info("Starting PDF generation for Student ID: " . $id);
            $student = Student::findOrFail($id);
            $scores = null;
            if (!empty($student->score)) {
                try {
                    $scores = @unserialize($student->score);
                } catch (\Throwable $e) {
                    \Log::warning("Unserialize failed for Student ID {$id}: " . $e->getMessage());
                    $scores = null;
                }
            }
            if (!is_array($scores)) {
                $defaultTypes = ["Artistic","Conventional","Enterprising","Social","Investigative","Realistic"];
                $scores = array_map(function($t){ return (object)['name'=>$t,'value'=>0]; }, $defaultTypes);
                \Log::info("Using default zeroed scores for Student ID: " . $id);
            }

            $personalitytype = array_map(function ($value) {
                return $value->name;
            }, $scores);

            $firstThreePersonalityType = array_slice($personalitytype, 0, 3);
            $occupations = [];

            foreach ($firstThreePersonalityType as $val) {
                $occupations[$val] = Occupations::where("personalitytype", $val)->get();
            }

            $fileName = str_replace(' ', '_', $student->firstname . '_' . $student->lastname) . '-report.pdf';

            // Headless browser rendering is not available on live server.
            // Use DomPDF fallback directly for consistent output.

            PDF::setOptions([
                'dpi' => 150,
                'defaultFont' => 'Helvetica',
                'isPhpEnabled' => true,
                'defaultPaperSize' => "a4",
                'defaultMediaType' => 'print',
                'isHtml5ParserEnabled' => true,
                'isJavascriptEnabled' => false,
                'isRemoteEnabled' => false
            ]);

            $pdf = PDF::loadView('testsuccess.index', [
                'scores' => $scores,
                'user' => $student,
                'occupations' => $occupations,
                'pdfMode' => true,
                'pdfAssetBaseUrl' => rtrim(request()->getSchemeAndHttpHost(), '/'),
            ]);

            \Log::info("PDF generated successfully for Student ID: " . $id);
            return $pdf->download($fileName);
        } catch (\Exception $e) {
            \Log::error("PDF Generation Failed for Student ID {$id}: " . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->view('errors.minimal', [
                'title' => 'Download Error',
                'code' => 500,
                'message' => 'Failed to generate PDF. Please try again later.'
            ], 500);
        }
    }

    // Method to verify if the signature in the URL is valid
    public function verifyManual(Request $request)
    {
        $url = $request->fullUrl();
        $valid = $request->hasValidSignature();

        return [
            'url' => $url,
            'valid' => $valid,
            'components' => [
                'expires' => $request->expires,
                'uid' => $request->uid,
                'signature' => $request->signature,
                'calculated' => $this->generateExpectedSignature($request)
            ],
            'app_key' => config('app.key')
        ];
    }

    // Helper method to generate the expected signature
    protected function generateExpectedSignature($request)
    {
        $url = $request->fullUrl();
        $key = config('app.key');
            return hash_hmac('sha256', $url, $key);
        }

    protected function generateBrowserPdfFromSuccessPage(string $uid, ?string $baseUrl = null): ?string
    {
        $browserBinary = $this->findHeadlessBrowserBinary();

        if ($browserBinary === null) {
            \Log::warning('No headless browser binary found for preview-faithful PDF generation.');
            return null;
        }

        $base = !empty($baseUrl) ? rtrim($baseUrl, '/') : rtrim(url('/'), '/');
        $previewUrl = $base . '/test/success?uid=' . rawurlencode($uid) . '&pdf_export=1&headless_browser=1';
        $outputPath = storage_path('app/' . uniqid('browser-report-', true) . '.pdf');

        $command = escapeshellarg($browserBinary)
            . ' --headless=new'
            . ' --disable-gpu'
            . ' --no-sandbox'
            . ' --disable-dev-shm-usage'
            . ' --ignore-certificate-errors'
            . ' --run-all-compositor-stages-before-draw'
            . ' --virtual-time-budget=12000'
            . ' --print-to-pdf=' . escapeshellarg($outputPath)
            . ' --print-to-pdf-no-header '
            . escapeshellarg($previewUrl)
            . ' 2>&1';

        $output = [];
        $exitCode = 0;
        exec($command, $output, $exitCode);

        if ($exitCode !== 0 || !file_exists($outputPath)) {
            \Log::warning('Headless browser PDF generation failed, using DomPDF fallback.', [
                'command' => $command,
                'exit_code' => $exitCode,
                'output' => implode("\n", $output),
            ]);
            return null;
        }

        return $outputPath;
    }

    protected function findHeadlessBrowserBinary(): ?string
    {
        $configuredPath = env('BROWSER_PDF_BIN');
        if (!empty($configuredPath) && file_exists($configuredPath)) {
            return $configuredPath;
        }

        $candidates = [
            'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files (x86)\\Google\\Chrome\\Application\\chrome.exe',
            'C:\\Program Files\\Microsoft\\Edge\\Application\\msedge.exe',
            'C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe',
            '/usr/bin/google-chrome',
            '/usr/bin/google-chrome-stable',
            '/usr/bin/chromium-browser',
            '/usr/bin/chromium',
            '/usr/bin/microsoft-edge',
            '/usr/bin/microsoft-edge-stable',
        ];

        foreach ($candidates as $candidate) {
            if (file_exists($candidate)) {
                return $candidate;
            }
        }

        return null;
    }
}
