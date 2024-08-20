<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    const STATUS_NEW = 'Новый';
    const STATUS_AT_WORK = 'В работе';
    const STATUS_COMPLETED = 'Завершен';

    public static $statuses = [
        self::STATUS_NEW,
        self::STATUS_AT_WORK,
        self::STATUS_COMPLETED,
    ];
}
