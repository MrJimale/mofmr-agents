<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        MFMR Agent ID Card - {{ $agent->name }}
    </title>


    <style>

        @page {
            size: A4;
            margin: 0;
        }


        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            padding: 40px;
            background: #eef2f5;

            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =========================================
           BUTTON AREA
        ========================================= */

        .button-area {
            display: flex;
            justify-content: center;
            align-items: center;

            gap: 10px;

            margin-bottom: 25px;
        }


        .print-button {
            padding: 11px 24px;

            background: #063b5c;
            color: white;

            border: none;
            border-radius: 6px;

            font-size: 13px;
            font-weight: bold;

            cursor: pointer;
        }


        .print-button:hover {
            background: #042f4b;
        }


        .back-button {
            display: inline-block;

            padding: 10px 20px;

            background: white;
            color: #063b5c;

            border: 1px solid #063b5c;
            border-radius: 6px;

            font-size: 13px;
            font-weight: bold;

            text-decoration: none;
        }


        .back-button:hover {
            background: #063b5c;
            color: white;
        }


        /* =========================================
           ID CARD
        ========================================= */

        .id-card {
            width: 540px;
            height: 340px;

            margin: 0 auto;

            background: #ffffff;

            position: relative;

            overflow: hidden;

            border-radius: 18px;
            border: 1px solid #cfd8de;

            box-shadow:
                0 12px 35px rgba(0, 0, 0, 0.18);
        }


        /* =========================================
           MINISTRY WATERMARK
        ========================================= */

        .watermark {
            position: absolute;

            width: 280px;
            height: 280px;

            object-fit: contain;

            left: 150px;
            top: 45px;

            opacity: 0.11;

            z-index: 0;

            pointer-events: none;
        }


        /* =========================================
           DECORATIVE CIRCLES
        ========================================= */

        .decorative-circle {
            position: absolute;

            width: 180px;
            height: 180px;

            border: 1px solid rgba(6,59,92,0.08);

            border-radius: 50%;

            right: -75px;
            top: 95px;

            z-index: 1;
        }


        .decorative-circle-two {
            position: absolute;

            width: 120px;
            height: 120px;

            border: 1px solid rgba(213,169,40,0.15);

            border-radius: 50%;

            right: -45px;
            top: 125px;

            z-index: 1;
        }


        /* =========================================
           HEADER
        ========================================= */

        .header {
            height: 82px;

            background:
                linear-gradient(
                    135deg,
                    #063b5c,
                    #07547e
                );

            color: white;

            position: relative;

            padding: 12px 20px;

            z-index: 2;
        }


        /* =========================================
           CENTERED MINISTRY LOGO
        ========================================= */

        .logo {
            width: 58px;
            height: 58px;

            object-fit: cover;

            border-radius: 50%;

            position: absolute;

            left: 50%;
            top: 12px;

            transform: translateX(-50%);

            background: white;

            padding: 3px;

            border: 2px solid #d5a928;

            box-shadow:
                0 2px 8px rgba(0,0,0,0.25);
        }


        /* =========================================
           MINISTRY NAME
        ========================================= */

        .ministry {
            position: absolute;

            left: 20px;
            top: 18px;

            font-size: 12px;

            font-weight: bold;

            letter-spacing: 0.4px;

            line-height: 1.3;

            opacity: 0.95;
        }


        .government {
            position: absolute;

            left: 20px;
            top: 53px;

            font-size: 7px;

            letter-spacing: 1.5px;

            opacity: 0.85;
        }


        /* =========================================
           CARD TYPE
        ========================================= */

        .card-type {
            position: absolute;

            right: 20px;
            top: 25px;

            text-align: right;

            font-size: 8px;

            font-weight: bold;

            letter-spacing: 1.2px;

            line-height: 1.5;
        }


        /* =========================================
           GOLD LINE
        ========================================= */

        .gold-line {
            position: absolute;

            left: 0;
            bottom: 0;

            width: 100%;
            height: 4px;

            background: #d5a928;

            z-index: 3;
        }


        /* =========================================
           MAIN
        ========================================= */

        .main {
            position: relative;

            height: 208px;

            padding: 18px 20px;

            z-index: 2;
        }


        /* =========================================
           PHOTO
        ========================================= */

        .photo-container {
            position: absolute;

            left: 20px;
            top: 20px;

            width: 112px;
            height: 135px;

            background: white;

            border-radius: 8px;

            padding: 4px;

            border: 2px solid #063b5c;

            box-shadow:
                0 4px 12px rgba(0,0,0,0.12);

            overflow: hidden;
        }


        .photo-container img {
            width: 100%;
            height: 100%;

            object-fit: cover;

            border-radius: 4px;

            display: block;
        }


        .no-photo {
            width: 100%;
            height: 100%;

            display: flex;

            justify-content: center;
            align-items: center;

            text-align: center;

            font-size: 10px;

            color: #777;
        }


        /* =========================================
           INFORMATION
        ========================================= */

        .information {
            position: absolute;

            left: 152px;
            top: 20px;

            width: 350px;
        }


        .authorized {
            font-size: 8px;

            color: #777;

            letter-spacing: 2px;

            font-weight: bold;

            margin-bottom: 4px;
        }


        .agent-name {
            font-size: 22px;

            font-weight: bold;

            color: #063b5c;

            margin-bottom: 13px;

            white-space: nowrap;
        }


        /* =========================================
           DETAILS
        ========================================= */

        .details {
            display: grid;

            grid-template-columns: 82px 1fr;

            row-gap: 7px;

            font-size: 10px;
        }


        .label {
            font-weight: bold;

            color: #68747c;
        }


        .value {
            color: #15191c;

            font-weight: 500;
        }


        /* =========================================
           ID NUMBER
        ========================================= */

        .id-number {
            margin-top: 13px;

            display: inline-block;

            background: #063b5c;

            color: white;

            padding: 7px 12px;

            border-radius: 5px;

            font-size: 9px;

            font-weight: bold;

            letter-spacing: 0.8px;
        }


        /* =========================================
           APPROVED SEAL
        ========================================= */

        .seal {
            position: absolute;

            right: 25px;
            bottom: 18px;

            width: 65px;
            height: 65px;

            border: 2px solid #063b5c;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            text-align: center;

            color: #063b5c;

            font-size: 7px;

            font-weight: bold;

            line-height: 1.25;

            transform: rotate(-10deg);

            background:
                rgba(255,255,255,0.75);
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            position: absolute;

            bottom: 0;
            left: 0;

            width: 100%;
            height: 50px;

            background: #f5f7f8;

            border-top: 1px solid #dce1e4;

            padding: 8px 20px;

            z-index: 2;
        }


        .footer-left {
            font-size: 7px;

            color: #6b7378;

            line-height: 1.5;
        }


        .footer-title {
            color: #063b5c;

            font-weight: bold;

            font-size: 8px;

            margin-bottom: 2px;
        }


        /* =========================================
           SIGNATURE
        ========================================= */

        .signature {
            position: absolute;

            right: 20px;
            top: 9px;

            width: 105px;

            text-align: center;

            font-size: 7px;

            color: #555;
        }


        .signature-line {
            border-top: 1px solid #555;

            margin-bottom: 3px;
        }


        /* =========================================
           BOTTOM STRIPE
        ========================================= */

        .bottom-stripe {
            position: absolute;

            left: 0;
            bottom: 0;

            width: 100%;
            height: 4px;

            background: #063b5c;

            z-index: 4;
        }


        /* =========================================
           PRINT
        ========================================= */

        @media print {

            body {
                background: white;

                padding: 0;
            }


            .button-area {
                display: none;
            }


            .id-card {
                margin: 20px;

                box-shadow: none;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     BUTTONS
====================================================== -->

<div class="button-area">

    <a
        href="{{ route('admin.dashboard') }}"
        class="back-button"
    >
        ← Back to Dashboard
    </a>


    <button
        type="button"
        class="print-button"
        onclick="window.print()"
    >
        Print ID Card
    </button>

</div>



<!-- =====================================================
     ID CARD
====================================================== -->

<div class="id-card">


    <!-- =================================================
         MINISTRY WATERMARK
    ================================================== -->

    <img
        class="watermark"

        src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-1/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s200x200&_nc_cat=100&ccb=1-7&_nc_sid=2d3e12&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=24&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=g37aO5w2zhLRBGgZgEqskQ&_nc_ss=7b2a8&oh=00_AQIB47Us0RXGHb9eP8kcD358YN7HKfyaz7gZTNNuXabjDQ&oe=6A99034E"

        alt="Ministry Logo"
    >



    <!-- =================================================
         DECORATION
    ================================================== -->

    <div class="decorative-circle"></div>

    <div class="decorative-circle-two"></div>



    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="header">


        <!-- CENTERED MINISTRY LOGO -->

        <img
            class="logo"

            src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-1/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s200x200&_nc_cat=100&ccb=1-7&_nc_sid=2d3e12&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=24&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=g37aO5w2zhLRBGgZgEqskQ&_nc_ss=7b2a8&oh=00_AQIB47Us0RXGHb9eP8kcD358YN7HKfyaz7gZTNNuXabjDQ&oe=6A99034E"

            alt="Ministry Logo"
        >


        <!-- MINISTRY -->

        <div class="ministry">

            MINISTRY OF FISHERIES

            <br>

            & MARINE RESOURCES

        </div>


        <!-- GOVERNMENT -->

        <div class="government">

            GOVERNMENT OF PUNTLAND, SOMALIA

        </div>


        <!-- CARD TYPE -->

        <div class="card-type">

            OFFICIAL AGENT

            <br>

            IDENTIFICATION CARD

        </div>


        <div class="gold-line"></div>

    </div>



    <!-- =================================================
         MAIN
    ================================================== -->

    <div class="main">


        <!-- =================================================
             AGENT PHOTO
        ================================================== -->

        <div class="photo-container">

            {{-- IMPORTANT:
                 Controller passes $photoUrl to this view.
                 The photo itself remains private.
            --}}

            @if($photoUrl)

                <img
                    src="{{ $photoUrl }}"
                    alt="{{ $agent->name }}"
                >

            @else

                <div class="no-photo">

                    NO PHOTO

                </div>

            @endif

        </div>



        <!-- =================================================
             AGENT INFORMATION
        ================================================== -->

        <div class="information">


            <div class="authorized">

                REGISTERED FISHERIES AGENT

            </div>


            <div class="agent-name">

                {{ $agent->name }}

            </div>


            <div class="details">


                <div class="label">

                    ID Number

                </div>

                <div class="value">

                    {{ $agent->registration_number ?? 'N/A' }}

                </div>


                <div class="label">

                    Phone

                </div>

                <div class="value">

                    {{ $agent->phone }}

                </div>


                <div class="label">

                    Region

                </div>

                <div class="value">

                    {{ $agent->region }}

                </div>


                <div class="label">

                    City

                </div>

                <div class="value">

                    {{ $agent->city }}

                </div>


                <div class="label">

                    Country

                </div>

                <div class="value">

                    {{ $agent->country }}

                </div>


                <div class="label">

                    Status

                </div>

                <div class="value">

                    ACTIVE / APPROVED

                </div>


            </div>


            <div class="id-number">

                MFMR AGENT:

                {{ $agent->registration_number ?? 'N/A' }}

            </div>


        </div>



        <!-- =================================================
             APPROVAL SEAL
        ================================================== -->

        <div class="seal">

            OFFICIAL

            <br>

            MFMR

            <br>

            APPROVED

        </div>


    </div>



    <!-- =================================================
         FOOTER
    ================================================== -->

    <div class="footer">


        <div class="footer-left">


            <div class="footer-title">

                MINISTRY OF FISHERIES & MARINE RESOURCES

            </div>


            Registered and approved Fisheries & Marine Resources Agent.

            <br>


            Registered:

            @if($agent->approved_at)

                {{ $agent->approved_at->format('d F Y') }}

            @else

                N/A

            @endif


        </div>



        <!-- SIGNATURE -->

        <div class="signature">

            <div class="signature-line"></div>

            Authorized Officer

        </div>


    </div>



    <!-- BOTTOM STRIPE -->

    <div class="bottom-stripe"></div>


</div>


</body>

</html>
