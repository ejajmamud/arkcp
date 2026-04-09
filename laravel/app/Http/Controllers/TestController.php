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
use Symfony\Component\Process\Process;

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
        $student = Student::where('uniqueid', $request->uniqueid)->firstOrFail();
        $sid = $student->student_id;

        // Initialize score for different personality types
        $score = [];
        $personalityTypes = ["Artistic", "Conventional", "Enterprising", "Social", "Investigative", "Realistic"];

        foreach ($personalityTypes as $type) {
            $score[] = (object) ['name' => $type, 'value' => 0];
        }

        // Process each answer
        foreach ($request->test as $typeArr) {
            foreach ($typeArr as $rArr) {
                if (!isset($rArr["answer"]) || $rArr["answer"] !== "yes") {
                    continue;
                }

                $index = array_search($rArr["type"], $personalityTypes);
                if ($index !== false) {
                    $score[$index]->value += 1;
                }
            }
        }

        usort($score, function ($a, $b) {
            return $b->value <=> $a->value;
        });

        $student->isTestCompleted = 1;
        $student->score = serialize($score);
        $student->save();

        // Get the top 3 personality types
        $firstThreePersonalityType = array_slice($score, 0, 3);
        $occupations = [];

        // Fetch occupations based on top personality types
        foreach ($firstThreePersonalityType as $val) {
            $occupations[$val->name] = Occupations::where("personalitytype", $val->name)->get();
        }

        // Send the success response with occupations
        // try {
        //     $this->success($sid, $student->score, $student);
        // } catch (\Exception $e) {
        //     \Log::error('Failed to process success actions (email/pdf): ' . $e->getMessage());
        // }

        return redirect()->route('test.success', ['uid' => $request->uniqueid]);
    }

    // Method to show the success page
    public function testSuccess(Request $request)
    {
        $uid = $request->uid;
        $student = Student::where('uniqueid', $uid)->firstOrFail();
        $scores = unserialize($student->score);

        $personalitytype = array_map(function ($value) {
            return $value->name;
        }, $scores);

        $firstThreePersonalityType = array_slice($personalitytype, 0, 3);
        $occupations = [];

        foreach ($firstThreePersonalityType as $val) {
            $occupations[$val] = Occupations::where("personalitytype", $val)->get();
        }

        return view("testsuccess.index", [
            "scores" => $scores,
            "user" => $student,
            'occupations' => $occupations
        ]);
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
            'defaultFont' => 'sans-serif',
            'isPhpEnabled' => true,
            'defaultPaperSize' => "a4"
        ]);

        $pdf = PDF::loadView('downloadpdf', [
            'scores' => $scores,
            'user' => $student,
            'occupations' => $occupations
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
            $pdfPath = $this->generateBrowserPdf($student->uniqueid);

            if ($pdfPath !== null && file_exists($pdfPath)) {
                \Log::info("Browser PDF generated successfully for Student ID: " . $id);
                return response()->download($pdfPath, $fileName)->deleteFileAfterSend(true);
            }

            // Fallback to DOMPDF if Chrome-based rendering is unavailable.
            PDF::setOptions([
                'dpi' => 150,
                'defaultFont' => 'sans-serif',
                'isPhpEnabled' => true,
                'defaultPaperSize' => "a4",
                'isRemoteEnabled' => false
            ]);

            $pdf = PDF::loadView('downloadpdf', [
                'scores' => $scores,
                'user' => $student,
                'occupations' => $occupations
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

    protected function generateBrowserPdf($uid)
    {
        $chromePath = $this->findChromeExecutable();

        if ($chromePath === null) {
            \Log::warning('Chrome executable not found. Falling back to DOMPDF.');
            return null;
        }

        $baseUrl = request()->getSchemeAndHttpHost();
        $previewUrl = $baseUrl . route('test.success', ['uid' => $uid, 'pdf_export' => 1], false);
        $outputPath = storage_path('app/' . uniqid('browser-report-', true) . '.pdf');

        $process = new Process([
            $chromePath,
            '--headless=new',
            '--disable-gpu',
            '--no-sandbox',
            '--disable-dev-shm-usage',
            '--run-all-compositor-stages-before-draw',
            '--virtual-time-budget=10000',
            '--print-to-pdf=' . $outputPath,
            '--print-to-pdf-no-header',
            $previewUrl,
        ]);

        $process->setTimeout(60);
        $process->run();

        if (!$process->isSuccessful() || !file_exists($outputPath)) {
            \Log::warning('Chrome PDF generation failed, falling back to DOMPDF.', [
                'output' => $process->getOutput(),
                'error_output' => $process->getErrorOutput(),
            ]);
            return null;
        }

        return $outputPath;
    }

    protected function findChromeExecutable()
    {
        $configuredBinary = env('BROWSER_PDF_BIN');
        if (!empty($configuredBinary) && file_exists($configuredBinary)) {
            return $configuredBinary;
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
