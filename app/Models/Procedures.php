<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Procedures extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'photo',
        'procedure_category_id',
        'business_id',
    ];


    public function category(): BelongsTo
    {
        return $this->belongsTo(ProcedureCategory::class, 'procedure_category_id');
    }

    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
