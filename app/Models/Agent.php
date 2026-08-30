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
        'tracking_code',
        'registration_number',
        'status',
        'admin_comment',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(AgentDocument::class);
    }
}
