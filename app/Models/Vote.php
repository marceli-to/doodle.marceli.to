<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'name',
        'trip_types',
        'periods',
    ];

    protected $casts = [
        'trip_types' => 'array',
        'periods' => 'array',
    ];
}
