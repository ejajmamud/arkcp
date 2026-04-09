<?php
// Verify files exist
$required = [
    'vendor/autoload.php',
    'app/Models/Student.php'
];

foreach ($required as $file) {
    if (!file_exists(__DIR__.'/../'.$file)) {
        die("Missing file: $file");
    }
}

// Load Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Clear caches
$app->make('Illuminate\Contracts\Console\Kernel')->call('cache:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('view:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('route:clear');

// Force load Student model
require_once __DIR__.'/../app/Models/Student.php';
class_alias('App\Models\Student', 'App\Student');

echo "System recovered successfully!<br>";
echo "Student model: ".(class_exists('App\Models\Student') ? 'LOADED' : 'MISSING');