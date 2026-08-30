<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'MFMR Admin')
    </title>


    <style>

        * {
            box-sizing: border-box;
        }


        body {

            margin: 0;

            background: #f5f7fa;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            color: #263238;
        }


        /* =====================================
           SIDEBAR
        ===================================== */

        .sidebar {

            position: fixed;

            left: 0;

            top: 0;

            bottom: 0;

            width: 250px;

            background:
                linear-gradient(
                    180deg,
                    #063b5c 0%,
                    #052f49 100%
                );

            color: white;

            padding: 24px 16px;

            box-shadow:
                4px 0 18px rgba(0,0,0,.10);

            z-index: 100;
        }


        /* LOGO */

        .logo-area {

            text-align: center;

            padding-bottom: 24px;

            border-bottom:
                1px solid rgba(255,255,255,.12);
        }


        .logo {

            width: 78px;

            height: 78px;

            object-fit: cover;

            border-radius: 50%;

            background: white;

            padding: 4px;

            border:
                2px solid #d5a928;

            box-shadow:
                0 4px 12px rgba(0,0,0,.25);
        }


        .ministry-name {

            margin-top: 12px;

            font-size: 13px;

            line-height: 1.4;

            font-weight: bold;
        }


        .government {

            margin-top: 6px;

            font-size: 8px;

            letter-spacing: 2px;

            color:
                rgba(255,255,255,.65);
        }


        /* =====================================
           NAVIGATION
        ===================================== */

        .nav {

            margin-top: 25px;
        }


        .nav-title {

            font-size: 9px;

            letter-spacing: 2px;

            color:
                rgba(255,255,255,.45);

            margin:
                0 12px 10px;
        }


        .nav a {

            display: flex;

            align-items: center;

            gap: 12px;

            padding: 12px 14px;

            margin-bottom: 5px;

            color: white;

            text-decoration: none;

            border-radius: 6px;

            font-size: 12px;

            transition: .2s;
        }


        .nav a:hover {

            background:
                rgba(255,255,255,.08);
        }


        .nav a.active {

            background:
                rgba(255,255,255,.13);

            border-left:
                3px solid #d5a928;

            padding-left: 11px;
        }


        .nav-icon {

            width: 20px;

            text-align: center;

            font-size: 15px;
        }


        /* =====================================
           SIDEBAR BOTTOM
        ===================================== */

        .sidebar-bottom {

            position: absolute;

            left: 16px;

            right: 16px;

            bottom: 20px;
        }


        .admin-box {

            background:
                rgba(255,255,255,.07);

            border:
                1px solid rgba(255,255,255,.10);

            border-radius: 7px;

            padding: 12px;

            margin-bottom: 10px;
        }


        .admin-label {

            font-size: 8px;

            color:
                rgba(255,255,255,.5);

            letter-spacing: 1px;
        }


        .admin-name {

            font-size: 11px;

            margin-top: 4px;

            font-weight: bold;
        }


        /* =====================================
           LOGOUT
        ===================================== */

        .logout-form {

            margin: 0;
        }


        .logout-button {

            width: 100%;

            padding: 11px 12px;

            background:
                rgba(255,255,255,.06);

            border:
                1px solid rgba(255,255,255,.12);

            border-radius: 6px;

            color: white;

            font-size: 11px;

            cursor: pointer;

            text-align: left;

            transition: .2s;

            font-family: inherit;
        }


        .logout-button:hover {

            background:
                rgba(220,53,69,.18);

            border-color:
                rgba(220,53,69,.45);

            color: #fff;
        }


        /* =====================================
           MAIN
        ===================================== */

        .main {

            margin-left: 250px;

            min-height: 100vh;
        }


        /* =====================================
           TOP BAR
        ===================================== */

        .topbar {

            height: 72px;

            background: white;

            border-bottom:
                1px solid #e4e8eb;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 0 35px;
        }


        .page-title {

            color: #063b5c;

            font-size: 18px;

            font-weight: bold;
        }


        .page-subtitle {

            margin-top: 3px;

            font-size: 10px;

            color: #89939a;
        }


        .system-label {

            font-size: 10px;

            color: #777;

            padding:
                8px 12px;

            background: #f5f7f8;

            border-radius: 5px;
        }


        /* =====================================
           CONTENT
        ===================================== */

        .container {

            width: 92%;

            max-width: 1250px;

            margin: 30px auto;
        }


        /* =====================================
           COMMON BOX
        ===================================== */

        .box {

            background: white;

            border:
                1px solid #e6eaed;

            border-radius: 8px;

            padding: 24px;

            box-shadow:
                0 3px 12px rgba(0,0,0,.04);

            margin-bottom: 20px;
        }


        /* =====================================
           BUTTON
        ===================================== */

        .button {

            display: inline-block;

            padding:
                10px 16px;

            background: #063b5c;

            color: white;

            text-decoration: none;

            border: none;

            border-radius: 5px;

            font-size: 11px;

            font-weight: bold;

            cursor: pointer;
        }


        .button:hover {

            background: #042d46;
        }


        .button.gold {

            background: #b58b15;
        }


        .button.green {

            background: #198754;
        }


        .button.red {

            background: #dc3545;
        }


        .button.orange {

            background: #fd7e14;
        }


        /* =====================================
           TABLE
        ===================================== */

        table {

            width: 100%;

            border-collapse: collapse;
        }


        th {

            background: #f7f9fa;

            color: #69757c;

            font-size: 9px;

            text-align: left;

            padding: 12px;
        }


        td {

            padding: 13px 12px;

            border-bottom:
                1px solid #edf0f2;

            font-size: 11px;
        }


        tr:last-child td {

            border-bottom: none;
        }


        /* =====================================
           STATUS
        ===================================== */

        .status {

            display: inline-block;

            padding:
                5px 9px;

            border-radius: 4px;

            font-size: 8px;

            font-weight: bold;
        }


        .status.pending {

            background: #fff3cd;

            color: #856404;
        }


        .status.approved {

            background: #d1e7dd;

            color: #0f5132;
        }


        .status.denied {

            background: #f8d7da;

            color: #842029;
        }


        .status.correction_required {

            background: #ffe5d0;

            color: #984c0c;
        }


        /* =====================================
           MOBILE
        ===================================== */

        @media(max-width: 800px) {

            .sidebar {

                width: 70px;

                padding:
                    15px 8px;
            }


            .logo {

                width: 45px;

                height: 45px;
            }


            .ministry-name,
            .government,
            .nav-title,
            .sidebar-bottom {

                display: none;
            }


            .nav a {

                justify-content: center;

                padding: 12px;
            }


            .nav-icon {

                margin: 0;
            }


            .main {

                margin-left: 70px;
            }

        }

    </style>

