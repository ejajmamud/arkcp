<?php

namespace App\Models; // or App\ if in app/ folder

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Define the table associated with the model (if necessary)
    protected $table = 'students';

    // Specify the fillable fields
    protected $fillable = [
        'student_id',
        'uniqueid',
        'firstname',
        'lastname',
        'email',
        'payment_id',
        'payment_status',
        'test_lang',
        'age',
        'gender',
        'stgroup',
        'country',
        'state'
    ];

    /**
     * Fix for PHP 8.2 and Carbon 2 compatibility issue in Laravel 7.
     * Override asDateTime to handle the TypeError in setLastErrors.
     */
    protected function asDateTime($value)
    {
        if (is_string($value) && $value) {
            try {
                return parent::asDateTime($value);
            } catch (\TypeError $e) {
                // Return a Carbon instance without using createFromFormat
                return \Carbon\Carbon::parse($value);
            }
        }
        return parent::asDateTime($value);
    }
}