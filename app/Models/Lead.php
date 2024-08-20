<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'text',
        'status_id',
    ];
}
