<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Ministry of Fisheries and Marine Resources')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <style>
        body {
            background: #f5f7fa;
        }

        .navbar {
            background: #063b5c;
        }

        .navbar-brand {
            font-weight: bold;
        }

        .container-main {
            max-width: 1100px;
            margin: 30px auto;
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">

            <a class="navbar-brand" href="/">
                Ministry of Fisheries & Marine Resources
            </a>

        </div>
    </nav>


    <!-- Page Content -->
    <div class="container container-main">

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </div>


    <!-- Footer -->
    <footer>
        Ministry of Fisheries & Marine Resources
    </footer>


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
    </script>

</body>
</html>