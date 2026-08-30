@extends('layouts.app')

@section('title', 'Track Application')

@section('content')

<div class="card p-4">

    <h3 class="mb-2">
        Track Your Application
    </h3>

    <p class="text-muted mb-4">
        Enter your MFMR application tracking code to check its current status.
    </p>


    {{-- ERROR --}}

    @if(session('error'))

        <div class="alert alert-danger">

            {{ session('error') }}

        </div>

    @endif


    {{-- TRACKING FORM --}}

    <form
        method="POST"
        action="{{ route('application.track.check') }}"
        class="mb-4"
    >

        @csrf


        <div class="mb-3">

            <label class="form-label">

                Application Tracking Code

            </label>

            <input
                type="text"
                name="tracking_code"
                class="form-control"
                value="{{ old('tracking_code') }}"
                placeholder="Example: MFMR-2026-K7P4XZ"
                required
            >

        </div>


        <button
            type="submit"
            class="btn btn-primary"
        >

            Track Application

        </button>

    </form>


    {{-- =====================================================
         APPLICATION RESULT
    ====================================================== --}}

    @isset($agent)

        <hr class="my-4">


        <div class="mb-4">

            <h5 class="mb-1">

                Application Status

            </h5>

            <p class="text-muted mb-0">

                Application information

            </p>

        </div>


        {{-- TRACKING CODE --}}

        <div class="mb-3">

            <strong>
                Tracking Code:
            </strong>

            <span class="ms-2">

                {{ $agent->tracking_code }}

            </span>

        </div>


        {{-- APPLICANT --}}

        <div class="mb-3">

            <strong>
                Applicant:
            </strong>

            <span class="ms-2">

                {{ $agent->name }}

            </span>

        </div>


        {{-- LOCATION --}}

        <div class="mb-3">

            <strong>
                Location:
            </strong>

            <span class="ms-2">

                {{ $agent->city }}, {{ $agent->region }}, {{ $agent->country }}

            </span>

        </div>


        {{-- STATUS --}}

        <div class="mb-3">

            <strong>
                Current Status:
            </strong>


            @if($agent->status === 'pending')

                <span class="badge bg-warning text-dark ms-2">

                    UNDER REVIEW

                </span>


            @elseif($agent->status === 'approved')

                <span class="badge bg-success ms-2">

                    APPROVED

                </span>


            @elseif($agent->status === 'correction_required')

                <span class="badge bg-warning text-dark ms-2">

                    CORRECTION REQUIRED

                </span>


            @elseif($agent->status === 'denied')

                <span class="badge bg-danger ms-2">

                    DENIED

                </span>


            @else

                <span class="badge bg-secondary ms-2">

                    {{ strtoupper(str_replace('_', ' ', $agent->status)) }}

                </span>

            @endif

        </div>


        {{-- =================================================
             STATUS MESSAGE
        ================================================== --}}


        @if($agent->status === 'pending')

            <div class="alert alert-info mt-4">

                <strong>
                    Your application has been received.
                </strong>

                <br>

                The Ministry of Fisheries & Marine Resources
                is currently reviewing your application.

                Please keep your tracking code safe and check
                again later.

            </div>


        @elseif($agent->status === 'approved')

            <div class="alert alert-success mt-4">

                <strong>
                    Congratulations! Your application has been approved.
                </strong>

                <br>

                Your Ministry registration has been successfully approved.

                @if($agent->registration_number)

                    <br><br>

                    <strong>
                        Registration Number:
                    </strong>

                    {{ $agent->registration_number }}

                @endif

            </div>


        @elseif($agent->status === 'correction_required')

            <div class="alert alert-warning mt-4">

                <strong>
                    Correction Required
                </strong>

                <br>

                The Ministry has requested changes to your application.

                @if($agent->admin_comment)

                    <hr>

                    <strong>
                        Ministry Comment:
                    </strong>

                    <br>

                    {{ $agent->admin_comment }}

                @endif

            </div>


        @elseif($agent->status === 'denied')

            <div class="alert alert-danger mt-4">

                <strong>
                    Application Denied
                </strong>

                <br>

                Your application has been denied by the
                Ministry of Fisheries & Marine Resources.

                @if($agent->admin_comment)

                    <hr>

                    <strong>
                        Ministry Comment:
                    </strong>

                    <br>

                    {{ $agent->admin_comment }}

                @endif

            </div>

        @endif


        {{-- APPROVED DOCUMENTS --}}

        @if($agent->status === 'approved')

            <div class="mt-4">

                <p class="text-muted mb-2">

                    Your registration has been approved.
                    Please contact the Ministry if you require
                    your official certificate or ID card.

                </p>

            </div>

        @endif


    @endisset

</div>

@endsection