@extends('layouts.admin')

@section('title', 'Review Application')

@section('content')

<style>

    .review-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        gap: 15px;
        flex-wrap: wrap;
    }

    .review-title h2 {
        margin: 0;
        font-weight: 700;
        color: #063b5c;
    }

    .review-title p {
        margin: 5px 0 0;
        color: #7b858c;
        font-size: 14px;
    }

    .review-card {
        background: #fff;
        border-radius: 14px;
        border: 1px solid #e8edf1;
        box-shadow: 0 4px 18px rgba(0,0,0,.05);
        margin-bottom: 20px;
        overflow: hidden;
    }

    .review-card-header {
        padding: 17px 20px;
        border-bottom: 1px solid #edf0f2;
        background: #fafcfd;
    }

    .review-card-header h5 {
        margin: 0;
        color: #063b5c;
        font-weight: 700;
    }

    .review-card-body {
        padding: 22px;
    }

    .info-item {
        margin-bottom: 18px;
    }

    .info-label {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #8a969e;
        font-weight: 700;
        margin-bottom: 3px;
    }

    .info-value {
        color: #26343d;
        font-size: 14px;
        font-weight: 500;
    }

    .agent-photo {
        width: 145px;
        height: 145px;
        object-fit: cover;
        border-radius: 12px;
        border: 4px solid #fff;
        box-shadow: 0 4px 15px rgba(0,0,0,.12);
    }

    .no-photo {
        width: 145px;
        height: 145px;
        border-radius: 12px;
        background: #f1f4f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8a969e;
        font-size: 13px;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 13px;
        border-radius: 30px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .status-pending {
        background: #fff3cd;
        color: #856404;
    }

    .status-approved {
        background: #d1e7dd;
        color: #0f5132;
    }

    .status-denied {
        background: #f8d7da;
        color: #842029;
    }

    .status-correction {
        background: #ffe5b4;
        color: #8a4b00;
    }

    .documents-table th {
        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: .5px;
        color: #7b858c;
        background: #f8fafb;
        border-bottom: 1px solid #e9ecef;
    }

    .documents-table td {
        vertical-align: middle;
        font-size: 14px;
    }

    .decision-box {
        background: #f8fafb;
        border-radius: 12px;
        padding: 20px;
        border: 1px solid #e8edf1;
    }

    .decision-box textarea {
        border-radius: 9px;
        resize: vertical;
    }

    .decision-buttons {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .application-code {
        font-family: monospace;
        background: #eef4f7;
        color: #063b5c;
        padding: 5px 9px;
        border-radius: 5px;
        font-size: 13px;
    }

</style>


{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<div class="review-header">

    <div class="review-title">

        <h2>
            Review Application
        </h2>

        <p>
            Review applicant information and submitted documents
        </p>

    </div>


    <a
        href="{{ route('admin.agents') }}"
        class="btn btn-outline-secondary"
    >
        ← Back to Applications
    </a>

</div>



{{-- =========================================================
     APPLICATION SUMMARY
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <div class="d-flex justify-content-between align-items-center">

            <h5>
                Application Information
            </h5>

            @if($agent->status === 'pending')

                <span class="status-badge status-pending">
                    Pending
                </span>

            @elseif($agent->status === 'approved')

                <span class="status-badge status-approved">
                    Approved
                </span>

            @elseif($agent->status === 'denied')

                <span class="status-badge status-denied">
                    Denied
                </span>

            @elseif($agent->status === 'correction_required')

                <span class="status-badge status-correction">
                    Correction Required
                </span>

            @endif

        </div>

    </div>


    <div class="review-card-body">

        <div class="row">


            {{-- AGENT INFORMATION --}}

            <div class="col-lg-8">

                <div class="row">


                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Agent Name
                            </div>

                            <div class="info-value">
                                {{ $agent->name }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Phone
                            </div>

                            <div class="info-value">
                                {{ $agent->phone }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Email
                            </div>

                            <div class="info-value">

                                {{ $agent->email ?: 'Not provided' }}

                            </div>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <div class="info-item">

                            <div class="info-label">
                                Address
                            </div>

                            <div class="info-value">
                                {{ $agent->address }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="info-item">

                            <div class="info-label">
                                Region
                            </div>

                            <div class="info-value">
                                {{ $agent->region }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="info-item">

                            <div class="info-label">
                                City
                            </div>

                            <div class="info-value">
                                {{ $agent->city }}
                            </div>

                        </div>

                    </div>


                    <div class="col-md-4">

                        <div class="info-item">

                            <div class="info-label">
                                Country
                            </div>

                            <div class="info-value">
                                {{ $agent->country }}
                            </div>

                        </div>

                    </div>


                    @if($agent->tracking_code)

                        <div class="col-md-6">

                            <div class="info-item">

                                <div class="info-label">
                                    Tracking Code
                                </div>

                                <div class="info-value">

                                    <span class="application-code">
                                        {{ $agent->tracking_code }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endif


                    @if($agent->registration_number)

                        <div class="col-md-6">

                            <div class="info-item">

                                <div class="info-label">
                                    Registration Number
                                </div>

                                <div class="info-value">

                                    <span class="application-code">
                                        {{ $agent->registration_number }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    @endif


                </div>

            </div>


            {{-- PHOTO --}}

            <div class="col-lg-4 text-center">

                <div class="info-label mb-3">
                    Agent Photo
                </div>


                @if($agent->photo)

                    <img
                        src="{{ asset('storage/' . $agent->photo) }}"
                        class="agent-photo"
                        alt="Agent Photo"
                    >

                @else

                    <div class="no-photo mx-auto">
                        No Photo
                    </div>

                @endif

            </div>

        </div>

    </div>

</div>



{{-- =========================================================
     DOCUMENTS
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <h5>
            Submitted Documents
        </h5>

    </div>


    <div class="review-card-body">

        <div class="table-responsive">

            <table class="table documents-table align-middle mb-0">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            Document
                        </th>

                        <th>
                            File
                        </th>

                        <th class="text-end">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($agent->documents as $document)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>
                                <strong>
                                    {{ $document->document_type }}
                                </strong>
                            </td>

                            <td>

                                <small class="text-muted">

                                    {{ $document->file_name }}

                                </small>

                            </td>

                            <td class="text-end">

                                <a
                                    href="{{ asset('storage/' . $document->file_path) }}"
                                    target="_blank"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    View Document
                                </a>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="4"
                                class="text-center text-muted py-4"
                            >
                                No documents found.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>



{{-- =========================================================
     ADMIN DECISION
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <h5>
            Administrative Decision
        </h5>

    </div>


    <div class="review-card-body">


        @if($agent->status === 'pending' || $agent->status === 'correction_required')


            <div class="decision-box">

                <label class="form-label fw-semibold">

                    Administrative Comment

                </label>


                <textarea
                    name="comment"
                    id="comment"
                    class="form-control"
                    rows="4"
                    placeholder="Write a comment for the applicant if necessary..."
                >{{ $agent->admin_comment }}</textarea>


                <div class="decision-buttons">


                    {{-- APPROVE --}}

                    <form
                        action="{{ route('admin.agents.approve', $agent) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success"
                        >

                            ✓ Approve Application

                        </button>

                    </form>


                    {{-- SEND BACK --}}

                    <form
                        action="{{ route('admin.agents.send-back', $agent) }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="comment"
                            id="sendBackComment"
                        >

                        <button
                            type="submit"
                            class="btn btn-warning"
                            onclick="
                                document.getElementById('sendBackComment').value =
                                document.getElementById('comment').value;
                            "
                        >

                            ↻ Send Back

                        </button>

                    </form>


                    {{-- DENY --}}

                    <form
                        action="{{ route('admin.agents.deny', $agent) }}"
                        method="POST"
                    >

                        @csrf

                        <input
                            type="hidden"
                            name="comment"
                            id="denyComment"
                        >

                        <button
                            type="submit"
                            class="btn btn-danger"
                            onclick="
                                document.getElementById('denyComment').value =
                                document.getElementById('comment').value;
                            "
                        >

                            ✕ Deny Application

                        </button>

                    </form>


                </div>

            </div>


        @else


            <div class="alert alert-secondary mb-0">

                <strong>
                    This application has already been processed.
                </strong>

                <br><br>

                Status:

                <strong>
                    {{ ucfirst(str_replace('_', ' ', $agent->status)) }}
                </strong>


                @if($agent->admin_comment)

                    <hr>

                    <strong>
                        Administrative Comment:
                    </strong>

                    <br>

                    {{ $agent->admin_comment }}

                @endif


            </div>

        @endif

    </div>

</div>


@endsection