<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAgentController extends Controller
{
    // ========================================================================
    // ADMIN DASHBOARD
    // ========================================================================

    public function dashboard()
    {
        $total = Agent::count();

        $pending = Agent::where('status', 'pending')->count();

        $approved = Agent::where('status', 'approved')->count();

        $denied = Agent::where('status', 'denied')->count();

        $correction = Agent::where(
            'status',
            'correction_required'
        )->count();

        $agents = Agent::latest()
            ->take(10)
            ->get();

        return view(
            'admin.dashboard',
            compact(
                'total',
                'pending',
                'approved',
                'denied',
                'correction',
                'agents'
            )
        );
    }


    // ========================================================================
    // ALL APPLICATIONS
    // ========================================================================

    public function index()
    {
        $agents = Agent::latest()->get();

        return view(
            'admin.agents',
            compact('agents')
        );
    }


    // ========================================================================
    // VIEW / REVIEW APPLICATION
    // ========================================================================

    public function show(Agent $agent)
    {
        /*
        |--------------------------------------------------------------------------
        | Load submitted documents
        |--------------------------------------------------------------------------
        */

        $agent->load('documents');


        /*
        |--------------------------------------------------------------------------
        | GENERATE TEMPORARY PHOTO URL
        |--------------------------------------------------------------------------
        |
        | The photo remains private.
        |
        | The generated URL expires after 30 minutes.
        |
        */

        if ($agent->photo) {

            try {

                $agent->photo_url = Storage::disk('private')
                    ->temporaryUrl(
                        $agent->photo,
                        now()->addMinutes(30)
                    );

            } catch (\Throwable $e) {

                $agent->photo_url = null;
            }

        } else {

            $agent->photo_url = null;
        }


        /*
        |--------------------------------------------------------------------------
        | GENERATE TEMPORARY DOCUMENT URLS
        |--------------------------------------------------------------------------
        |
        | Every document receives its own temporary URL.
        |
        */

        foreach ($agent->documents as $document) {

            if (!$document->file_path) {

                $document->file_url = null;

                continue;
            }


            try {

                $document->file_url = Storage::disk('private')
                    ->temporaryUrl(
                        $document->file_path,
                        now()->addMinutes(30)
                    );

            } catch (\Throwable $e) {

                $document->file_url = null;
            }
        }


        /*
        |--------------------------------------------------------------------------
        | SEND APPLICATION TO REVIEW PAGE
        |--------------------------------------------------------------------------
        */

        return view(
            'admin.review',
            compact('agent')
        );
    }


    // ========================================================================
    // APPROVE APPLICATION
    // ========================================================================

    public function approve(Agent $agent)
    {
        $agent->status = 'approved';


        /*
        |--------------------------------------------------------------------------
        | GENERATE REGISTRATION NUMBER
        |--------------------------------------------------------------------------
        */

        $agent->registration_number =
            'MFMR-' .
            date('Y') .
            '-' .
            str_pad(
                $agent->id,
                5,
                '0',
                STR_PAD_LEFT
            );


        /*
        |--------------------------------------------------------------------------
        | APPROVAL DATE
        |--------------------------------------------------------------------------
        */

        $agent->approved_at = now();


        /*
        |--------------------------------------------------------------------------
        | CLEAR PREVIOUS ADMIN COMMENT
        |--------------------------------------------------------------------------
        */

        $agent->admin_comment = null;


        $agent->save();


        return redirect()
            ->route(
                'admin.agents.show',
                $agent
            )
            ->with(
                'success',
                'Agent approved successfully.'
            );
    }


    // ========================================================================
    // SEND APPLICATION BACK FOR CORRECTION
    // ========================================================================

    public function sendBack(
        Request $request,
        Agent $agent
    ) {

        $request->validate([
            'comment' => 'nullable|string|max:5000',
        ]);


        $agent->status = 'correction_required';

        $agent->admin_comment =
            $request->comment;

        $agent->save();


        return redirect()
            ->route(
                'admin.agents.show',
                $agent
            )
            ->with(
                'success',
                'Application sent back for correction.'
            );
    }


    // ========================================================================
    // DENY APPLICATION
    // ========================================================================

    public function deny(
        Request $request,
        Agent $agent
    ) {

        $request->validate([
            'comment' => 'nullable|string|max:5000',
        ]);


        $agent->status = 'denied';

        $agent->admin_comment =
            $request->comment;

        $agent->save();


        return redirect()
            ->route(
                'admin.agents.show',
                $agent
            )
            ->with(
                'success',
                'Application denied.'
            );
    }


    // ========================================================================
    // APPROVED AGENTS
    // ========================================================================

    public function approved()
    {
        $agents = Agent::where(
            'status',
            'approved'
        )
            ->latest()
            ->get();


        return view(
            'admin.approved',
            compact('agents')
        );
    }


    // ========================================================================
    // PRINT CERTIFICATE
    // ========================================================================

    public function certificate(Agent $agent)
    {
        return view(
            'print.certificate',
            compact('agent')
        );
    }


    // ========================================================================
    // PRINT ID CARD
    // ========================================================================

    public function idCard(Agent $agent)
    {
        /*
        |--------------------------------------------------------------------------
        | TEMPORARY PHOTO URL FOR ID CARD
        |--------------------------------------------------------------------------
        */

        $photoUrl = null;


        if ($agent->photo) {

            try {

                $photoUrl = Storage::disk('private')
                    ->temporaryUrl(
                        $agent->photo,
                        now()->addMinutes(30)
                    );

            } catch (\Throwable $e) {

                $photoUrl = null;
            }
        }


        return view(
            'print.id-card',
            compact(
                'agent',
                'photoUrl'
            )
        );
    }
}
