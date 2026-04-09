@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4>Complete Payment</h4>
                </div>

                <div class="card-body">
                    <div class="alert alert-info">
                        <strong>Student:</strong> {{ $student->firstname }} {{ $student->lastname }}<br>
                        <strong>Amount Due:</strong> RM{{ number_format($amount, 2) }}
                    </div>

                    <form action="{{ route('payment.process') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" name="student_id" value="{{ $student->id }}">

                        <div class="form-group mb-4">
                            <label>Payment Method</label>
                            <select name="payment_method" class="form-select" required>
                                @foreach($payment_methods as $method)
                                    <option value="{{ $method }}">{{ ucfirst($method) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Payment Gateway Elements Will Appear Here -->
                        <div id="payment-elements" class="mb-4"></div>

                        <button type="submit" class="btn btn-primary w-100 py-3">
                            Pay RM{{ number_format($amount, 2) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add your payment gateway JS here -->
@endsection