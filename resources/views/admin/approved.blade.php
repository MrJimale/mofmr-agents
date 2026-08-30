@extends('layouts.admin')

@section('title', 'MFMR | Approved Agents')

@section('page-title', 'Approved Agents')

@section('content')


<!-- PAGE HEADER -->

<div style="margin-bottom:25px;">

    <h1 style="
        margin:0;
        color:#063b5c;
        font-size:24px;
    ">
        Approved Agents
    </h1>

    <p style="
        margin:6px 0 0;
        color:#7b858c;
        font-size:12px;
    ">
        Official list of agents approved by the Ministry of Fisheries & Marine Resources.
    </p>

</div>


<!-- SUMMARY CARD -->

<div
    class="box"
    style="
        display:inline-block;
        min-width:210px;
        margin-bottom:20px;
        padding:18px 22px;
    "
>

    <div style="
        color:#7b858c;
        font-size:9px;
        font-weight:bold;
        letter-spacing:.5px;
    ">
        APPROVED AGENTS
    </div>

    <div style="
        margin-top:7px;
        color:#198754;
        font-size:28px;
        font-weight:bold;
    ">
        {{ $agents->count() }}
    </div>

</div>


<!-- AGENTS TABLE -->

<div class="box">

    <div style="
        display:flex;
        justify-content:space-between;
        align-items:center;
        margin-bottom:20px;
    ">

        <div>

            <h2 style="
                margin:0;
                color:#063b5c;
                font-size:17px;
            ">
                Registered Agents
            </h2>

            <div style="
                margin-top:5px;
                color:#929ca2;
                font-size:10px;
            ">
                Agents with approved registration status
            </div>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>AGENT NAME</th>

                <th>REGISTRATION NUMBER</th>

                <th>REGION</th>

                <th>CITY</th>

                <th>STATUS</th>

                <th>ACTIONS</th>

            </tr>

        </thead>


        <tbody>


            @forelse($agents as $agent)


                <tr>


                    <!-- ID -->

                    <td>

                        #{{ $agent->id }}

                    </td>


                    <!-- NAME -->

                    <td>

                        <strong style="color:#263238;">

                            {{ $agent->name }}

                        </strong>

                    </td>


                    <!-- REGISTRATION -->

                    <td>

                        <span style="
                            display:inline-block;
                            padding:5px 9px;
                            background:#eef3f6;
                            color:#063b5c;
                            border-radius:4px;
                            font-size:10px;
                            font-weight:bold;
                        ">

                            {{ $agent->registration_number }}

                        </span>

                    </td>


                    <!-- REGION -->

                    <td>

                        {{ $agent->region }}

                    </td>


                    <!-- CITY -->

                    <td>

                        {{ $agent->city }}

                    </td>


                    <!-- STATUS -->

                    <td>

                        <span class="status approved">

                            APPROVED

                        </span>

                    </td>


                    <!-- ACTIONS -->

                    <td>


                        <a
                            href="{{ route('admin.certificate', $agent) }}"
                            target="_blank"
                            class="button"
                            style="
                                padding:7px 10px;
                                font-size:9px;
                            "
                        >

                            Certificate

                        </a>


                        <a
                            href="{{ route('admin.id-card', $agent) }}"
                            target="_blank"
                            class="button gold"
                            style="
                                padding:7px 10px;
                                font-size:9px;
                            "
                        >

                            ID Card

                        </a>


                    </td>


                </tr>


            @empty


                <tr>

                    <td
                        colspan="7"
                        style="
                            text-align:center;
                            padding:50px;
                            color:#888;
                        "
                    >

                        <div style="
                            font-size:28px;
                            color:#198754;
                            margin-bottom:10px;
                        ">
                            ✓
                        </div>

                        <strong>
                            No approved agents
                        </strong>

                        <div style="
                            margin-top:5px;
                            font-size:11px;
                        ">
                            Approved applications will appear here.
                        </div>

                    </td>

                </tr>


            @endforelse


        </tbody>

    </table>


</div>


@endsection