<?php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Clear Laravel caches
$app->make('Illuminate\Contracts\Console\Kernel')->call('cache:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('view:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('route:clear');
$app->make('Illuminate\Contracts\Console\Kernel')->call('config:clear');

// Manually rebuild autoload
$loader = require __DIR__.'/../vendor/autoload.php';
$loader->setPsr4('App\\', __DIR__.'/../app');
$loader->setPsr4('App\\Models\\', __DIR__.'/../app/Models');

// Ensure Student model is loaded
require_once __DIR__.'/../app/Models/Student.php';
class_alias('App\Models\Student', 'App\Student');

echo "Autoload refreshed successfully!<br>";
echo "Student model: ".(class_exists('App\Models\Student') ? 'Loaded' : 'Not loaded');