@extends('layouts.admin')

@section('title', 'MFMR | Agent Applications')

@section('page-title', 'Agent Applications')

@section('content')

@php
    $total = $agents->count();

    $pending = $agents->where('status', 'pending')->count();

    $approved = $agents->where('status', 'approved')->count();

    $correction = $agents->where('status', 'correction_required')->count();

    $denied = $agents->where('status', 'denied')->count();
@endphp


<!-- =========================================================
     PAGE HEADER
========================================================= -->

<div style="
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:20px;
    margin-bottom:28px;
">

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

        <h1 style="
            margin:0;
            color:#063b5c;
            font-size:27px;
            font-weight:700;
            letter-spacing:-.4px;
        ">
            Agent Applications
        </h1>

        <p style="
            margin:7px 0 0;
            color:#7b858c;
            font-size:12px;
        ">
            Review, process and manage Fisheries & Marine Resources agent applications.
        </p>

    </div>

    <div style="
        background:#ffffff;
        border:1px solid #e2e8ec;
        border-radius:10px;
        padding:11px 15px;
        color:#6f7b82;
        font-size:10px;
        box-shadow:0 4px 14px rgba(6,59,92,.04);
    ">

        <span style="
            display:inline-block;
            width:7px;
            height:7px;
            background:#2ca56f;
            border-radius:50%;
            margin-right:6px;
        "></span>

        APPLICATION MANAGEMENT

    </div>

</div>


<!-- =========================================================
     SUMMARY CARDS
========================================================= -->

<div style="
    display:grid;
    grid-template-columns:repeat(5, minmax(0, 1fr));
    gap:14px;
    margin-bottom:25px;
">


    <!-- TOTAL -->

    <div class="box" style="
        padding:18px 20px;
        border-top:3px solid #063b5c;
    ">

        <div style="
            color:#8b969d;
            font-size:9px;
            font-weight:700;
            letter-spacing:.8px;
        ">
            TOTAL APPLICATIONS
        </div>

        <div style="
            margin-top:8px;
            color:#063b5c;
            font-size:27px;
            font-weight:700;
        ">
            {{ $total }}
        </div>

        <div style="
            margin-top:5px;
            color:#9aa3a8;
            font-size:9px;
        ">
            All submitted applications
        </div>

    </div>


    <!-- PENDING -->

    <div class="box" style="
        padding:18px 20px;
        border-top:3px solid #d89b25;
    ">

        <div style="
            color:#8b969d;
            font-size:9px;
            font-weight:700;
            letter-spacing:.8px;
        ">
            PENDING
        </div>

        <div style="
            margin-top:8px;
            color:#b87908;
            font-size:27px;
            font-weight:700;
        ">
            {{ $pending }}
        </div>

        <div style="
            margin-top:5px;
            color:#9aa3a8;
            font-size:9px;
        ">
            Awaiting review
        </div>

    </div>


    <!-- APPROVED -->

    <div class="box" style="
        padding:18px 20px;
        border-top:3px solid #2ca56f;
    ">

        <div style="
            color:#8b969d;
            font-size:9px;
            font-weight:700;
            letter-spacing:.8px;
        ">
            APPROVED
        </div>

        <div style="
            margin-top:8px;
            color:#23855a;
            font-size:27px;
            font-weight:700;
        ">
            {{ $approved }}
        </div>

        <div style="
            margin-top:5px;
            color:#9aa3a8;
            font-size:9px;
        ">
            Registered agents
        </div>

    </div>


    <!-- CORRECTION -->

    <div class="box" style="
        padding:18px 20px;
        border-top:3px solid #e39a2b;
    ">

        <div style="
            color:#8b969d;
            font-size:9px;
            font-weight:700;
            letter-spacing:.8px;
        ">
            CORRECTION
        </div>

        <div style="
            margin-top:8px;
            color:#bd7610;
            font-size:27px;
            font-weight:700;
        ">
            {{ $correction }}
        </div>

        <div style="
            margin-top:5px;
            color:#9aa3a8;
            font-size:9px;
        ">
            Returned to applicants
        </div>

    </div>


    <!-- DENIED -->

    <div class="box" style="
        padding:18px 20px;
        border-top:3px solid #c94b4b;
    ">

        <div style="
            color:#8b969d;
            font-size:9px;
            font-weight:700;
            letter-spacing:.8px;
        ">
            DENIED
        </div>

        <div style="
            margin-top:8px;
            color:#b13d3d;
            font-size:27px;
            font-weight:700;
        ">
            {{ $denied }}
        </div>

        <div style="
            margin-top:5px;
            color:#9aa3a8;
            font-size:9px;
        ">
            Unsuccessful applications
        </div>

    </div>

</div>


<!-- =========================================================
     APPLICATION LIST
========================================================= -->

<div class="box" style="
    padding:0;
    overflow:hidden;
