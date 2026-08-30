@extends('layouts.admin')

@section('title', 'Review Application')

@section('content')

<style>

/* =====================================================
   PAGE HEADER
===================================================== */

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
    font-size: 13px;
}


/* =====================================================
   CARDS
===================================================== */

.review-card {
    background: #ffffff;
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


/* =====================================================
   INFORMATION
===================================================== */

.info-item {
    margin-bottom: 18px;
}

.info-label {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .7px;
    color: #8a969e;
    font-weight: 700;
    margin-bottom: 4px;
}

.info-value {
    color: #26343d;
    font-size: 14px;
    font-weight: 500;
    word-break: break-word;
}


/* =====================================================
   PHOTO
===================================================== */

.agent-photo {
    width: 145px;
    height: 145px;
    object-fit: cover;
    border-radius: 12px;
    border: 4px solid #ffffff;
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
    margin: auto;
    border: 1px solid #e2e7ea;
}


/* =====================================================
   STATUS
===================================================== */

.status-badge {
    display: inline-block;
    padding: 6px 13px;
    border-radius: 30px;
    font-size: 10px;
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


/* =====================================================
   APPLICATION CODES
===================================================== */

.application-code {
    display: inline-block;
    font-family: monospace;
    background: #eef4f7;
    color: #063b5c;
    padding: 6px 10px;
    border-radius: 5px;
    font-size: 12px;
    border: 1px solid #e0e9ed;
    letter-spacing: .4px;
}


/* =====================================================
   DOCUMENTS
===================================================== */

.documents-table th {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: .5px;
    color: #7b858c;
    background: #f8fafb;
    border-bottom: 1px solid #e9ecef;
    white-space: nowrap;
}

.documents-table td {
    vertical-align: middle;
    font-size: 13px;
}

.document-name {
    max-width: 350px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: inline-block;
    vertical-align: middle;
}


/* =====================================================
   DOCUMENT ACTIONS
===================================================== */

.document-actions {
    display: flex;
    justify-content: flex-end;
    gap: 6px;
    flex-wrap: wrap;
}

.document-actions .btn {
    white-space: nowrap;
}


/* =====================================================
   DECISION
===================================================== */

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


/* =====================================================
   APPLICATION META
===================================================== */

.meta-line {
    font-size: 11px;
    color: #8b969d;
}


/* =====================================================
   PRIVATE FILE NOTICE
===================================================== */

.private-file-notice {
    background: #eef7fb;
    border: 1px solid #d7eaf2;
    color: #376477;
    border-radius: 8px;
    padding: 10px 13px;
    font-size: 11px;
    margin-bottom: 15px;
}


/* =====================================================
   RESPONSIVE
===================================================== */

@media (max-width: 768px) {

    .review-card-body {
        padding: 16px;
    }

    .document-actions {
        justify-content: flex-start;
    }

    .documents-table {
        min-width: 700px;
    }

}

</style>


{{-- =========================================================
     PAGE HEADER
========================================================= --}}

<div class="review-header">

    <div class="review-title">

        <div style="
            font-size:10px;
            font-weight:700;
            letter-spacing:1.3px;
            color:#8b969d;
            margin-bottom:5px;
        ">
            APPLICATION MANAGEMENT
        </div>

        <h2>
            Review Application
        </h2>

        <p>
            Review applicant information and submitted documents
            before making an administrative decision.
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
     APPLICATION INFORMATION
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5>
                    Application Information
                </h5>

                @if($agent->created_at)

                    <div class="meta-line mt-1">

                        Submitted
                        {{ $agent->created_at->format('d M Y, h:i A') }}

                    </div>

                @endif

            </div>


            {{-- STATUS --}}

            <div>

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

    </div>


    <div class="review-card-body">

        <div class="row">


            {{-- =================================================
                 APPLICANT INFORMATION
            ================================================== --}}

            <div class="col-lg-8">

                <div class="row">


                    {{-- NAME --}}

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


                    {{-- PHONE --}}

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


                    {{-- EMAIL --}}

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


                    {{-- ADDRESS --}}

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


                    {{-- REGION --}}

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


                    {{-- CITY --}}

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


                    {{-- COUNTRY --}}

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


                    {{-- TRACKING CODE --}}

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


                    {{-- REGISTRATION NUMBER --}}

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



            {{-- =================================================
                 AGENT PHOTO
            ================================================== --}}

            <div class="col-lg-4 text-center">

                <div class="info-label mb-3">
                    Agent Photo
                </div>


                @if($agent->photo_url)

                    <img
                        src="{{ $agent->photo_url }}"
                        class="agent-photo"
                        alt="{{ $agent->name }}"
                    >

                @else

                    <div class="no-photo">
                        No Photo Available
                    </div>

                @endif

            </div>


        </div>

    </div>

</div>



{{-- =========================================================
     SUBMITTED DOCUMENTS
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <h5>
                    Submitted Documents
                </h5>

                <div class="meta-line mt-1">
                    Documents submitted with this application
                </div>

            </div>

            <span class="meta-line">

                {{ $agent->documents->count() }}

                document{{ $agent->documents->count() == 1 ? '' : 's' }}

            </span>

        </div>

    </div>


    <div class="review-card-body">


        {{-- PRIVATE STORAGE NOTICE --}}

        <div class="private-file-notice">

            <strong>Secure documents:</strong>

            Submitted documents are stored in private storage.
            Document links are temporary and expire automatically
            after 30 minutes.

        </div>


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


                            {{-- NUMBER --}}

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- DOCUMENT TYPE --}}

                            <td>

                                <strong>
                                    {{ $document->document_type }}
                                </strong>

                            </td>


                            {{-- FILE NAME --}}

                            <td>

                                <small
                                    class="text-muted document-name"
                                    title="{{ $document->file_name }}"
                                >
                                    {{ $document->file_name }}
                                </small>

                            </td>


                            {{-- ACTION --}}

                            <td class="text-end">

                                @if($document->file_url)

                                    <div class="document-actions">

                                        {{-- VIEW DOCUMENT --}}

                                        <a
                                            href="{{ $document->file_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn btn-sm btn-outline-primary"
                                        >
                                            View Document
                                        </a>


                                        {{-- DOWNLOAD DOCUMENT --}}

                                        <a
                                            href="{{ $document->file_url }}"
                                            download="{{ $document->file_name }}"
                                            class="btn btn-sm btn-outline-success"
                                        >
                                            Download
                                        </a>

                                    </div>

                                @else

                                    <span class="badge bg-secondary">
                                        File unavailable
                                    </span>

                                @endif

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
     ADMINISTRATIVE DECISION
========================================================= --}}

