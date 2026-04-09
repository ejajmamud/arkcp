@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Processing Payment</div>
                <div class="card-body text-center">
                    <p>Redirecting to secure payment gateway...</p>
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    
                    <form id="hitpayForm" action="{{ $hitpayUrl }}" enctype="application/x-www-form-urlencoded" method="POST">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="currency" value="{{ $currency }}">
                        <input type="hidden" name="reference_number" value="{{ $reference }}">
                        <input type="hidden" name="redirect_url" value="{{ $redirectUrl }}">
                        <input type="hidden" name="webhook" value="{{ $webhookUrl }}">
                        <input type="hidden" name="name" value="{{ $student->firstname }} {{ $student->lastname }}">
                        <input type="hidden" name="email" value="{{ $student->email }}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Submit the payment form automatically to hitpay
    document.getElementById('hitpayForm').submit();
</script>
@endsection
