@extends('layouts.admin')

@section('title', 'MFMR | Agent Applications')

@section('page-title', 'Agent Applications')

@section('content')

@php

    $total = $agents->count();

    $pending = $agents->where('status', 'pending')->count();

    $approved = $agents->where('status', 'approved')->count();

    $correction = $agents->where(
        'status',
        'correction_required'
    )->count();

    $denied = $agents->where('status', 'denied')->count();

@endphp


<style>

    .applications-page {
        width: 100%;
    }

    .applications-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 20px;
        margin-bottom: 28px;
    }

    .applications-header h1 {
        margin: 0;
        color: #063b5c;
        font-size: 27px;
        font-weight: 700;
        letter-spacing: -.4px;
    }

    .applications-header p {
        margin: 7px 0 0;
        color: #7b858c;
        font-size: 12px;
    }

    .management-badge {
        background: #ffffff;
        border: 1px solid #e2e8ec;
        border-radius: 10px;
        padding: 11px 15px;
        color: #6f7b82;
        font-size: 10px;
        box-shadow: 0 4px 14px rgba(6,59,92,.04);
        white-space: nowrap;
    }

    .management-dot {
        display: inline-block;
        width: 7px;
        height: 7px;
        background: #2ca56f;
        border-radius: 50%;
        margin-right: 6px;
    }

    .summary-grid {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 14px;
        margin-bottom: 25px;
    }

    .summary-card {
        padding: 18px 20px;
        background: #ffffff;
        border: 1px solid #e4e9ec;
        border-radius: 10px;
        box-shadow: 0 3px 12px rgba(6,59,92,.03);
    }

    .summary-label {
        color: #8b969d;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .8px;
    }

    .summary-number {
        margin-top: 8px;
        font-size: 27px;
        font-weight: 700;
    }

    .summary-description {
        margin-top: 5px;
        color: #9aa3a8;
        font-size: 9px;
    }

    .total-card {
        border-top: 3px solid #063b5c;
    }

    .total-number {
        color: #063b5c;
    }

    .pending-card {
        border-top: 3px solid #d89b25;
    }

    .pending-number {
        color: #b87908;
    }

    .approved-card {
        border-top: 3px solid #2ca56f;
    }

    .approved-number {
        color: #23855a;
    }

    .correction-card {
        border-top: 3px solid #e39a2b;
    }

    .correction-number {
        color: #bd7610;
    }

    .denied-card {
        border-top: 3px solid #c94b4b;
    }

    .denied-number {
        color: #b13d3d;
    }

    .applications-box {
        background: #ffffff;
        border: 1px solid #e4e9ec;
        border-radius: 12px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 3px 12px rgba(6,59,92,.03);
    }

    .table-header {
        padding: 21px 23px;
        border-bottom: 1px solid #e8edf0;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .table-header h2 {
        margin: 0;
        color: #063b5c;
        font-size: 17px;
        font-weight: 700;
    }

    .table-header-description {
        margin-top: 5px;
        color: #929ca2;
        font-size: 10px;
    }

    .application-count {
        background: #f4f7f9;
        border: 1px solid #e2e8ec;
        border-radius: 7px;
        padding: 7px 12px;
        color: #60717a;
        font-size: 10px;
        font-weight: 600;
        white-space: nowrap;
    }

    .table-wrapper {
        overflow-x: auto;
    }

    .applications-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1050px;
    }

    .applications-table th {
        padding: 13px 14px;
        background: #f8fafb;
        border-bottom: 1px solid #e3e8eb;
        color: #687780;
        font-size: 9px;
        font-weight: 700;
        letter-spacing: .7px;
        text-align: left;
        white-space: nowrap;
    }

    .applications-table td {
        padding: 15px 14px;
        border-bottom: 1px solid #edf0f2;
        vertical-align: middle;
    }

    .applications-table tbody tr:hover {
        background: #fafcfd;
    }

    .agent-container {
        display: flex;
        align-items: center;
        gap: 11px;
    }

    .agent-photo {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid #e5ebee;
    }

    .agent-initial {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #edf3f6;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #063b5c;
        font-weight: 700;
        font-size: 13px;
        flex-shrink: 0;
    }

    .agent-name {
        color: #263238;
        font-weight: 700;
        font-size: 12px;
    }

    .agent-email {
        margin-top: 3px;
        color: #929ca2;
        font-size: 9px;
    }

    .tracking-code {
        display: inline-block;
        padding: 6px 9px;
        border-radius: 6px;
        background: #f1f6f8;
        color: #063b5c;
        font-family: monospace;
        font-size: 10px;
        font-weight: 600;
        border: 1px solid #e1eaee;
    }

    .phone {
        color: #536169;
        font-size: 11px;
    }

    .location-city {
        color: #45545c;
        font-size: 11px;
    }

    .location-region {
        margin-top: 3px;
        color: #9aa3a8;
        font-size: 9px;
    }

    .submitted-date {
        color: #536169;
        font-size: 10px;
        white-space: nowrap;
    }

    .submitted-time {
        margin-top: 3px;
        color: #9aa3a8;
        font-size: 9px;
    }

    .review-button {
        display: inline-block;
        padding: 8px 13px;
        background: #063b5c;
        color: #ffffff !important;
        border-radius: 6px;
        text-decoration: none;
        font-size: 9px;
        font-weight: 600;
        white-space: nowrap;
    }

    .review-button:hover {
        background: #052f49;
        text-decoration: none;
    }

    .empty-state {
        text-align: center;
        padding: 70px 30px;
    }

    .empty-icon {
        width: 55px;
        height: 55px;
        margin: 0 auto 15px;
        border-radius: 50%;
        background: #eef4f7;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #063b5c;
        font-size: 23px;
    }

    .empty-title {
        color: #263238;
        font-size: 14px;
        font-weight: 700;
    }

    .empty-description {
        margin-top: 7px;
        color: #929ca2;
        font-size: 10px;
    }

    .table-footer {
        padding: 13px 23px;
        border-top: 1px solid #e8edf0;
        background: #fafcfd;
        color: #929ca2;
        font-size: 9px;
    }

    @media (max-width: 1100px) {

        .summary-grid {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

    }

    @media (max-width: 700px) {

        .summary-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .applications-header {
            align-items: flex-start;
            flex-direction: column;
        }

    }

    @media (max-width: 480px) {

        .summary-grid {
            grid-template-columns: 1fr;
        }

        .table-header {
            align-items: flex-start;
            flex-direction: column;
        }

    }

</style>


<div class="applications-page">


    {{-- =========================================================
         PAGE HEADER
    ========================================================== --}}

    <div class="applications-header">

        <div>

            <div style="
                font-size:10px;
                font-weight:700;
                letter-spacing:1.5px;
                color:#8b969d;
                margin-bottom:6px;
            ">
                MINISTRY ADMINISTRATION
            </div>

            <h1>
                Agent Applications
            </h1>

            <p>
                Review, process and manage Fisheries & Marine Resources
                agent applications.
            </p>

        </div>


        <div class="management-badge">

            <span class="management-dot"></span>

            APPLICATION MANAGEMENT

        </div>

    </div>


    {{-- =========================================================
         SUMMARY CARDS
    ========================================================== --}}

    <div class="summary-grid">


        {{-- TOTAL --}}

        <div class="summary-card total-card">

            <div class="summary-label">
                TOTAL APPLICATIONS
            </div>

            <div class="summary-number total-number">
                {{ $total }}
            </div>

            <div class="summary-description">
                All submitted applications
            </div>

        </div>


        {{-- PENDING --}}

        <div class="summary-card pending-card">

            <div class="summary-label">
                PENDING
            </div>

            <div class="summary-number pending-number">
                {{ $pending }}
            </div>

            <div class="summary-description">
                Awaiting review
            </div>

        </div>


        {{-- APPROVED --}}

        <div class="summary-card approved-card">

            <div class="summary-label">
                APPROVED
            </div>

            <div class="summary-number approved-number">
                {{ $approved }}
            </div>

            <div class="summary-description">
                Registered agents
            </div>

        </div>


        {{-- CORRECTION --}}

        <div class="summary-card correction-card">

            <div class="summary-label">
                CORRECTION
            </div>

            <div class="summary-number correction-number">
                {{ $correction }}
            </div>

            <div class="summary-description">
                Returned to applicants
            </div>

        </div>


        {{-- DENIED --}}

        <div class="summary-card denied-card">

            <div class="summary-label">
                DENIED
            </div>

            <div class="summary-number denied-number">
                {{ $denied }}
            </div>

            <div class="summary-description">
                Unsuccessful applications
            </div>

        </div>


    </div>


    {{-- =========================================================
         APPLICATION LIST
    ========================================================== --}}

    <div class="applications-box">


        {{-- TABLE HEADER --}}

        <div class="table-header">

            <div>

                <h2>
                    All Applications
                </h2>

                <div class="table-header-description">
                    Applications submitted to the Ministry of Fisheries
                    & Marine Resources
                </div>

            </div>


            <div class="application-count">

                {{ $total }}

                Application{{ $total == 1 ? '' : 's' }}

            </div>

        </div>


        {{-- =====================================================
             TABLE
        ====================================================== --}}

        <div class="table-wrapper">

            <table class="applications-table">

                <thead>

                    <tr>

                        <th>
                            #
                        </th>

                        <th>
                            AGENT
                        </th>

                        <th>
                            TRACKING CODE
                        </th>

                        <th>
                            PHONE
                        </th>

                        <th>
                            LOCATION
                        </th>

                        <th>
                            STATUS
                        </th>

                        <th>
                            SUBMITTED
                        </th>

                        <th style="text-align:right;">
                            ACTION
                        </th>

                    </tr>

                </thead>


                <tbody>


                    @forelse($agents as $agent)

                        <tr>


                            {{-- ID --}}

                            <td style="
                                color:#8b969d;
                                font-size:10px;
                            ">

                                #{{ $agent->id }}

                            </td>


                            {{-- AGENT --}}

                            <td>

                                <div class="agent-container">


                                    {{-- PRIVATE PHOTO --}}

                                    @if($agent->photo_url)

                                        <img
                                            src="{{ $agent->photo_url }}"
                                            alt="{{ $agent->name }}"
                                            class="agent-photo"
                                        >

                                    @else

                                        <div class="agent-initial">

                                            {{ strtoupper(
                                                substr(
                                                    $agent->name,
                                                    0,
                                                    1
                                                )
                                            ) }}

                                        </div>

                                    @endif


                                    <div>

                                        <div class="agent-name">

                                            {{ $agent->name }}

                                        </div>


                                        @if($agent->email)

                                            <div class="agent-email">

                                                {{ $agent->email }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- TRACKING CODE --}}

                            <td>

                                @if($agent->tracking_code)

                                    <span class="tracking-code">

                                        {{ $agent->tracking_code }}

                                    </span>

                                @else

                                    <span style="
                                        color:#a5adb2;
                                        font-size:10px;
                                    ">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- PHONE --}}

                            <td>

                                <span class="phone">

                                    {{ $agent->phone }}

                                </span>

                            </td>


                            {{-- LOCATION --}}

                            <td>

                                <div class="location-city">

                                    {{ $agent->city }}

                                </div>

                                <div class="location-region">

                                    {{ $agent->region }}

                                </div>

                            </td>


                            {{-- STATUS --}}

                            <td>

                                <span class="status {{ $agent->status }}">

                                    {{ strtoupper(
                                        str_replace(
                                            '_',
                                            ' ',
                                            $agent->status
                                        )
                                    ) }}

                                </span>

                            </td>


                            {{-- SUBMITTED --}}

                            <td>

                                <div class="submitted-date">

                                    {{ $agent->created_at
                                        ? $agent->created_at->format('d M Y')
                                        : '—'
                                    }}

                                </div>

                                <div class="submitted-time">

                                    {{ $agent->created_at
                                        ? $agent->created_at->format('H:i')
                                        : ''
                                    }}

                                </div>

                            </td>


                            {{-- ACTION --}}

                            <td style="
                                text-align:right;
                            ">

                                {{-- IMPORTANT:
                                     This matches your existing route:
                                     admin.agents.show
                                --}}

                                <a
                                    href="{{ route(
                                        'admin.agents.show',
                                        $agent->id
                                    ) }}"
                                    class="review-button"
                                >

                                    Review Application →

                                </a>

                            </td>


                        </tr>


                    @empty


                        {{-- EMPTY STATE --}}

                        <tr>

                            <td
                                colspan="8"
                                class="empty-state"
                            >

                                <div class="empty-icon">
                                    ▣
                                </div>

                                <div class="empty-title">

                                    No applications found

                                </div>

                                <div class="empty-description">

                                    New agent registration applications
                                    will appear here.

                                </div>

                            </td>

                        </tr>


                    @endforelse


                </tbody>

            </table>

        </div>


        {{-- =====================================================
             FOOTER
        ====================================================== --}}

        @if($total > 0)

            <div class="table-footer">

                Showing

                {{ $total }}

                application{{ $total == 1 ? '' : 's' }}

            </div>

        @endif


    </div>


</div>

@endsection
