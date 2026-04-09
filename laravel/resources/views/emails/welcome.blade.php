<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Your Career Test</title>
    <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #3490dc;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Hello {{ $name }}!</h1>
    
    <p>Thank you for registering for the career test. Here are your details:</p>
    
    <ul>
        <li>Email: {{ $email }}</li>
        <li>Student ID: {{ $student_id }}</li>
    </ul>
    
    <p>Click the button below to start your test:</p>
    
    <a href="{{ $examlink }}" class="button">Start Career Test Now</a>
    
    <p>If you have any questions, please contact our support team.</p>
    
    <p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>