">


    <!-- TABLE HEADER -->

    <div style="
        padding:21px 23px;
        border-bottom:1px solid #e8edf0;
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
    ">

        <div>

            <h2 style="
                margin:0;
                color:#063b5c;
                font-size:17px;
                font-weight:700;
            ">
                All Applications
            </h2>

            <div style="
                margin-top:5px;
                color:#929ca2;
                font-size:10px;
            ">
                Applications submitted to the Ministry of Fisheries & Marine Resources
            </div>

        </div>


        <div style="
            background:#f4f7f9;
            border:1px solid #e2e8ec;
            border-radius:7px;
            padding:7px 12px;
            color:#60717a;
            font-size:10px;
            font-weight:600;
        ">

            {{ $total }} Application{{ $total == 1 ? '' : 's' }}

        </div>

    </div>


    <!-- TABLE -->

    <div style="
        overflow-x:auto;
    ">

        <table style="
            width:100%;
            border-collapse:collapse;
            min-width:1050px;
        ">

            <thead>

                <tr>

                    <th>#</th>

                    <th>AGENT</th>

                    <th>TRACKING CODE</th>

                    <th>PHONE</th>

                    <th>LOCATION</th>

                    <th>STATUS</th>

                    <th>SUBMITTED</th>

                    <th style="text-align:right;">
                        ACTION
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse($agents as $agent)

                    <tr>


                        <!-- ID -->

                        <td style="
                            color:#8b969d;
                            font-size:10px;
                        ">

                            #{{ $agent->id }}

                        </td>


                        <!-- AGENT -->

                        <td>

                            <div style="
                                display:flex;
                                align-items:center;
                                gap:11px;
                            ">


                                @if($agent->photo)

                                    <img
                                        src="{{ asset('storage/' . $agent->photo) }}"
                                        alt="{{ $agent->name }}"
                                        style="
                                            width:38px;
                                            height:38px;
                                            border-radius:50%;
                                            object-fit:cover;
                                            border:2px solid #e5ebee;
                                        "
                                    >

                                @else

                                    <div style="
                                        width:38px;
                                        height:38px;
                                        border-radius:50%;
                                        background:#edf3f6;
                                        display:flex;
                                        align-items:center;
                                        justify-content:center;
                                        color:#063b5c;
                                        font-weight:700;
                                        font-size:13px;
                                    ">
                                        {{ strtoupper(substr($agent->name, 0, 1)) }}
                                    </div>

                                @endif


                                <div>

                                    <div style="
                                        color:#263238;
                                        font-weight:700;
                                        font-size:12px;
                                    ">

                                        {{ $agent->name }}

                                    </div>

                                    @if($agent->email)

                                        <div style="
                                            margin-top:3px;
                                            color:#929ca2;
                                            font-size:9px;
                                        ">

                                            {{ $agent->email }}

                                        </div>

                                    @endif

                                </div>

                            </div>

                        </td>


                        <!-- TRACKING CODE -->

                        <td>

                            @if($agent->tracking_code)

                                <span style="
                                    display:inline-block;
                                    padding:6px 9px;
                                    border-radius:6px;
                                    background:#f1f6f8;
                                    color:#063b5c;
                                    font-family:monospace;
                                    font-size:10px;
                                    font-weight:600;
                                    border:1px solid #e1eaee;
                                ">

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


                        <!-- PHONE -->

                        <td>

                            <span style="
                                color:#536169;
                                font-size:11px;
                            ">

                                {{ $agent->phone }}

                            </span>

                        </td>


                        <!-- LOCATION -->

                        <td>

                            <div style="
                                color:#45545c;
                                font-size:11px;
                            ">

                                {{ $agent->city }}

                            </div>

                            <div style="
                                margin-top:3px;
                                color:#9aa3a8;
                                font-size:9px;
                            ">

                                {{ $agent->region }}

                            </div>

                        </td>


                        <!-- STATUS -->

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


                        <!-- DATE -->

                        <td>

                            <div style="
                                color:#536169;
                                font-size:10px;
                                white-space:nowrap;
                            ">

                                {{ $agent->created_at
                                    ? $agent->created_at->format('d M Y')
                                    : '—'
                                }}

                            </div>

                            <div style="
                                margin-top:3px;
                                color:#9aa3a8;
                                font-size:9px;
                            ">

                                {{ $agent->created_at
                                    ? $agent->created_at->format('H:i')
                                    : ''
                                }}

                            </div>

                        </td>


                        <!-- ACTION -->

                        <td style="
                            text-align:right;
                        ">

                            <a
                                href="{{ route('admin.agents.show', $agent->id) }}"
                                class="button"
                                style="
                                    padding:8px 13px;
                                    font-size:9px;
                                    white-space:nowrap;
                                "
                            >

                                Review Application →

                            </a>

                        </td>


                    </tr>

                @empty


                    <!-- EMPTY STATE -->

                    <tr>

                        <td
                            colspan="8"
                            style="
                                text-align:center;
                                padding:70px 30px;
                            "
                        >

                            <div style="
                                width:55px;
                                height:55px;
                                margin:0 auto 15px;
                                border-radius:50%;
                                background:#eef4f7;
                                display:flex;
                                align-items:center;
                                justify-content:center;
                                color:#063b5c;
                                font-size:23px;
                            ">

                                ▣

                            </div>


                            <div style="
                                color:#263238;
                                font-size:14px;
                                font-weight:700;
                            ">

                                No applications found

                            </div>


                            <div style="
                                margin-top:7px;
                                color:#929ca2;
                                font-size:10px;
                            ">

                                New agent registration applications will appear here.

                            </div>

                        </td>

                    </tr>


                @endforelse

            </tbody>

        </table>

    </div>


    <!-- TABLE FOOTER -->

    @if($total > 0)

        <div style="
            padding:13px 23px;
            border-top:1px solid #e8edf0;
            background:#fafcfd;
            color:#929ca2;
            font-size:9px;
        ">

            Showing {{ $total }}
            application{{ $total == 1 ? '' : 's' }}

        </div>

    @endif


</div>


<!-- =========================================================
     RESPONSIVE
========================================================= -->

<style>

@media (max-width: 1100px) {

    div[style*="grid-template-columns:repeat(5"] {
        grid-template-columns:repeat(3, minmax(0, 1fr)) !important;
    }

}

@media (max-width: 700px) {

    div[style*="grid-template-columns:repeat(5"] {
        grid-template-columns:repeat(2, minmax(0, 1fr)) !important;
    }

}

@media (max-width: 480px) {

    div[style*="grid-template-columns:repeat(5"] {
        grid-template-columns:1fr !important;
    }

}

</style>

@endsection