</head>


<body>


<!-- =====================================================
     SIDEBAR
====================================================== -->

<div class="sidebar">


    <!-- MINISTRY -->

    <div class="logo-area">


        <img

            class="logo"

            src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-6/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s400x400&_nc_cat=100&ccb=1-7&_nc_sid=6ee11a&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=23&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=n5ktm50_LZUhEM1gfyk4yw&_nc_ss=7b2a8&oh=00_AQJNTZlCepFSAkMahK6yV1AkjeW7m53Vyyh1pVjEDDhFkg&oe=6A98EBD0"

            alt="Ministry Logo"

        >


        <div class="ministry-name">

            MINISTRY OF FISHERIES

            <br>

            & MARINE RESOURCES

        </div>


        <div class="government">

            GOVERNMENT OF SOMALIA

        </div>


    </div>


    <!-- =================================================
         NAVIGATION
    ================================================== -->

    <div class="nav">


        <div class="nav-title">

            MAIN MENU

        </div>


        <a

            href="{{ route('admin.dashboard') }}"

            class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"

        >

            <span class="nav-icon">

                ⌂

            </span>

            Dashboard

        </a>


        <a

            href="{{ route('admin.agents') }}"

            class="{{ request()->routeIs('admin.agents*') ? 'active' : '' }}"

        >

            <span class="nav-icon">

                ▣

            </span>

            Applications

        </a>


        <a

            href="{{ route('admin.approved') }}"

            class="{{ request()->routeIs('admin.approved') ? 'active' : '' }}"

        >

            <span class="nav-icon">

                ✓

            </span>

            Approved Agents

        </a>


    </div>


    <!-- =================================================
         ADMIN + LOGOUT
    ================================================== -->

    <div class="sidebar-bottom">


        <div class="admin-box">


            <div class="admin-label">

                ADMINISTRATOR

            </div>


            <div class="admin-name">

                {{ auth()->user()->name ?? 'Ministry Admin' }}

            </div>


        </div>


        <!-- REAL LOGOUT -->

        <form

            class="logout-form"

            action="{{ route('admin.logout') }}"

            method="POST"

        >

            @csrf


            <button

                type="submit"

                class="logout-button"

            >

                ⇥ &nbsp; Logout

            </button>


        </form>


    </div>


</div>


<!-- =====================================================
     MAIN
====================================================== -->

<div class="main">


    <!-- TOP BAR -->

    <div class="topbar">


        <div>


            <div class="page-title">

                @yield('page-title', 'Administration')

            </div>


            <div class="page-subtitle">

                Agent Registration Management System

            </div>


        </div>


        <div class="system-label">

            MFMR • ADMIN PORTAL

        </div>


    </div>


    <!-- PAGE CONTENT -->

    <div class="container">

        @yield('content')

    </div>


</div>


</body>

</html>