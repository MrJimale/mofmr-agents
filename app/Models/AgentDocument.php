<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AgentDocument extends Model
{
    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

    protected $fillable = [
        'agent_id',
        'document_type',
        'file_name',
        'file_path',
        'status',
        'officer_comment',
        'reviewed_at',
    ];


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [
        'reviewed_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | AGENT RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function agent(): BelongsTo
    {
        return $this->belongsTo(
            Agent::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | TEMPORARY FILE URL
    |--------------------------------------------------------------------------
    |
    | Documents are stored privately.
    |
    | This generates a temporary URL which expires after 30 minutes.
    |
    */

    public function getFileUrlAttribute(): ?string
    {
        if (!$this->file_path) {
            return null;
        }

        try {

            return Storage::disk('private')
                ->temporaryUrl(
                    $this->file_path,
                    now()->addMinutes(30)
                );

        } catch (\Throwable $e) {

            return null;

        }
    }
}
