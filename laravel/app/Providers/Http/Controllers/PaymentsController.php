<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;



class PaymentController extends Controller
{
    public function charge($studentId)
    {
        // Retrieve the student record
        $student = Student::findOrFail($studentId);
        Log::channel('payments')->info('Payment initiated', ['student_id' => $student->id]);

        // Generate the payment reference
        $reference = 'CPTEST-' . $student->id . '-' . time();

        // Call the HitPay API to create the payment request
        $response = Http::asForm()
            ->withHeaders([
                'X-BUSINESS-API-KEY' => config('app.hit_api'),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Requested-With' => 'XMLHttpRequest'
            ])
            ->post('https://api.sandbox.hit-pay.com/v1/payment-requests', [
                'amount' => 37.00,
                'currency' => 'MYR',
                'reference_number' => $reference,
                'redirect_url' => route('payment.callback'),
                'webhook' => route('payment.webhook'),
                'name' => "{$student->firstname} {$student->lastname}",
                'email' => $student->email,
            ]);

        // Log the response from HitPay to check if it's correct
        Log::channel('payments')->info('HitPay Response:', $response->json());

        // Check if the response is successful and contains a payment URL
        if ($response->successful() && isset($response->json()['url'])) {
            Log::channel('payments')->info('Payment request created', [
                'student_id' => $student->id,
                'payment_url' => $response->json()['url']
            ]);
            return redirect($response->json()['url']);
        }

        // If the request failed, log the error and redirect to the failed page
        Log::channel('payments')->error('Payment request failed', [
            'student_id' => $student->id,
            'response' => $response->json()
        ]);
        return redirect()->route('payment.failed');
    }

    public function callback(Request $request)
    {
        // Regenerate the session to prevent session fixation
        $request->session()->regenerate();
        Log::channel('payments')->info('Callback received', $request->all());

        // Check if payment was successful
        $status = $request->input('status');
        $paymentId = $request->input('reference');

        if ($status === 'completed') {
            return DB::transaction(function () use ($paymentId, $request) {
                // Retrieve student record based on payment ID
                $student = Student::where('payment_id', $paymentId)->first();

                if (!$student) {
                    // If student not found, fetch payment details and try to retrieve student based on reference
                    $paymentRequest = $this->getPaymentRequest($paymentId);
                    $reference = $paymentRequest['reference_number'] ?? null;
                    $studentId = $reference ? explode('-', $reference)[1] : null;
                    $student = $studentId ? Student::find($studentId) : null;
                }

                if ($student) {
                    // Update student payment status and send email
                    $this->completePayment($student, $paymentId);
                    $request->session()->put([
                        'payment_student_id' => $student->id,
                        'payment_verified' => true
                    ]);
                    return redirect()->route('payment.success');
                }

                return redirect()->route('payment.failed');
            });
        }

        return redirect()->route('payment.failed');
    }

    public function webhook(Request $request)
    {
        // Log webhook data
        Log::channel('payments')->info('Webhook received', $request->all());

        if (!$this->verifySignature($request)) {
            Log::channel('payments')->error('Invalid signature');
            return response('Invalid signature', 403);
        }

        // If payment is successful, process payment
        if ($request->input('status') === 'completed') {
            return DB::transaction(function () use ($request) {
                $paymentId = $request->input('id');
                $reference = $request->input('reference_number');
                
                // Retrieve student based on payment ID or reference
                $student = Student::where('payment_id', $paymentId)
                    ->orWhere(function($query) use ($reference) {
                        $studentId = explode('-', $reference)[1] ?? null;
                        $query->where('id', $studentId);
                    })
                    ->first();

                if ($student) {
                    // Complete payment for the student
                    $this->completePayment($student, $paymentId);
                    return response('Webhook processed', 200);
                }

                return response('Student not found', 404);
            });
        }

        return response('Payment not completed', 400);
    }

    private function getPaymentRequest($paymentId)
    {
        return Http::withHeaders([
            'X-BUSINESS-API-KEY' => config('app.hit_api'),
            'Accept' => 'application/json'
        ])->get("https://api.sandbox.hit-pay.com/v1/payment-requests/{$paymentId}")
          ->throw()
          ->json();
    }

    private function completePayment($student, $paymentId)
{
    try {
        // Update payment status in the database
        $student->update([
            'payment_status' => 'completed',
            'payment_id' => $paymentId,
            'paid_at' => now()
        ]);

        // Generate the test URL with an expiration of 30 minutes
       $testUrl = URL::temporarySignedRoute('test', now()->addMinutes(30), [
    'uid' => $student->uniqueid
]);

// Debug the generated URL
\Log::info('Generated test URL', [
    'url' => $testUrl,
    'components' => [
        'base' => config('app.url'),
        'path' => 'test',
        'params' => [
            'uid' => $student->uniqueid,
            'expires' => now()->addMinutes(30)->timestamp,
            'signature' => null // Will be generated by Laravel
        ]
    ]
]);   
        
        
        Log::info('Generated Test URL: ' . $testUrl);

        // Send the welcome email
        Mail::to($student->email)->send(new WelcomeMail([
            'name' => $student->firstname,
            'email' => $student->email,
            'examlink' => $testUrl,
            'student_id' => $student->id
        ]));

        Log::info('Email sent successfully', [
            'student_id' => $student->id,
            'email' => $student->email
        ]);
    } catch (\Exception $e) {
        Log::error('Failed to send email', [
            'error' => $e->getMessage(),
            'student_id' => $student->id
        ]);
        return redirect()->route('payment.failed');
    }
}


    private function verifySignature($request)
    {
        $generatedSignature = hash_hmac('sha256', $request->getContent(), config('app.hitpay_salt'));
        return hash_equals($generatedSignature, $request->header('X-HitPay-Signature'));
    }

    public function success()
    {
        // Retrieve student from session
        $studentId = session('payment_student_id', auth()->id());
        $student = Student::find($studentId);

        if (!$student) {
            Log::error('Student not found during success page redirection');
            return redirect()->route('payment.failed');
        }

        // Ensure payment status is completed
        if ($student->payment_status !== 'completed') {
            Log::warning('Payment not completed but reached success page', [
                'student_id' => $student->id,
                'payment_status' => $student->payment_status
            ]);
            return redirect()->route('payment.failed');
        }

        return view('payment.success', compact('student'));
    }

    public function failed()
    {
        return view('payment.failed');
    }

    public function verifyPayment($studentId)
    {
        $student = Student::find($studentId);
        
        if (!$student) {
            return response()->json([
                'verified' => false,
                'message' => 'Student not found'
            ], 404);
        }

        return response()->json([
            'verified' => $student->payment_status === 'completed',
            'payment_id' => $student->payment_id,
            'paid_at' => $student->paid_at
        ]);
    }
}
