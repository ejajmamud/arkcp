<?php
define('LARAVEL_TEST', true); // Prevent route interference

// Load minimal Laravel components
require __DIR__.'/../bootstrap/autoload.php';
$app = require __DIR__.'/../bootstrap/app.php';

// Test Student model directly
try {
    $student = new App\Models\Student();
    $sample = $student->first();
    
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'student' => $sample ? $sample->toArray() : null,
        'paths' => [
            'vendor' => realpath(__DIR__.'/../vendor'),
            'model' => realpath(__DIR__.'/../app/Models/Student.php')
        ]
    ], JSON_PRETTY_PRINT);
    
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage(),
        'trace' => $e->getTraceAsString()
    ], JSON_PRETTY_PRINT);
}