<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Failed</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .error-icon {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
            background-color: #e74c3c; /* Red circle */
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white; /* White cross */
            font-size: 50px; /* Larger cross size */
        }

        .error-text {
            font-size: 36px;
            font-weight: 500;
            color: #333;
            margin-bottom: 15px;
        }

        .message {
            font-size: 16px;
            color: #666;
            margin-bottom: 25px;
        }

        .retry-btn {
            background-color: #e74c3c;
            color: white;
            padding: 12px 30px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .retry-btn:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Cross icon with red circle and white cross -->
        <div class="error-icon">
            <span>&#10060;</span> <!-- White cross inside a red circle -->
        </div>
        <div class="error-text">Payment Failed</div>
        <div class="message">
            Unfortunately, your payment was not successful. Please try again.
        </div>

        <!-- Retry button -->
        @if(isset($student) && $student->id)
            <a href="{{ route('payment.charge', ['id' => $student->id]) }}" class="retry-btn">Try Again</a>
        @else
            <p>Please contact support if you need further assistance.</p>
        @endif
    </div>
</body>
</html>
