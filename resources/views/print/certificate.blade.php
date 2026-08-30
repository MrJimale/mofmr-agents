<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <title>
        MFMR Certificate - {{ $agent->name }}
    </title>

    <style>

        @page {
            size: A4 landscape;
            margin: 0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 35px;
            background: #e9eef2;
            font-family:
                Arial,
                Helvetica,
                sans-serif;
        }


        /* =========================================
           TOP BUTTONS
        ========================================= */

        .button-area {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            margin: 0 auto 20px;
        }


        .print-button {
            display: inline-block;
            padding: 11px 25px;
            background: #063b5c;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            text-decoration: none;
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
            cursor: pointer;
        }


        .back-button:hover {
            background: #063b5c;
            color: white;
        }


        /* =========================================
           CERTIFICATE
        ========================================= */

        .certificate {
            width: 1120px;
            height: 790px;
            margin: 0 auto;
            position: relative;
            overflow: hidden;
            background: #ffffff;
            border-radius: 8px;
            box-shadow:
                0 18px 45px rgba(0,0,0,0.18);
        }


        /* =========================================
           MAIN NAVY FRAME
        ========================================= */

        .navy-frame {
            position: absolute;
            inset: 12px;
            border: 2px solid #063b5c;
            z-index: 5;
            pointer-events: none;
        }


        /* =========================================
           GOLD INNER FRAME
        ========================================= */

        .gold-frame {
            position: absolute;
            inset: 21px;
            border: 1px solid #d5a928;
            z-index: 5;
            pointer-events: none;
        }


        /* =========================================
           TOP NAVY HEADER
        ========================================= */

        .top {
            height: 185px;

            background:
                linear-gradient(
                    135deg,
                    #042f4b 0%,
                    #063b5c 55%,
                    #07547e 100%
                );

            position: relative;
            overflow: hidden;
            color: white;
        }


        /* =========================================
           HEADER DECORATIVE SHAPES
        ========================================= */

        .top-circle {
            position: absolute;
            width: 300px;
            height: 300px;
            border:
                1px solid rgba(255,255,255,0.12);
            border-radius: 50%;
            right: -100px;
            top: -180px;
        }


        .top-circle-two {
            position: absolute;
            width: 210px;
            height: 210px;
            border:
                1px solid rgba(213,169,40,0.30);
            border-radius: 50%;
            left: -80px;
            top: -120px;
        }


        .gold-bar {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 6px;
            background: #d5a928;
        }


        /* =========================================
           MINISTRY LOGO
        ========================================= */

        .ministry-logo {
            position: absolute;
            width: 108px;
            height: 108px;
            left: 50%;
            top: 18px;
            transform: translateX(-50%);
            object-fit: cover;
            border-radius: 50%;
            background: white;
            padding: 4px;
            border:
                3px solid #d5a928;
            box-shadow:
                0 5px 18px rgba(0,0,0,0.35);
            z-index: 5;
        }


        /* =========================================
           LEFT HEADER TEXT
        ========================================= */

        .header-left {
            position: absolute;
            left: 45px;
            top: 48px;
            width: 330px;
        }


        .header-left .main {
            font-size: 21px;
            font-weight: bold;
            line-height: 1.25;
            letter-spacing: 0.5px;
        }


        .header-left .sub {
            margin-top: 9px;
            font-size: 9px;
            letter-spacing: 2px;
            opacity: 0.85;
        }


        /* =========================================
           RIGHT HEADER TEXT
        ========================================= */

        .header-right {
            position: absolute;
            right: 45px;
            top: 55px;
            width: 300px;
            text-align: right;
        }


        .header-right .small {
            font-size: 9px;
            letter-spacing: 2px;
            opacity: 0.75;
        }


        .header-right .title {
            margin-top: 7px;
            font-size: 15px;
            font-weight: bold;
            letter-spacing: 2px;
        }


        /* =========================================
           WATERMARK
        ========================================= */

        .watermark {
            position: absolute;
            width: 500px;
            height: 500px;
            object-fit: contain;
            left: 310px;
            top: 245px;
            opacity: 0.075;
            z-index: 1;
            pointer-events: none;
        }


        /* =========================================
           CONTENT AREA
        ========================================= */

        .content {
            position: relative;
            z-index: 3;
            text-align: center;
            padding-top: 38px;
        }


        .eyebrow {
            font-size: 9px;
            font-weight: bold;
            color: #d5a928;
            letter-spacing: 4px;
        }


        .certificate-title {
            margin-top: 7px;
            font-family:
                Georgia,
                "Times New Roman",
                serif;
            font-size: 39px;
            color: #063b5c;
            letter-spacing: 2px;
            font-weight: bold;
        }


        .subtitle {
            margin-top: 5px;
            font-size: 10px;
            color: #7a858c;
            letter-spacing: 3px;
        }


        /* =========================================
           GOLD DIVIDER
        ========================================= */

        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 16px auto 18px;
        }


        .divider-line {
            width: 90px;
            height: 1px;
            background: #d5a928;
        }


        .diamond {
            width: 8px;
            height: 8px;
            background: #d5a928;
            transform: rotate(45deg);
        }


        /* =========================================
           INTRO
        ========================================= */

        .issued {
            font-family:
                Georgia,
                "Times New Roman",
                serif;
            font-size: 14px;
            color: #555;
        }


        /* =========================================
           AGENT NAME
        ========================================= */

        .agent-name {
            margin-top: 8px;
            font-family:
                Georgia,
                "Times New Roman",
                serif;
            font-size: 35px;
            font-weight: bold;
            color: #063b5c;
        }


        .name-line {
            width: 390px;
            height: 2px;
            background: #d5a928;
            margin: 8px auto 13px;
        }


        /* =========================================
           STATEMENT
        ========================================= */

        .statement {
            width: 735px;
            margin: 0 auto;
            font-family:
                Georgia,
                "Times New Roman",
                serif;
            font-size: 13px;
            line-height: 1.55;
            color: #555;
        }


        /* =========================================
           DETAILS PANEL
        ========================================= */

        .details-panel {
            width: 690px;
            margin: 17px auto 0;
            padding: 10px 15px;

            background:
                rgba(245,248,250,0.92);

            border:
                1px solid #dce3e7;

            border-left:
                4px solid #063b5c;

            border-right:
                4px solid #d5a928;
        }


        .details {
            width: 100%;
            border-collapse: collapse;
            font-size: 10px;
        }


        .details td {
            padding: 4px 9px;
        }


        .details .label {
            color: #063b5c;
            font-weight: bold;
            text-align: right;
            width: 150px;
        }


        .details .value {
            color: #222;
            text-align: left;
            font-weight: 500;
        }


        /* =========================================
           REGISTRATION NUMBER
        ========================================= */

        .registration {
            display: inline-block;
            margin-top: 14px;
            padding: 8px 20px;
            background: #063b5c;
            color: white;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
            letter-spacing: 1.2px;
            box-shadow:
                0 4px 10px rgba(6,59,92,0.18);
        }


        /* =========================================
           OFFICIAL SEAL
        ========================================= */

        .seal {
            position: absolute;
            right: 55px;
            top: 380px;
            width: 105px;
            height: 105px;
            border-radius: 50%;
            border:
                3px solid #063b5c;
            outline:
                1px solid #d5a928;
            outline-offset: -7px;
            background:
                rgba(255,255,255,0.90);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: #063b5c;
            font-size: 9px;
            font-weight: bold;
            line-height: 1.35;
            transform: rotate(-8deg);
            z-index: 6;
        }


        /* =========================================
           SIGNATURE AREA
        ========================================= */

        .signature-area {
            position: absolute;
            left: 55px;
            right: 55px;
            bottom: 55px;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            z-index: 6;
        }


        .signature {
            width: 220px;
            text-align: center;
            font-size: 9px;
            color: #555;
        }


        .signature-line {
            border-top:
                1px solid #555;
            margin-bottom: 6px;
        }


        .signature-title {
            color: #063b5c;
            font-weight: bold;
            font-size: 10px;
        }


        .signature-sub {
            margin-top: 2px;
            font-size: 8px;
        }


        /* =========================================
           CERTIFICATE NUMBER
        ========================================= */

        .certificate-number {
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            bottom: 65px;
            text-align: center;
            z-index: 6;
        }


        .certificate-number .label {
            font-size: 7px;
            color: #777;
            letter-spacing: 2px;
        }


        .certificate-number .number {
            margin-top: 3px;
            font-size: 9px;
            font-weight: bold;
            color: #063b5c;
            letter-spacing: 1px;
        }


        /* =========================================
           FOOTER
        ========================================= */

        .footer {
            position: absolute;
            left: 0;
            bottom: 0;
            width: 100%;
            height: 28px;
            background: #063b5c;
            color: white;
            text-align: center;
            padding-top: 8px;
            font-size: 7px;
            letter-spacing: 1.5px;
            z-index: 7;
        }


        /* =========================================
           CORNER DECORATIONS
        ========================================= */

        .corner {
            position: absolute;
            width: 55px;
            height: 55px;
            z-index: 6;
        }


        .corner-tl {
            top: 27px;
            left: 27px;
            border-top:
                3px solid #d5a928;
            border-left:
                3px solid #d5a928;
        }


        .corner-tr {
            top: 27px;
            right: 27px;
            border-top:
                3px solid #d5a928;
            border-right:
                3px solid #d5a928;
        }


        .corner-bl {
            bottom: 40px;
            left: 27px;
            border-bottom:
                3px solid #d5a928;
            border-left:
                3px solid #d5a928;
        }


        .corner-br {
            bottom: 40px;
            right: 27px;
            border-bottom:
                3px solid #d5a928;
            border-right:
                3px solid #d5a928;
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

            .certificate {
                margin: 0;
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
        class="print-button"
        onclick="window.print()"
    >
        Print Certificate
    </button>

</div>


<!-- =====================================================
     CERTIFICATE
====================================================== -->

<div class="certificate">


    <!-- FRAMES -->

    <div class="navy-frame"></div>

    <div class="gold-frame"></div>


    <!-- CORNERS -->

    <div class="corner corner-tl"></div>

    <div class="corner corner-tr"></div>

    <div class="corner corner-bl"></div>

    <div class="corner corner-br"></div>


    <!-- =================================================
         MINISTRY WATERMARK
    ================================================== -->

    <img
        class="watermark"
        src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-6/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s400x400&_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=23&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=n5ktm50L_ZUhEM1gfyk4yw&_nc_ss=7b2a8&oh=00_AQJNTZlCepFSAkMahK6yV1AkjeW7m53Vyyh1pVjEDDhFkg&oe=6A98EBD0"
        alt="Ministry Logo"
    >


    <!-- =================================================
         HEADER
    ================================================== -->

    <div class="top">


        <div class="top-circle"></div>

        <div class="top-circle-two"></div>


        <!-- CENTERED MINISTRY LOGO -->

        <img
            class="ministry-logo"
            src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-6/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s400x400&_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=23&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=n5ktm50L_ZUhEM1gfyk4yw&_nc_ss=7b2a8&oh=00_AQJNTZlCepFSAkMahK6yV1AkjeW7m53Vyyh1pVjEDDhFkg&oe=6A98EBD0"
            alt="Ministry Logo"
        >


        <!-- LEFT HEADER -->

        <div class="header-left">

            <div class="main">

                MINISTRY OF FISHERIES

                <br>

                & MARINE RESOURCES

            </div>


            <div class="sub">

                GOVERNMENT OF PUNTLAND, SOMALIA

            </div>

        </div>


        <!-- RIGHT HEADER -->

        <div class="header-right">

            <div class="small">

                OFFICIAL GOVERNMENT DOCUMENT

            </div>


            <div class="title">

                AGENT REGISTRATION

            </div>

        </div>


        <div class="gold-bar"></div>


    </div>


    <!-- =================================================
         CONTENT
    ================================================== -->

    <div class="content">


        <div class="eyebrow">

            FISHERIES & MARINE RESOURCES

        </div>


        <div class="certificate-title">

            CERTIFICATE OF REGISTRATION

        </div>


        <div class="subtitle">

            AUTHORIZED FISHERIES & MARINE RESOURCES AGENT

        </div>


        <!-- DIVIDER -->

        <div class="divider">

            <div class="divider-line"></div>

            <div class="diamond"></div>

            <div class="divider-line"></div>

        </div>


        <!-- ISSUED -->

        <div class="issued">

            This certificate is officially issued to

        </div>


        <!-- AGENT -->

        <div class="agent-name">

            {{ $agent->name }}

        </div>


        <div class="name-line"></div>


        <!-- STATEMENT -->

        <div class="statement">

            This is to certify that the above-named individual has been
            duly registered and approved by the Ministry of Fisheries
            & Marine Resources and is recognized as an authorized
            Fisheries & Marine Resources Agent.

        </div>


        <!-- DETAILS -->

        <div class="details-panel">

            <table class="details">

                <tr>

                    <td class="label">
                        Registration Number
                    </td>

                    <td class="value">
                        {{ $agent->registration_number ?? 'N/A' }}
                    </td>


                    <td class="label">
                        Region
                    </td>

                    <td class="value">
                        {{ $agent->region }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        City
                    </td>

                    <td class="value">
                        {{ $agent->city }}
                    </td>


                    <td class="label">
                        Country
                    </td>

                    <td class="value">
                        {{ $agent->country }}
                    </td>

                </tr>


                <tr>

                    <td class="label">
                        Registration Date
                    </td>

                    <td class="value">

                        @if($agent->approved_at)

                            {{ $agent->approved_at->format('d F Y') }}

                        @else

                            N/A

                        @endif

                    </td>


                    <td class="label">
                        Status
                    </td>

                    <td class="value">
                        APPROVED
                    </td>

                </tr>

            </table>

        </div>


        <!-- REGISTRATION BADGE -->

        <div class="registration">

            OFFICIAL MFMR REGISTRATION:

            {{ $agent->registration_number ?? 'N/A' }}

        </div>


    </div>


    <!-- =================================================
         OFFICIAL SEAL
    ================================================== -->

    <div class="seal">

        OFFICIAL

        <br>

        MINISTRY

        <br>

        OF FISHERIES

        <br>

        & MARINE

        <br>

        RESOURCES

    </div>


    <!-- =================================================
         SIGNATURES
    ================================================== -->

    <div class="signature-area">


        <div class="signature">

            <div class="signature-line"></div>

            <div class="signature-title">

                Authorized Officer

            </div>

            <div class="signature-sub">

                Ministry of Fisheries & Marine Resources

            </div>

        </div>


        <div class="signature">

            <div class="signature-line"></div>

            <div class="signature-title">

                Director / Authorized Authority

            </div>

            <div class="signature-sub">

                Ministry of Fisheries & Marine Resources

            </div>

        </div>


    </div>


    <!-- =================================================
         CERTIFICATE NUMBER
    ================================================== -->

    <div class="certificate-number">

        <div class="label">

            CERTIFICATE NUMBER

        </div>

        <div class="number">

            {{ $agent->registration_number ?? 'N/A' }}

        </div>

    </div>


    <!-- =================================================
         FOOTER
    ================================================== -->

    <div class="footer">

        MINISTRY OF FISHERIES & MARINE RESOURCES

        &nbsp; • &nbsp;

        GOVERNMENT OF PUNTLAND, SOMALIA

        &nbsp; • &nbsp;

        OFFICIAL REGISTRATION CERTIFICATE

    </div>


</div>


</body>

</html>