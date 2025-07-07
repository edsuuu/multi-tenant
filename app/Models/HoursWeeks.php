<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HoursWeeks extends Model
{
    protected $table = 'hours_weeks';

    protected $fillable = [
        'day',
        'active',
        'start_time',
        'closing_time',
        'business_id',
    ];
}
