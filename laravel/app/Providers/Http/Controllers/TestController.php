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
    public function __construct(){
        if (!class_exists('App\Models\Student')) {
            require_once app_path('Models/Student.php');
            class_alias('App\Models\Student', 'App\Student');
        }
    }

    // Method to show the test page with questions
    public function index(Request $request, $uid)
    {
        if (!$request->hasValidSignature()) {
            abort(403, 'Invalid signature');
        }

        $student = \App\Models\Student::where('uniqueid', $uid)->firstOrFail();

        // Check if test already completed
        if ($student->isTestCompleted) {
            return view('test.index', ['questions' => null]);
        }

        // Get the language field name (e.g. 'questionen' for English or 'questionmalay' for Malay)
        $langField = 'question' . $student->test_lang;

        // Fetch questions from the database based on the selected language
        $questions = \App\Question::select([
            'id',
            $langField . ' as question_text', // Dynamically reference the language column
            'personalitytype'
        ])->orderBy('id')->get();

        return view('test', [
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
    
    // Debug: Log raw submission data
    \Log::info('Test submission data:', $request->all());

    // Initialize scores
    $personalityTypes = ["Artistic", "Conventional", "Enterprising", "Social", "Investigative", "Realistic"];
    $scores = array_fill_keys($personalityTypes, 0);

    // Process each answer
    if ($request->has('test')) {
        foreach ($request->test as $questionIndex => $answerData) {
            if (!isset($answerData['answer']) || $answerData['answer'] !== 'yes') {
                continue;
            }

            $type = $answerData['type'] ?? null;
            if ($type && in_array($type, $personalityTypes)) {
                $scores[$type]++;
            }
        }
    }

    // Convert to objects for sorting
    $scoreObjects = array_map(function($type, $value) {
        return (object)['name' => $type, 'value' => $value];
    }, array_keys($scores), $scores);

    // Sort by value descending
    usort($scoreObjects, function($a, $b) {
        return $b->value <=> $a->value;
    });

    // Debug: Log calculated scores
    \Log::info('Calculated scores:', $scoreObjects);

    $student->isTestCompleted = 1;
    $student->score = serialize($scoreObjects);
    $student->save();

    // Get top 3 personality types
    $topPersonalities = array_slice($scoreObjects, 0, 3);
    $occupations = [];

    foreach ($topPersonalities as $personality) {
        $occupations[$personality->name] = Occupations::where("personalitytype", $personality->name)->get();
    }

    // Generate and send report
    $this->success($student->student_id, $student->score, $student);

    return view("testsuccess.index", [
        "scores" => $scoreObjects,
        "user" => $student,
        'occupations' => $occupations
    ]);
}

    // Success method to generate report and send the email
    public function success($sid, $stscore, $student)
    {
        $scores = unserialize($stscore);
        $personalitytype = array_map(function($value) {
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
            'reportlink' => url('/downloadpdf/' . $student->id),
        ];

        // Send the email with the generated PDF report attached
        Mail::send('emails.report', $data, function($message) use ($data, $pdf) {
            $message->to($data["email"])
                    ->subject($data["title"])
                    ->attachData($pdf->output(), 'career-assessment-report.pdf');
        });
    }

    // Method to handle downloading the PDF report
    public function downloadPDF($id)
    {
        $student = Student::findOrFail($id);
        $scores = unserialize($student->score);

        $personalitytype = array_map(function($value) {
            return $value->name;
        }, $scores);

        $firstThreePersonalityType = array_slice($personalitytype, 0, 3);
        $occupations = [];

        foreach ($firstThreePersonalityType as $val) {
            $occupations[$val] = Occupations::where("personalitytype", $val)->get();
        }

        $pdf = PDF::loadView('downloadpdf', [
            'scores' => $scores,
            'user' => $student,
            'occupations' => $occupations
        ]);

        return $pdf->download($student->firstname . ' ' . $student->lastname . '-report.pdf');
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
}
