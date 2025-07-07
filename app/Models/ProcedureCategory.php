<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProcedureCategory extends Model
{
    protected $fillable = [
        'name',
        'business_id'
    ];

    public function procedures(): HasMany
    {
        return $this->hasMany(Procedures::class);
    }
}
