<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'region',
        'city',
        'country',
        'photo',
        'status',
        'admin_comment',
        'registration_number',
        'approved_at',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}