<div class="review-card">

    <div class="review-card-header">

        <h5>
            Administrative Decision
        </h5>

    </div>


    <div class="review-card-body">


        @if(
            $agent->status === 'pending' ||
            $agent->status === 'correction_required'
        )


            <div class="decision-box">


                <label
                    for="comment"
                    class="form-label fw-semibold"
                >
                    Administrative Comment
                </label>


                <div class="text-muted mb-3" style="font-size:11px;">

                    Add a comment if the applicant needs
                    additional information or correction.

                </div>


                <textarea
                    name="comment"
                    id="comment"
                    class="form-control"
                    rows="4"
                    placeholder="Write a comment for the applicant if necessary..."
                >{{ $agent->admin_comment }}</textarea>



                <div class="decision-buttons">


                    {{-- =================================================
                         APPROVE
                    ================================================== --}}

                    <form
                        action="{{ route('admin.agents.approve', $agent) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn btn-success"
                            onclick="
                                return confirm(
                                    'Are you sure you want to approve this application?'
                                );
                            "
                        >

                            ✓ Approve Application

                        </button>

                    </form>



                    {{-- =================================================
                         SEND BACK
                    ================================================== --}}

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

                                if (
                                    !document.getElementById('comment').value.trim()
                                ) {

                                    alert(
                                        'Please provide a comment explaining what needs to be corrected.'
                                    );

                                    return false;
                                }

                                return confirm(
                                    'Send this application back to the applicant for correction?'
                                );

                            "
                        >

                            ↻ Send Back for Correction

                        </button>

                    </form>



                    {{-- =================================================
                         DENY
                    ================================================== --}}

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

                                if (
                                    !document.getElementById('comment').value.trim()
                                ) {

                                    alert(
                                        'Please provide a comment explaining the reason for denial.'
                                    );

                                    return false;
                                }

                                return confirm(
                                    'Are you sure you want to deny this application?'
                                );

                            "
                        >

                            ✕ Deny Application

                        </button>

                    </form>


                </div>

            </div>


        @else


            {{-- =================================================
                 PROCESSED APPLICATION
            ================================================== --}}

            <div class="alert alert-secondary mb-0">

                <div class="fw-semibold mb-2">

                    This application has already been processed.

                </div>


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


                @if($agent->admin_comment)

                    <hr>

                    <div class="fw-semibold">

                        Administrative Comment:

                    </div>

                    <div class="mt-1">

                        {{ $agent->admin_comment }}

                    </div>

                @endif


                @if($agent->approved_at)

                    <hr>

                    <div>

                        Approved:

                        <strong>

                            {{ $agent->approved_at->format('d F Y, h:i A') }}

                        </strong>

                    </div>

                @endif

            </div>


        @endif


    </div>

</div>


@endsection
