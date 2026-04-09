<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = [
        'title', 'description', 'logo', 'favicon', 'gacode', 'feeamount'
    ];
}
