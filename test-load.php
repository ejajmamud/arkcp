<?php
require __DIR__.'/../index.php'; 

try {
    $student = new App\Models\Student();
    echo "✅ Student model loaded successfully!";
    echo "<pre>".print_r($student->first(), true)."</pre>";
} catch (Exception $e) {
    echo "❌ Error: ".$e->getMessage();
}
