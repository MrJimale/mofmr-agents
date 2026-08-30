/* ========================================================================
   FILE 1
   app/Models/Agent.php
   ======================================================================== */

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Agent extends Model
{
    /*
    |--------------------------------------------------------------------------
    | MASS ASSIGNMENT
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    |
    | This is important.
    |
    | approved_at is converted into a Carbon datetime object so that
    | the Blade page can safely use:
    |
    | $agent->approved_at->format(...)
    |
    */

    protected $casts = [

        'approved_at' => 'datetime',

    ];


    /*
    |--------------------------------------------------------------------------
    | DOCUMENTS
    |--------------------------------------------------------------------------
    */

    public function documents(): HasMany
    {
        return $this->hasMany(
            AgentDocument::class
        );
    }
}


/* ========================================================================
   FILE 2
   resources/views/admin/review.blade.php

   IMPORTANT:
   Replace ONLY the "PROCESSED APPLICATION" section in your existing
   review.blade.php with the section below.
   ======================================================================== */


{{-- =========================================================
     PROCESSED APPLICATION
========================================================= --}}

@else

    <div class="alert alert-secondary mb-0">

        {{-- STATUS --}}

        <div class="fw-semibold mb-2">

            This application has already been processed.

        </div>


        {{-- CURRENT STATUS --}}

        <div>

            Status:

            <strong>

                {{ ucfirst(
                    str_replace(
                        '_',
                        ' ',
                        $agent->status
                    )
                ) }}

            </strong>

        </div>


        {{-- ADMIN COMMENT --}}

        @if($agent->admin_comment)

            <hr>

            <div class="fw-semibold">

                Administrative Comment:

            </div>

            <div class="mt-1">

                {{ $agent->admin_comment }}

            </div>

        @endif


        {{-- REGISTRATION NUMBER --}}

        @if($agent->registration_number)

            <hr>

            <div>

                Registration Number:

                <strong>

                    {{ $agent->registration_number }}

                </strong>

            </div>

        @endif


        {{-- APPROVAL DATE --}}

        @if($agent->approved_at)

            <hr>

            <div>

                Approved:

                <strong>

                    {{ $agent->approved_at->format('d F Y, h:i A') }}

                </strong>

            </div>

        @endif


        {{-- APPROVED ACTIONS --}}

        @if($agent->status === 'approved')

            <hr>

            <div class="d-flex gap-2 flex-wrap">

                {{-- CERTIFICATE --}}

                <a
                    href="{{ route('admin.certificate', $agent) }}"
                    target="_blank"
                    class="btn btn-sm btn-outline-primary"
                >
                    Print Certificate
                </a>


                {{-- ID CARD --}}

                <a
                    href="{{ route('admin.id-card', $agent) }}"
                    target="_blank"
                    class="btn btn-sm btn-outline-success"
                >
                    Print ID Card
                </a>

            </div>

        @endif

    </div>

@endif
