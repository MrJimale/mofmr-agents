@extends('layouts.admin')

@section('title', 'MFMR | Agent Applications')

@section('page-title', 'Agent Applications')

@section('content')


<!-- PAGE HEADER -->

<div style="margin-bottom:25px;">

    <h1 style="
        margin:0;
        color:#063b5c;
        font-size:24px;
    ">
        Agent Applications
    </h1>

    <p style="
        margin:6px 0 0;
        color:#7b858c;
        font-size:12px;
    ">
        Review and manage agent registration applications.
    </p>

</div>


<!-- SUMMARY -->

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
        TOTAL APPLICATIONS
    </div>

    <div style="
        margin-top:7px;
        color:#063b5c;
        font-size:28px;
        font-weight:bold;
    ">
        {{ $agents->count() }}
    </div>

</div>


<!-- APPLICATION TABLE -->

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
                All Applications
            </h2>

            <div style="
                margin-top:5px;
                color:#929ca2;
                font-size:10px;
            ">
                Agent registration applications submitted to the Ministry
            </div>

        </div>

    </div>


    <table>

        <thead>

            <tr>

                <th>#</th>

                <th>AGENT NAME</th>

                <th>PHONE</th>

                <th>REGION</th>

                <th>CITY</th>

                <th>STATUS</th>

                <th>ACTION</th>

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


                    <!-- PHONE -->

                    <td>

                        {{ $agent->phone }}

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


                    <!-- ACTION -->

                    <td>

                        <a
                            href="{{ route('admin.agents.show', $agent->id) }}"
                            class="button"
                            style="
                                padding:7px 12px;
                                font-size:9px;
                            "
                        >

                            View Application →

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
                            color:#063b5c;
                            margin-bottom:10px;
                        ">
                            ▣
                        </div>

                        <strong>
                            No applications found
                        </strong>

                        <div style="
                            margin-top:5px;
                            font-size:11px;
                        ">
                            New agent applications will appear here.
                        </div>

                    </td>

                </tr>


            @endforelse


        </tbody>

    </table>


</div>


@endsection