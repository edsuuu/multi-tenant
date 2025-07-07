<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
class Business extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'business';

    protected $fillable = [
        'name',
        'user_id',
        'segment_id',
        'documents',
        'address',
        'number_address',
        'city',
        'state',
        'zip',
        'photo',
        'referral_source',
        'neighborhood',
        'document_type',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segments::class);
    }

    public function hoursWeeks(): HasMany
    {
        return $this->hasMany(HoursWeeks::class);
    }
    public function products(): HasMany
    {
        return $this->hasMany(Products::class);
    }
}
