<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SegmentTypes extends Model
{

    protected $table = 'segment_types';
    protected $fillable = [
        'name',
        'id_segment',
    ];

}
