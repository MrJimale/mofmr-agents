<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AgentDocument extends Model
{
    /*
    |--------------------------------------------------------------------------
    | DATABASE TABLE
    |--------------------------------------------------------------------------
    |
    | The existing migration creates the table as "documents".
    | Laravel would normally look for "agent_documents" because
    | this model is called AgentDocument.
    |
    */

    protected $table = 'documents';


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
    | TEMPORARY PRIVATE FILE URL
    |--------------------------------------------------------------------------
    |
    | Documents are stored privately.
    |
    | The generated URL expires after 30 minutes.
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
