<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminAgentController extends Controller
{
    // =========================
    // ADMIN DASHBOARD
    // =========================

    public function dashboard()
    {
        $total = Agent::count();

        $pending = Agent::where('status', 'pending')->count();

        $approved = Agent::where('status', 'approved')->count();

        $denied = Agent::where('status', 'denied')->count();

        $correction = Agent::where('status', 'correction_required')->count();

        $agents = Agent::latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'total',
            'pending',
            'approved',
            'denied',
            'correction',
            'agents'
        ));
    }


    // =========================
    // ALL APPLICATIONS
    // =========================

    public function index()
    {
        $agents = Agent::latest()->get();

        return view('admin.agents', compact('agents'));
    }


    // =========================
    // VIEW APPLICATION
    // =========================

    public function show(Agent $agent)
    {
        $agent->load('documents');

        return view('admin.review', compact('agent'));
    }


    // =========================
    // APPROVE
    // =========================

    public function approve(Agent $agent)
    {
        $agent->status = 'approved';

        $agent->registration_number =
            'MFMR-' .
            date('Y') .
            '-' .
            str_pad($agent->id, 5, '0', STR_PAD_LEFT);

        $agent->approved_at = now();

        $agent->admin_comment = null;

        $agent->save();

        return redirect()
            ->route('admin.agents.show', $agent)
            ->with(
                'success',
                'Agent approved successfully.'
            );
    }


    // =========================
    // SEND BACK FOR CORRECTION
    // =========================

    public function sendBack(
        Request $request,
        Agent $agent
    ) {
        $request->validate([
            'comment' => 'nullable|string|max:5000',
        ]);

        $agent->status = 'correction_required';

        $agent->admin_comment = $request->comment;

        $agent->save();

        return redirect()
            ->route('admin.agents.show', $agent)
            ->with(
                'success',
                'Application sent back for correction.'
            );
    }


    // =========================
    // DENY
    // =========================

    public function deny(
        Request $request,
        Agent $agent
    ) {
        $request->validate([
            'comment' => 'nullable|string|max:5000',
        ]);

        $agent->status = 'denied';

        $agent->admin_comment = $request->comment;

        $agent->save();

        return redirect()
            ->route('admin.agents.show', $agent)
            ->with(
                'success',
                'Application denied.'
            );
    }


    // =========================
    // APPROVED AGENTS
    // =========================

    public function approved()
    {
        $agents = Agent::where('status', 'approved')
            ->latest()
            ->get();

        return view(
            'admin.approved',
            compact('agents')
        );
    }


    // =========================
    // PRIVATE FILE URL
    // =========================

    private function temporaryFileUrl($path)
    {
        if (!$path) {
            return null;
        }

        try {

            return Storage::disk('private')->temporaryUrl(
                $path,
                now()->addMinutes(30)
            );

        } catch (\Throwable $e) {

            return null;

        }
    }


    // =========================
    // REVIEW APPLICATION
    // =========================

    private function prepareAgentFiles(Agent $agent)
    {
        /*
        |--------------------------------------------------------------------------
        | Agent Photo
        |--------------------------------------------------------------------------
        */

        $agent->photo_url = $this->temporaryFileUrl(
            $agent->photo
        );


        /*
        |--------------------------------------------------------------------------
        | Documents
        |--------------------------------------------------------------------------
        */

        foreach ($agent->documents as $document) {

            $document->file_url =
                $this->temporaryFileUrl(
                    $document->file_path
                );
        }

        return $agent;
    }


    // =========================
    // PRINT CERTIFICATE
    // =========================

    public function certificate(Agent $agent)
    {
        $agent = $this->prepareAgentFiles($agent);

        return view(
            'print.certificate',
            compact('agent')
        );
    }


    // =========================
    // PRINT ID CARD
    // =========================

    public function idCard(Agent $agent)
    {
        $agent = $this->prepareAgentFiles($agent);

        return view(
            'print.id-card',
            compact('agent')
        );
    }
}