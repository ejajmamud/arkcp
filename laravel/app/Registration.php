<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'email', 'country', 'state'
    ];
}
