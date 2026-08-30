@extends('layouts.admin')

@section('title', 'MFMR | Review Application')

@section('page-title', 'Review Application')

@section('content')

<style>

    .review-page {
        max-width: 1500px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 25px;
        gap: 20px;
    }

    .page-header h1 {
        margin: 0;
        color: #063b5c;
        font-size: 28px;
        font-weight: 700;
    }

    .page-header p {
        margin: 7px 0 0;
        color: #71808a;
        font-size: 13px;
    }

    .back-link {
        color: #063b5c;
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .review-card {
        background: #ffffff;
        border: 1px solid #e5ebef;
        border-radius: 16px;
        margin-bottom: 22px;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(0,0,0,.03);
    }

    .card-header {
        padding: 20px 25px;
        border-bottom: 1px solid #e8edf0;
        background: #ffffff;
    }

    .card-header h2 {
        margin: 0;
        color: #063b5c;
        font-size: 17px;
        font-weight: 700;
    }

    .card-header p {
        margin: 4px 0 0;
        color: #82909a;
        font-size: 12px;
    }

    .card-body {
        padding: 25px;
    }

    .status-badge {
        display: inline-block;
        margin-top: 10px;
        padding: 7px 14px;
        border-radius: 20px;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .4px;
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

    .status-correction_required {
        background: #ffe5d0;
        color: #984c0c;
    }

    .information-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 22px 40px;
    }

    .information-item {
        padding-bottom: 13px;
        border-bottom: 1px solid #f0f2f4;
    }

    .information-label {
        color: #81909b;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .information-value {
        color: #263238;
        font-size: 14px;
        word-break: break-word;
    }

    .tracking-code {
        display: inline-block;
        padding: 7px 11px;
        background: #edf5f8;
        border-radius: 7px;
        color: #063b5c;
        font-family: monospace;
        font-size: 13px;
        font-weight: 600;
    }

    .registration-code {
        display: inline-block;
        padding: 7px 11px;
        background: #eaf6ee;
        border-radius: 7px;
        color: #176b3a;
        font-family: monospace;
        font-size: 13px;
        font-weight: 600;
    }

    .photo-section {
        margin-top: 25px;
        padding-top: 25px;
        border-top: 1px solid #e8edf0;
    }

    .agent-photo {
        width: 150px;
        height: 180px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #dfe6ea;
        display: block;
    }

    .no-photo {
        width: 150px;
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f6f8;
        border: 1px solid #dfe6ea;
        border-radius: 10px;
        color: #89969f;
        font-size: 12px;
        text-align: center;
    }

    .documents-table-wrapper {
        overflow-x: auto;
    }

    .documents-table {
        width: 100%;
        border-collapse: collapse;
    }

    .documents-table th {
        background: #f6f8f9;
        color: #687780;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .6px;
        text-align: left;
        padding: 13px 14px;
        border-bottom: 1px solid #e2e7ea;
    }

    .documents-table td {
        padding: 15px 14px;
        border-bottom: 1px solid #edf0f2;
        color: #37474f;
        font-size: 13px;
        vertical-align: middle;
    }

    .documents-table tr:last-child td {
        border-bottom: none;
    }

    .document-name {
        font-weight: 700;
        color: #263238;
    }

    .document-file {
        color: #71808a;
        word-break: break-word;
    }

    .btn-document {
        display: inline-block;
        padding: 8px 13px;
        border-radius: 6px;
        background: #063b5c;
        color: #ffffff !important;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
    }

    .btn-document:hover {
        opacity: .9;
    }

    .unavailable {
        color: #9aa5ab;
        font-size: 11px;
    }

    .decision-box {
        padding: 25px;
    }

    .comment-label {
        display: block;
        margin-bottom: 8px;
        color: #54636c;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .comment-box {
        width: 100%;
        min-height: 110px;
        padding: 12px;
        border: 1px solid #d9e1e5;
        border-radius: 8px;
        resize: vertical;
        font-family: inherit;
        font-size: 13px;
        box-sizing: border-box;
    }

    .comment-box:focus {
        outline: none;
        border-color: #063b5c;
    }

    .decision-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 15px;
    }

    .decision-buttons button {
        border: none;
        border-radius: 7px;
        padding: 10px 18px;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-approve {
        background: #198754;
        color: #ffffff;
    }

    .btn-send-back {
        background: #ffc107;
        color: #212529;
    }

    .btn-deny {
        background: #dc3545;
        color: #ffffff;
    }

    .processed-box {
        padding: 22px 25px;
    }

    .processed-message {
        color: #46545c;
        font-size: 13px;
        margin-bottom: 15px;
    }

    .processed-row {
        margin-bottom: 10px;
        color: #596971;
        font-size: 13px;
    }

    .processed-row strong {
        color: #263238;
    }

    .admin-comment {
        margin-top: 18px;
        padding: 15px;
        background: #f7f9fa;
        border-left: 4px solid #063b5c;
        border-radius: 5px;
        color: #46545c;
        font-size: 13px;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e8edf0;
    }

    .action-button {
        display: inline-block;
        padding: 10px 16px;
        border-radius: 7px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
    }

    .certificate-button {
        background: #063b5c;
        color: #ffffff !important;
    }

    .id-card-button {
        background: #198754;
        color: #ffffff !important;
    }

    @media (max-width: 768px) {

        .information-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-direction: column;
        }

        .card-body,
        .card-header,
        .decision-box,
        .processed-box {
            padding: 18px;
        }

    }

