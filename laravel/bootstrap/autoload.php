<?php
// Simple autoloader for core classes
spl_autoload_register(function ($class) {
    // Base directory for the application namespace
    $base_dir = __DIR__.'/../app/';
    
    // Replace namespace separator with directory separator
    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
    
    // If the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

// Manually load required Laravel files
require __DIR__.'/../vendor/illuminate/support/helpers.php';
require __DIR__.'/../vendor/illuminate/container/Container.php';

// Explicitly load your Student model
require_once __DIR__.'/../app/Models/Student.php';
class_alias('App\Models\Student', 'App\Student');