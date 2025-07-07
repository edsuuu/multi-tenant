<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price_monthly',
        'price_quarterly',
        'price_yearly',
        'features',
        'trial_days',
        'active'
    ];

    protected $casts = [
        'features' => 'array',
        'active' => 'boolean',
    ];
}
