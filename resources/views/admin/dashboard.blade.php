@extends('layouts.admin')

@section('title', 'MFMR | Dashboard')

@section('page-title', 'Administration')


@section('content')


<div class="welcome">

    <h1 style="color:#063b5c;margin:0;font-size:24px;">
        Dashboard
    </h1>

    <p style="color:#7b858c;font-size:12px;">
        Overview of agent registration applications and approvals.
    </p>

</div>


<!-- STATISTICS -->

<div style="
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:16px;
">


    <div class="box">

        <small>TOTAL APPLICATIONS</small>

        <h2 style="color:#063b5c;">
            {{ $total }}
        </h2>

    </div>


    <div class="box">

        <small>PENDING REVIEW</small>

        <h2 style="color:#d5a928;">
            {{ $pending }}
        </h2>

    </div>


    <div class="box">

        <small>APPROVED AGENTS</small>

        <h2 style="color:#198754;">
            {{ $approved }}
        </h2>

    </div>


    <div class="box">

        <small>DENIED</small>

        <h2 style="color:#dc3545;">
            {{ $denied }}
        </h2>

    </div>


    <div class="box">

        <small>CORRECTION REQUIRED</small>

        <h2 style="color:#fd7e14;">
            {{ $correction }}
        </h2>

    </div>


</div>


<!-- ACTIONS -->

<div style="margin:20px 0;">

    <a
        href="{{ route('admin.agents') }}"
        class="button"
    >
        View Applications
    </a>


    <a
        href="{{ route('admin.approved') }}"
        class="button gold"
    >
        Approved Agents
    </a>

</div>


<!-- RECENT APPLICATIONS -->

<div class="box">


    <div style="
        display:flex;
        justify-content:space-between;
        margin-bottom:20px;
    ">

        <h2 style="
            margin:0;
            color:#063b5c;
            font-size:17px;
        ">

            Recent Applications

        </h2>


        <a
            href="{{ route('admin.agents') }}"
            style="
                color:#063b5c;
                font-size:10px;
                font-weight:bold;
                text-decoration:none;
            "
        >

            VIEW ALL →

        </a>

    </div>


    <table>

        <thead>

            <tr>

                <th>ID</th>
                <th>AGENT</th>
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

                <td>
                    #{{ $agent->id }}
                </td>


                <td>

                    <strong>
                        {{ $agent->name }}
                    </strong>

                </td>


                <td>
                    {{ $agent->phone }}
                </td>


                <td>
                    {{ $agent->region }}
                </td>


                <td>
                    {{ $agent->city }}
                </td>


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


                <td>

                    <a
                        href="{{ route('admin.agents.show', $agent) }}"
                        style="
                            color:#063b5c;
                            font-weight:bold;
                            text-decoration:none;
                        "
                    >

                        Review →

                    </a>

                </td>

            </tr>


            @empty


            <tr>

                <td
                    colspan="7"
                    style="
                        text-align:center;
                        padding:35px;
                        color:#888;
                    "
                >

                    No applications found.

                </td>

            </tr>


            @endforelse


        </tbody>

    </table>


</div>


@endsection