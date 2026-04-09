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
        $student = Student::findOrFail($studentId);
        Log::channel('payments')->info('Payment initiated', ['student_id' => $student->id]);

        $reference = 'CPTEST-' . $student->id . '-' . time();

        $response = Http::asForm()
            ->withHeaders([
                'X-BUSINESS-API-KEY' => config('app.hit_api'),
                'Content-Type' => 'application/x-www-form-urlencoded',
                'X-Requested-With' => 'XMLHttpRequest'
            ])
            ->post('https://api.hit-pay.com/v1/payment-requests', [
                'amount' => 37.00,
                'currency' => 'MYR',
                'reference_number' => $reference,
                'redirect_url' => route('payment.callback'),
                'webhook' => route('payment.webhook'),
                'name' => "{$student->firstname} {$student->lastname}",
                'email' => $student->email,
            ]);

        Log::channel('payments')->info('HitPay Response:', $response->json());

        if ($response->successful() && isset($response->json()['url'])) {
            return redirect($response->json()['url']);
        }

        Log::channel('payments')->error('Payment request failed', [
            'student_id' => $student->id,
            'response' => $response->json()
        ]);

        return redirect()->route('payment.failed');
    }

    public function callback(Request $request)
    {
        $request->session()->regenerate();
        Log::channel('payments')->info('Callback received', $request->all());

        $status = $request->input('status');
        $paymentId = $request->input('reference');

        if ($status === 'completed') {
            return DB::transaction(function () use ($paymentId, $request) {
                $student = Student::where('payment_id', $paymentId)->first();

                if (!$student) {
                    $paymentRequest = $this->getPaymentRequest($paymentId);
                    $reference = $paymentRequest['reference_number'] ?? null;
                    $studentId = $reference ? explode('-', $reference)[1] : null;
                    $student = $studentId ? Student::find($studentId) : null;
                }

                if ($student) {
                    $this->completePayment($student, $paymentId);
                    $request->session()->put([
                        'payment_student_id' => $student->id,
                        'payment_verified' => true,
                        'test_link' => URL::temporarySignedRoute('test', now()->addMinutes(30), [
                            'uid' => $student->uniqueid,
                            'email' => $student->email,
                            'lang' => $student->test_lang
                        ])
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
        Log::channel('payments')->info('Webhook received', $request->all());

        if (!$this->verifySignature($request)) {
            Log::channel('payments')->error('Invalid signature');
            return response('Invalid signature', 403);
        }

        if ($request->input('status') === 'completed') {
            return DB::transaction(function () use ($request) {
                $paymentId = $request->input('id');
                $reference = $request->input('reference_number');

                $student = Student::where('payment_id', $paymentId)
                    ->orWhere(function ($query) use ($reference) {
                        $studentId = explode('-', $reference)[1] ?? null;
                        $query->where('id', $studentId);
                    })
                    ->first();

                if ($student) {
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
        ])
        ->get("https://api.hit-pay.com/v1/payment-requests/{$paymentId}")
        ->throw()
        ->json();
    }

    private function completePayment($student, $paymentId)
    {
        try {
            $student->update([
                'payment_status' => 'completed',
                'payment_id' => $paymentId,
                'paid_at' => now()
            ]);

            $testUrl = URL::temporarySignedRoute('test', now()->addMinutes(30), [
                'uid' => $student->uniqueid,
                'email' => $student->email,
                'lang' => $student->test_lang
            ]);

            \Log::info('Generated test URL', [
                'url' => $testUrl,
                'student_id' => $student->id,
                'email' => $student->email
            ]);

            Mail::to($student->email)->send(new WelcomeMail([
                'name' => $student->firstname,
                'email' => $student->email,
                'examlink' => $testUrl,
                'student_id' => $student->id
            ]));

            \Log::info('Welcome email sent', [
                'student_id' => $student->id,
                'email' => $student->email
            ]);

        } catch (\Exception $e) {
            \Log::error('Failed to send email or generate test URL', [
                'error' => $e->getMessage(),
                'student_id' => $student->id
            ]);
        }
    }

    private function verifySignature($request)
    {
        $generatedSignature = hash_hmac('sha256', $request->getContent(), config('app.hitpay_salt'));
        return hash_equals($generatedSignature, $request->header('X-HitPay-Signature'));
    }

    public function success()
    {
        $studentId = session('payment_student_id', auth()->id());
        $student = Student::find($studentId);
        $testLink = session('test_link');

        if (!$student || $student->payment_status !== 'completed') {
            Log::error('Invalid success state', [
                'student_id' => $studentId
            ]);
            return redirect()->route('payment.failed');
        }

        return view('payment.success', compact('student', 'testLink'));
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
