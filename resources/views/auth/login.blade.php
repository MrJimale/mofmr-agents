<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>MFMR | Admin Login</title>

    <style>

        * {
            box-sizing: border-box;
        }

        body {

            margin: 0;

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                linear-gradient(
                    135deg,
                    #063b5c,
                    #07547e
                );

            font-family: Arial, Helvetica, sans-serif;
        }


        .login-card {

            width: 390px;

            background: white;

            padding: 35px;

            border-radius: 14px;

            box-shadow:
                0 20px 50px rgba(0,0,0,0.25);

            text-align: center;
        }


        .logo {

            width: 85px;

            height: 85px;

            object-fit: cover;

            border-radius: 50%;

            padding: 4px;

            border: 3px solid #d5a928;

            margin-bottom: 15px;
        }


        h2 {

            margin: 0;

            color: #063b5c;

            font-size: 22px;
        }


        .subtitle {

            margin-top: 6px;

            margin-bottom: 25px;

            color: #7b858c;

            font-size: 11px;
        }


        .form-group {

            text-align: left;

            margin-bottom: 17px;
        }


        label {

            display: block;

            margin-bottom: 6px;

            color: #47545c;

            font-size: 11px;

            font-weight: bold;
        }


        input {

            width: 100%;

            padding: 11px;

            border: 1px solid #d5dde2;

            border-radius: 6px;

            font-size: 13px;

            outline: none;
        }


        input:focus {

            border-color: #063b5c;
        }


        .login-button {

            width: 100%;

            padding: 12px;

            background: #063b5c;

            color: white;

            border: none;

            border-radius: 6px;

            font-size: 13px;

            font-weight: bold;

            cursor: pointer;
        }


        .login-button:hover {

            background: #042f4b;
        }


        .error {

            background: #f8d7da;

            color: #842029;

            padding: 10px;

            border-radius: 6px;

            margin-bottom: 15px;

            font-size: 11px;

        }


        .public-link {

            display: block;

            margin-top: 20px;

            color: #063b5c;

            text-decoration: none;

            font-size: 11px;
        }

    </style>

</head>


<body>


<div class="login-card">


    <img

        class="logo"

        src="https://scontent.fbsa1-1.fna.fbcdn.net/v/t39.30808-1/672688130_1267529012232197_8272294226841489506_n.jpg?stp=dst-jpg_tt6&cstp=mx400x400&ctp=s200x200&_nc_cat=100&ccb=1-7&_nc_sid=2d3e12&_nc_ohc=18Ofv1XI_z8Q7kNvwFmht2d&_nc_oc=Adr6RIxjlnhLWLLdWvZa9Thlf4SZx59lanoWJkdhReWFvH0ocLngjTGYxMk5nq7EozA&_nc_zt=24&_nc_ht=scontent.fbsa1-1.fna&_nc_gid=g37aO5w2zhLRBGgZgEqskQ&_nc_ss=7b2a8&oh=00_AQIB47Us0RXGHb9eP8kcD358YN7HKfyaz7gZTNNuXabjDQ&oe=6A99034E"

        alt="Ministry Logo"

    >


    <h2>

        Ministry Administration

    </h2>


    <div class="subtitle">

        Fisheries & Marine Resources

    </div>


    @if($errors->any())

        <div class="error">

            {{ $errors->first() }}

        </div>

    @endif


    <form
        method="POST"
        action="{{ route('login.authenticate') }}"
    >

        @csrf


        <div class="form-group">

            <label>

                EMAIL

            </label>

            <input

                type="email"

                name="email"

                value="{{ old('email') }}"

                placeholder="admin@example.com"

                required

            >

        </div>


        <div class="form-group">

            <label>

                PASSWORD

            </label>

            <input

                type="password"

                name="password"

                placeholder="Enter password"

                required

            >

        </div>


        <button
            type="submit"
            class="login-button"
        >

            Login to Administration

        </button>


    </form>


    <a
        href="{{ url('/register-agent') }}"
        class="public-link"
    >

        ← Public Agent Registration

    </a>


</div>


</body>

</html>