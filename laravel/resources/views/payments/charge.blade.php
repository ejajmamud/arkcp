<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charge Page</title>
</head>
<body>
    <h1>Payment for Student: {{ $student->name }}</h1>

    <p>Payment Status: {{ $student->payment_status }}</p>

    <p><strong>Amount Due: RM {{ $student->payment_amount }}</strong></p>

    <!-- You can add more details or payment options here -->

    <!-- For example, displaying a "Pay Now" button -->
    @if($student->payment_status == 'approved')
        <a href="{{ url('/payment/checkout/' . $student->id) }}" class="btn btn-primary">Proceed to Payment</a>
    @else
        <p>Your payment was not approved. Please try again.</p>
    @endif
</body>
</html>
