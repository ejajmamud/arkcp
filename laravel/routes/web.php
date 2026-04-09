<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminDashboardController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/test-route', function () {
    return 'Route is working!';
});

// Temporary route to test
Route::get('/test-db', function () {
    return App\Models\Student::first();
});
Route::get('/debug-payment/{id}', function ($id) {
    $student = App\Models\Student::find($id);

    if (!$student) {
        return response()->json([
            'error' => true,
            'message' => "Student with ID {$id} not found",
            'database_records' => App\Models\Student::count()
        ], 404);
    }

    return [
        'student_exists' => true,
        'student_id' => $id,
        'payment_status' => $student->payment_status,
        'email' => $student->email
    ];
});
// ==================== PUBLIC ROUTES ====================

// Main Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about');
Route::get('/faqs', [App\Http\Controllers\FaqsController::class, 'index'])->name('faqs');
Route::get('/howitworks', [App\Http\Controllers\HowitworksController::class, 'index'])->name('howitworks');
Route::get('/pricing', [App\Http\Controllers\PricingController::class, 'index'])->name('pricing');
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog-post', [App\Http\Controllers\BlogsingleController::class, 'index'])->name('blogsingle');


// Contact Routes
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'ContactUsForm'])->name('contactsubmit');

// Legal Pages
Route::view('/terms-and-conditions', 'termsandconditions')->name('terms');
Route::view('/privacy-policy', 'privacypolicy')->name('privacy');
Route::view('/disclaimer', 'disclaimer')->name('disclaimer');

// ==================== AUTHENTICATION ====================
Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

// ==================== REGISTRATION ====================


Route::post('/register', [RegistrationController::class, 'store'])->name('registration.store');
Route::get('/register', 'RegistrationController@index')->name('registration.index');
Route::post('/register', 'RegistrationController@store')->name('registration.store');

// ==================== Ejaj-Mw ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/charge/{student}', [PaymentController::class, 'charge']);
    // Other payment routes
});


// ==================== PAYMENT SYSTEM ====================
// Payment routes
Route::middleware(['throttle:60,1'])->group(function () {
    Route::get('/payment/charge/{id}', [PaymentController::class, 'charge'])
        ->name('payment.charge');

    Route::get('/payment/callback', [PaymentController::class, 'callback'])
        ->name('payment.callback')
        ->withoutMiddleware(['csrf']);

    Route::post('/payment/webhook', [PaymentController::class, 'webhook'])
        ->name('payment.webhook')
        ->withoutMiddleware(['csrf']);

    Route::get('/payment/success', [PaymentController::class, 'success'])
        ->name('payment.success');

    Route::get('/payment/failed', [PaymentController::class, 'failed'])
        ->name('payment.failed');

    Route::get('/payment/verify/{student}', [PaymentController::class, 'verifyPayment'])
        ->name('payment.verify');
});

// Route::get('/charge/{student}', [PaymentController::class, 'charge'])->name('payment.charge');
// Route::post('/process-payment', [PaymentController::class, 'processPayment'])
//     ->name('payment.process');
// Route::get('/payment/success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
// Route::get('/payment/failed', [PaymentController::class, 'paymentFailed'])->name('payment.failed');
// Route::post('/paypal/gateway', [PaymentController::class, 'paypalGateway'])->name('payment.paypal');
// ==================== TEST SYSTEM ====================
// Specific routes MUST come before parametric routes
Route::post('/test/submit', [TestController::class, 'store'])->name('test.submit');
Route::get('/test/success', [TestController::class, 'testSuccess'])->name('test.success');
Route::get('/download/pdf/{id}', [TestController::class, 'downloadPDF'])->name('download.pdf');

// Parametric route for taking the test
Route::get('/test/{uid}', [TestController::class, 'index'])->name('test');

// Temporary test route
Route::get('/test-verify', function (Request $request) {
    return [
        'url' => $request->fullUrl(),
        'valid' => $request->hasValidSignature(),
    ];
});

Route::get('/generate-signed-test-url/{id}', function ($id) {
    $student = Student::findOrFail($id);

    $url = URL::temporarySignedRoute('test', now()->addHours(24), [
        'uid' => $student->uniqueid,
        'email' => $student->email,
        'lang' => $student->test_lang
    ]);

    return response()->json([
        'signed_url' => $url
    ]);
});

Route::get('/server-time', function () {
    return [
        'now' => now(),
        'timestamp' => now()->timestamp,
        'server_time' => date('Y-m-d H:i:s'),
    ];
});




Route::get('/debug-paths', function () {
    return [
        'controller_path' => realpath(app_path('Http/Controllers/TestController.php')),
        'model_path' => realpath(app_path('Models/Student.php')),
        'loaded_model' => class_exists(\App\Models\Student::class) ? 'Yes' : 'No',
        'wrong_model' => class_exists(\App\Student::class) ? 'Yes' : 'No'
    ];
});

