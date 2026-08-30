@extends('layouts.app')

@section('title', 'Agent Registration')

@section('content')

<div class="card p-4">

    {{-- =====================================================
         MINISTRY HEADER
    ====================================================== --}}

    <div class="text-center mb-4">

        <img
            src="{{ asset('mfmr-logo.jpg') }}"
            alt="Ministry of Fisheries and Marine Resources"
            style="
                width:90px;
                height:90px;
                object-fit:cover;
                border-radius:50%;
                border:3px solid #d5a928;
                padding:4px;
                background:#fff;
                box-shadow:0 3px 12px rgba(0,0,0,.15);
            "
        >

        <h5 style="
            margin-top:12px;
            margin-bottom:2px;
            color:#063b5c;
            font-weight:700;
            letter-spacing:.4px;
        ">
            MINISTRY OF FISHERIES
            <br>
            & MARINE RESOURCES
        </h5>

        <div style="
            font-size:11px;
            color:#6c757d;
            font-weight:600;
            letter-spacing:1px;
        ">
            PUNTLAND STATE OF SOMALIA
        </div>

    </div>


    {{-- =====================================================
         SUCCESS MESSAGE
    ====================================================== --}}

    @if(session('success'))

        <div
            id="confirmation"
            class="text-center p-4 mb-4"
            style="
                border-radius:12px;
                border:1px solid #d5e8dc;
                background:#f4fbf6;
            "
        >

            <div style="
                width:60px;
                height:60px;
                margin:0 auto 15px;
                border-radius:50%;
                background:#d1e7dd;
                color:#198754;
                display:flex;
                align-items:center;
                justify-content:center;
                font-size:30px;
                font-weight:bold;
            ">
                ✓
            </div>


            <h3 style="
                color:#063b5c;
                margin-bottom:10px;
            ">
                Application Submitted Successfully
            </h3>


            <p style="
                font-size:13px;
                line-height:1.6;
                color:#555;
                margin-bottom:8px;
            ">

                Your application has been successfully submitted to the

                <strong>
                    Ministry of Fisheries & Marine Resources.
                </strong>

            </p>


            <p style="
                font-size:12px;
                color:#777;
            ">

                Puntland State of Somalia

            </p>


            @if(session('tracking_code'))

                <div style="margin-top:25px;">

                    <div style="
                        font-size:9px;
                        font-weight:bold;
                        letter-spacing:2px;
                        color:#6c757d;
                        margin-bottom:8px;
                    ">

                        YOUR APPLICATION TRACKING CODE

                    </div>


                    <div
                        id="trackingCode"
                        style="
                            display:inline-block;
                            background:#063b5c;
                            color:white;
                            padding:14px 25px;
                            border-radius:7px;
                            font-size:20px;
                            font-weight:bold;
                            letter-spacing:2px;
                        "
                    >

                        {{ session('tracking_code') }}

                    </div>


                    <p style="
                        margin-top:12px;
                        font-size:11px;
                        color:#777;
                    ">

                        Please keep this code safe.
                        You will need it to track your application.

                    </p>

                </div>


                <div
                    class="no-print"
                    style="
                        margin-top:22px;
                        display:flex;
                        justify-content:center;
                        gap:8px;
                        flex-wrap:wrap;
                    "
                >

                    <button
                        type="button"
                        onclick="copyTrackingCode()"
                        class="btn btn-secondary"
                    >
                        Copy Code
                    </button>


                    <button
                        type="button"
                        onclick="window.print()"
                        class="btn btn-primary"
                    >
                        Print / Save PDF
                    </button>


                    <a
                        href="{{ route('application.track') }}"
                        class="btn btn-success"
                    >
                        Track Application
                    </a>

                </div>


                <div
                    id="copyMessage"
                    style="
                        display:none;
                        margin-top:12px;
                        font-size:11px;
                        color:#198754;
                        font-weight:bold;
                    "
                >
                    Tracking code copied successfully.
                </div>

            @endif

        </div>


    @else


        {{-- =====================================================
             REGISTRATION FORM
        ====================================================== --}}

        <h3 class="mb-1">
            Agent Registration
        </h3>

        <p class="text-muted mb-4">
            Apply for registration with the Ministry of Fisheries
            & Marine Resources.
        </p>


        {{-- VALIDATION ERRORS --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>
                    Please correct the following:
                </strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('agent.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf


            <h5 class="mb-3">
                Agent Information
            </h5>


            <div class="row">


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Agent Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="{{ old('name') }}"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Phone
                    </label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="{{ old('phone') }}"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Email
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email') }}"
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Address
                    </label>

                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="{{ old('address') }}"
                        required
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Region
                    </label>

                    <input
                        type="text"
                        name="region"
                        class="form-control"
                        value="{{ old('region') }}"
                        required
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        City
                    </label>

                    <input
                        type="text"
                        name="city"
                        class="form-control"
                        value="{{ old('city') }}"
                        required
                    >

                </div>


                <div class="col-md-4 mb-3">

                    <label class="form-label">
                        Country
                    </label>

                    <input
                        type="text"
                        name="country"
                        class="form-control"
                        value="{{ old('country', 'Somalia') }}"
                        required
                    >

                </div>


                <div class="col-md-6 mb-3">

                    <label class="form-label">
                        Agent Photo
                    </label>

                    <input
                        type="file"
                        name="photo"
                        class="form-control"
                        accept="image/*"
                    >

                </div>

            </div>


            <hr class="my-4">


            <h5 class="mb-3">
                Required Documents
            </h5>


            <div class="mb-3">

                <label class="form-label">
                    TIN Number
                </label>

                <input
                    type="file"
                    name="tin"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Business License
                </label>

                <input
                    type="file"
                    name="business_license"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Company Profile
                </label>

                <input
                    type="file"
                    name="company_profile"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Account Number
                </label>

                <input
                    type="file"
                    name="account_number"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-3">

                <label class="form-label">
                    Fisheries / Marine License
                </label>

                <input
                    type="file"
                    name="fisheries_license"
                    class="form-control"
                    required
                >

            </div>


            <div class="mb-4">

                <label class="form-label">
                    National ID / Registration Document
                </label>

                <input
                    type="file"
                    name="national_id"
                    class="form-control"
                    required
                >

            </div>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Submit Registration
            </button>

        </form>

    @endif

</div>


<style>

@media print {

    body * {
        visibility: hidden;
    }

    #confirmation,
    #confirmation * {
        visibility: visible;
    }

    #confirmation {

        position: absolute;

        left: 0;

        top: 0;

        width: 100%;

        background: white !important;

        color: #000 !important;

        box-shadow: none !important;

    }

    .no-print {
        display: none !important;
    }

}

</style>


<script>

function copyTrackingCode()
{
    const code =
        document
        .getElementById('trackingCode')
        .innerText
        .trim();

    navigator.clipboard.writeText(code);

    const message =
        document.getElementById('copyMessage');

    message.style.display = 'block';

    setTimeout(function () {

        message.style.display = 'none';

    }, 2500);
}

</script>

@endsection