</style>


<div class="review-page">


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="page-header">

        <div>

            <h1>
                Review Application
            </h1>

            <p>
                Review applicant information and submitted documents
                before making an administrative decision.
            </p>

        </div>

        <a
            href="{{ route('admin.agents.index') }}"
            class="back-link"
        >
            ← Back to Applications
        </a>

    </div>


    {{-- =========================================================
         SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div
            style="
                margin-bottom:20px;
                padding:13px 16px;
                background:#d1e7dd;
                color:#0f5132;
                border:1px solid #badbcc;
                border-radius:8px;
                font-size:13px;
            "
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- =========================================================
         APPLICATION INFORMATION
    ========================================================== --}}

    <div class="review-card">

        <div class="card-header">

            <h2>
                Application Information
            </h2>

            <p>
                Submitted
                {{ $agent->created_at
                    ? $agent->created_at->format('d M Y, h:i A')
                    : '—'
                }}
            </p>

            <span
                class="
                    status-badge
                    status-{{ $agent->status }}
                "
            >
                {{ strtoupper(
                    str_replace(
                        '_',
                        ' ',
                        $agent->status
                    )
                ) }}
            </span>

        </div>


        <div class="card-body">

            <div class="information-grid">


                {{-- NAME --}}

                <div class="information-item">

                    <div class="information-label">
                        Agent Name
                    </div>

                    <div class="information-value">
                        {{ $agent->name }}
                    </div>

                </div>


                {{-- PHONE --}}

                <div class="information-item">

                    <div class="information-label">
                        Phone
                    </div>

                    <div class="information-value">
                        {{ $agent->phone }}
                    </div>

                </div>


                {{-- EMAIL --}}

                <div class="information-item">

                    <div class="information-label">
                        Email
                    </div>

                    <div class="information-value">
                        {{ $agent->email ?: 'Not provided' }}
                    </div>

                </div>


                {{-- ADDRESS --}}

                <div class="information-item">

                    <div class="information-label">
                        Address
                    </div>

                    <div class="information-value">
                        {{ $agent->address }}
                    </div>

                </div>


                {{-- REGION --}}

                <div class="information-item">

                    <div class="information-label">
                        Region
                    </div>

                    <div class="information-value">
                        {{ $agent->region }}
                    </div>

                </div>


                {{-- CITY --}}

                <div class="information-item">

                    <div class="information-label">
                        City
                    </div>

                    <div class="information-value">
                        {{ $agent->city }}
                    </div>

                </div>


                {{-- COUNTRY --}}

                <div class="information-item">

                    <div class="information-label">
                        Country
                    </div>

                    <div class="information-value">
                        {{ $agent->country }}
                    </div>

                </div>


                {{-- TRACKING CODE --}}

                <div class="information-item">

                    <div class="information-label">
                        Tracking Code
                    </div>

                    <div class="information-value">

                        <span class="tracking-code">
                            {{ $agent->tracking_code }}
                        </span>

                    </div>

                </div>


                {{-- REGISTRATION NUMBER --}}

                @if($agent->registration_number)

                    <div class="information-item">

                        <div class="information-label">
                            Registration Number
                        </div>

                        <div class="information-value">

                            <span class="registration-code">
                                {{ $agent->registration_number }}
                            </span>

                        </div>

                    </div>

                @endif


                {{-- APPROVAL DATE --}}

                @if($agent->approved_at)

                    <div class="information-item">

                        <div class="information-label">
                            Approved Date
                        </div>

                        <div class="information-value">

                            {{ \Carbon\Carbon::parse(
                                $agent->approved_at
                            )->format('d M Y, h:i A') }}

                        </div>

                    </div>

                @endif


            </div>


            {{-- =================================================
                 AGENT PHOTO
            ================================================== --}}

            <div class="photo-section">

                <div class="information-label">
                    Agent Photo
                </div>

                @if($agent->photo_url)

                    <img
                        src="{{ $agent->photo_url }}"
                        alt="Agent Photo"
                        class="agent-photo"
                    >

                @else

                    <div class="no-photo">
                        No Photo Available
                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
         SUBMITTED DOCUMENTS
    ========================================================== --}}

    <div class="review-card">

        <div class="card-header">

            <h2>
                Submitted Documents
            </h2>

            <p>
                {{ $agent->documents->count() }}
                document{{ $agent->documents->count() == 1 ? '' : 's' }}
            </p>

        </div>


        <div class="card-body">

            <div class="documents-table-wrapper">

                <table class="documents-table">

                    <thead>

                        <tr>

                            <th style="width:55px;">
                                #
                            </th>

                            <th>
                                DOCUMENT
                            </th>

                            <th>
                                FILE
                            </th>

                            <th style="width:180px;">
                                ACTION
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($agent->documents as $index => $document)

                            <tr>

                                <td>
                                    {{ $index + 1 }}
                                </td>


                                <td>

                                    <div class="document-name">
                                        {{ $document->document_type }}
                                    </div>

                                </td>


                                <td>

                                    <div class="document-file">
                                        {{ $document->file_name }}
                                    </div>

                                </td>


                                <td>

                                    @if($document->file_url)

                                        <a
                                            href="{{ $document->file_url }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="btn-document"
                                        >
                                            View Document
                                        </a>

                                    @else

                                        <span class="unavailable">
                                            File unavailable
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    style="
                                        text-align:center;
                                        padding:35px;
                                        color:#89969f;
                                    "
                                >
                                    No documents submitted.
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
    ========================================================== --}}

    <div class="review-card">


        @if(
            $agent->status === 'pending' ||
            $agent->status === 'correction_required'
        )


            <div class="card-header">

                <h2>
                    Administrative Decision
                </h2>

                <p>
                    Review the application and select an appropriate action.
                </p>

            </div>


            <div class="decision-box">


                {{-- COMMENT --}}

                <label
                    for="comment"
                    class="comment-label"
                >
                    Administrative Comment
                </label>


                <textarea
                    name="comment"
                    id="comment"
                    class="comment-box"
                    rows="5"
                    placeholder="Write a comment if needed..."
                >{{ $agent->admin_comment }}</textarea>


                {{-- BUTTONS --}}

                <div class="decision-buttons">


                    {{-- APPROVE --}}

                    <form
                        action="{{ route(
                            'admin.agents.approve',
                            $agent
                        ) }}"
                        method="POST"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="btn-approve"
                        >
                            Approve Application
                        </button>

                    </form>


                    {{-- SEND BACK --}}

                    <form
                        action="{{ route(
                            'admin.agents.send-back',
                            $agent
                        ) }}"
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
                            class="btn-send-back"
                            onclick="
                                document.getElementById(
                                    'sendBackComment'
                                ).value =
                                document.getElementById(
                                    'comment'
                                ).value;
                            "
                        >
                            Send Back for Correction
                        </button>

                    </form>


                    {{-- DENY --}}

                    <form
                        action="{{ route(
                            'admin.agents.deny',
                            $agent
                        ) }}"
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
                            class="btn-deny"
                            onclick="
                                document.getElementById(
                                    'denyComment'
                                ).value =
                                document.getElementById(
                                    'comment'
                                ).value;
                            "
                        >
                            Deny Application
                        </button>

                    </form>


                </div>

            </div>


        @else


            {{-- =================================================
                 PROCESSED APPLICATION
            ================================================== --}}

            <div class="card-header">

                <h2>
                    Administrative Decision
                </h2>

                <p>
                    This application has already been processed.
                </p>

            </div>


            <div class="processed-box">


                <div class="processed-message">

                    This application has already been processed.

                </div>


                {{-- STATUS --}}

                <div class="processed-row">

                    <strong>
                        Status:
                    </strong>

                    {{ ucfirst(
                        str_replace(
                            '_',
                            ' ',
                            $agent->status
                        )
                    ) }}

                </div>


                {{-- REGISTRATION NUMBER --}}

                @if($agent->registration_number)

                    <div class="processed-row">

                        <strong>
                            Registration Number:
                        </strong>

                        {{ $agent->registration_number }}

                    </div>

                @endif


                {{-- APPROVAL DATE --}}

                @if($agent->approved_at)

                    <div class="processed-row">

                        <strong>
                            Approved:
                        </strong>

                        {{ \Carbon\Carbon::parse(
                            $agent->approved_at
                        )->format('d M Y, h:i A') }}

                    </div>

                @endif


                {{-- ADMIN COMMENT --}}

                @if($agent->admin_comment)

                    <div class="admin-comment">

                        <strong>
                            Administrative Comment:
                        </strong>

                        <div style="margin-top:6px;">
                            {{ $agent->admin_comment }}
                        </div>

                    </div>

                @endif


                {{-- APPROVED ACTIONS --}}

                @if($agent->status === 'approved')

                    <div class="action-buttons">


                        {{-- CERTIFICATE --}}

                        <a
                            href="{{ route(
                                'admin.certificate',
                                $agent
                            ) }}"
                            target="_blank"
                            class="action-button certificate-button"
                        >
                            Print Certificate
                        </a>


                        {{-- ID CARD --}}

                        <a
                            href="{{ route(
                                'admin.id-card',
                                $agent
                            ) }}"
                            target="_blank"
                            class="action-button id-card-button"
                        >
                            Print ID Card
                        </a>


                    </div>

                @endif


            </div>


        @endif


    </div>


</div>

@endsection