Route::get('/test-model-load', function () {
    try {
        $student = \App\Models\Student::first();
        return response()->json([
            'status' => 'success',
            'student' => $student,
            'model_path' => (new ReflectionClass(\App\Models\Student::class))->getFileName()
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 500);
    }
});


Route::get('/generate-test-url', function () {
    $student = Student::first();
    if (!$student) {
        return "No students found in database";
    }

    $url = URL::temporarySignedRoute(
        'test',
        now()->addHours(24),
        ['uid' => $student->uniqueid]
    );

    return "<a href='" . $url . "'>Test Link</a><br><br>" . $url;
});

Route::get('/test-model-loading', function () {
    try {
        $student = \App\Models\Student::first();
        return response()->json([
            'status' => 'success',
            'student' => $student
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
            'trace' => $e->getTrace()
        ], 500);
    }
});


Route::get('/verify-model', function () {
    return [
        'model_path' => class_exists('App\Models\Student') ?
            (new ReflectionClass('App\Models\Student'))->getFileName() : 'Not found',
        'wrong_model' => class_exists('App\Student') ? 'Exists' : 'Does not exist',
        'autoload_files' => include base_path('vendor/composer/autoload_files.php')
    ];
});

// clear cache

Route::get('/clear-cache', function () {
    \Artisan::call('cache:clear');
    \Artisan::call('view:clear');
    \Artisan::call('config:clear');
    \Artisan::call('route:clear');
    return "Cache Cleared!";

    // Refresh autoloader
    $output = [];
    $result = null;
    exec('cd ' . __DIR__ . ' && /opt/cpanel/composer/bin/php /opt/cpanel/composer/bin/composer dump-autoload -o', $output, $result);

    return response()->json([
        'status' => $result === 0 ? 'success' : 'error',
        'output' => $output,
        'model_exists' => class_exists('App\Models\Student') ? 'Yes' : 'No',
        'wrong_model' => class_exists('App\Student') ? 'Yes' : 'No'
    ]);
});

Route::get('/storage-link', function () {
    \Artisan::call('storage:link');


    // Refresh autoloader
    $output = \Artisan::output();

    return response()->json([
        'output' => $output,
    ]);
});

Route::get('/test-email', function () {
    $email = 'ejajjoy3@gmail.com';  // Replace with a known valid email address

    try {
        Mail::to($email)->send(new \App\Mail\WelcomeMail([
            'name' => 'Test User',
            'examlink' => 'https://example.com/test-link',
            'student_id' => 36907,
            'email' => $email
        ]));

        return 'Email Sent!';
    } catch (\Exception $e) {
        Log::error('Failed to send email', ['error' => $e->getMessage()]);
        return 'Failed to send email';
    }
});

// Routes moved up to line 120-125


// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('admin.users');
    Route::get('/payments', [App\Http\Controllers\PaymentsController::class, 'index'])->name('admin.payments');

    // Questions
    Route::get('/questions', [App\Http\Controllers\QuestionsController::class, 'index'])->name('admin.questions');
    Route::post('/questions', [App\Http\Controllers\QuestionsController::class, 'store']);
    Route::delete('/questions/{id}', [App\Http\Controllers\QuestionsController::class, 'destroy']);
    Route::get('/questions/edit/{id}', [App\Http\Controllers\QuestionseditController::class, 'index'])->name('admin.questions.edit');
    Route::post('/questions/update/{id}', [App\Http\Controllers\QuestionseditController::class, 'store']);

    // Reports
    Route::get('/reports/{id}', [App\Http\Controllers\ReportsController::class, 'index'])->name('admin.reports');
    Route::post('/reports/by-range', [App\Http\Controllers\ReportsController::class, 'getByRange'])->name('admin.reports.range');

    // CMS
    Route::get('/cms', [App\Http\Controllers\CmshomeController::class, 'index'])->name('admin.cms');
    Route::post('/banner/save', [App\Http\Controllers\CmshomeController::class, 'store'])->name('admin.banner.save');

    // Settings
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('admin.settings');
    Route::post('/settings/update', [App\Http\Controllers\SettingsController::class, 'store'])->name('admin.settings.update');
    Route::post('/fee/update', [App\Http\Controllers\SettingsController::class, 'storefee'])->name('admin.fee.update');
});




// ==================== USER DASHBOARD ====================
Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', [App\Http\Controllers\UserController::class, 'index'])->name('user.dashboard');
});

// ==================== CATCH-ALL ROUTE ====================
Route::any('{any}', function () {
    abort(404);
})->where('any', '.*');
Route::get('/simple-test', function () {
    return 'Success';
});
