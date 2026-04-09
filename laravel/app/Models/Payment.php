<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id', 'amount', 'payment_status', 'student_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
