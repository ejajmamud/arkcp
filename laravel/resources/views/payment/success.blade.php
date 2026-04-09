@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 50px;"> <!-- Added 50px margin top -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Payment Success</div>
                <div class="card-body text-center">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle fa-3x mb-3"></i>
                        <h4>Thank you for your payment!</h4>
                        <p>Your payment has been successfully processed.</p>
                        <p>Current Date: {{ now()->format('d M Y') }}</p> <!-- Added current date display -->
                    </div>

                    @if(isset($student) && $student)
                        <div class="payment-details mt-4">
                            <h5>Payment Details</h5>
                            <p>Transaction ID: {{ $student->payment_id ?? 'N/A' }}</p>
                            <p>Date: {{ $student->paid_at ? $student->paid_at->format('d M Y H:i') : now()->format('d M Y H:i') }}</p> <!-- Updated to show current date if paid_at is null -->
                            <p>Amount: RM 37.00</p>
                        </div>

                        <div class="student-info mt-4">
                            <h5>Student Information</h5>
                            <p>ID: {{ $student->student_id ?? 'N/A' }}</p>
                            <p>Name: {{ $student->firstname }} {{ $student->lastname }}</p>
                        </div>

                        @if($student->payment_status === 'completed')
                            <!-- Start Test Button -->
                            @if(session('test_link'))
                                <a href="{{ session('test_link') }}" class="btn btn-primary mt-4" id="startTestBtn">
                                    Start Your Career Test
                                </a>
                            @else
                                <div class="alert alert-warning mt-4">
                                    <p>Test link not available. Please check your email for the access link.</p>
                                </div>
                            @endif
                        @else
                            <div class="alert alert-warning mt-4">
                                <p>Your payment is still processing. Please try again shortly.</p>
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning mt-4">
                            <p>We could not find your student record. Please contact support.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($student) && $student)
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startBtn = document.getElementById('startTestBtn');
        
        if (startBtn) {
            // Initially disable the button if test link is not available
            startBtn.classList.add('disabled');
            
            // Verify payment status using the API
            fetch('{{ route("payment.verify", $student->id) }}')
                .then(response => response.json())
                .then(data => {
                    if (!data.verified) {
                        // If payment is not verified, redirect to the failed page
                        window.location.href = "{{ route('payment.failed') }}";
                    } else {
                        // If payment is verified, enable the button
                        startBtn.classList.remove('disabled');
                    }
                })
                .catch(error => {
                    console.error('Verification error:', error);
                    // Optionally redirect to failed page or show error
                });
        }
    });
</script>
@endif

@endsection