<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class RegistrationController extends Controller
{
    /**
     * Show the registration form.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('registration');
    }

    /**
     * Handle the registration and grant immediate test access (FREE).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric|min:10|max:80',
            'gender' => 'required',
            'stgroup' => 'required',
            'country' => 'required',
            'state' => 'required',
            'consent' => 'accepted',
            'test_lang' => 'nullable|string|in:en,malay', // Validation to ensure 'en' or 'my'
        ]);


        // Check if the student already exists
        $existingStudent = Student::where('email', $request->email)->first();

        if ($existingStudent) {
            // If the email exists, show an error
            return back()->withErrors(['email' => 'The email has already been taken.']);
        }

        // Create a new student record with payment status as completed (FREE ACCESS)
        // Default language is 'en' if not provided
        $student = Student::create([
            'email' => $request->email,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'age' => $request->age,
            'gender' => $request->gender,
            'stgroup' => $request->stgroup,
            'country' => $request->country,
            'state' => $request->state,
            'payment_status' => 'completed', // Set payment status to completed (FREE)
            'payment_id' => 'FREE-' . time(), // Mark as free registration
            'paid_at' => now(), // Set paid timestamp
            'payment_amount' => 0.00, // Free
            'payment_currency' => 'MYR',
            'student_id' => substr(str_shuffle(str_repeat("0123456789", 5)), 0, 5),
            'uniqueid' => substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 5)), 0, 5),
            // Get 'test_lang' from the form or default to 'en'
            'test_lang' => $request->test_lang ?? 'en',  // Default to 'en' if not selected
        ]);

        // Generate test URL
        $testUrl = URL::temporarySignedRoute('test', now()->addMinutes(30), [
            'uid' => $student->uniqueid,
            'email' => $student->email,
            'lang' => $student->test_lang
        ]);

        // Send welcome email with test link
        try {
            Mail::to($student->email)->send(new WelcomeMail([
                'name' => $student->firstname,
                'email' => $student->email,
                'examlink' => $testUrl,
                'student_id' => $student->id
            ]));

            \Log::info('Welcome email sent for free registration', [
                'student_id' => $student->id,
                'email' => $student->email
            ]);
        } catch (\Exception $e) {
            \Log::error('Failed to send welcome email', [
                'error' => $e->getMessage(),
                'student_id' => $student->id
            ]);
        }

        // Store test link in session and redirect to success page
        $request->session()->put([
            'payment_student_id' => $student->id,
            'payment_verified' => true,
            'test_link' => $testUrl
        ]);

        return redirect($testUrl);
    }
}
