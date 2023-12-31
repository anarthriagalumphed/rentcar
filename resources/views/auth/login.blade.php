<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library | Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/palawa-icon-colored.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>

<body>


    <style>
        .main {
            height: 100vh;
            box-sizing: border-box;
        }

        .login-box {
            width: 500px;
            border: solid 1px;
            padding: 30px;
        }

        form div {
            margin: 15px;
        }

        body {
            background-color: #454d55;
        }

        .login-box {
            background-color: #343a40;
            color: #fff;
        }


        .logo {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo img {
            width: 265px;
            height: 73px;
        }
    </style>
    <div class="main d-flex flex-column  justify-content-center align-items-center">
        {{-- @if (session('status'))
            <div class="alert alert-danger" style="width: 500px">
                <li>{{ session('message') }}</li>
            </div>
        @endif --}}

        @if ($errors->has('login_failed'))
            <div class="alert alert-danger " role="alert" style="width: 500px">{{ $errors->first('login_failed') }}
            </div>
        @endif
        <div class="login-box">
            <div class="logo">
                <img src="{{ asset('img/palawa-tour-horizontal.png') }}" alt="Company Logo">
            </div>
            <form action="" method="post">
                @csrf
                <div>
                    <label for="username" class="form-label">Username or Email Address</label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username') }}" required autofocus>



                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                {{-- <div class="text-center">
                    Dont Have Account? <a href="register">Sign Up</a>
                </div> --}}
            </form>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-qKXV1j0HvMUeCBQ+QVp7JcfGl760yU08IQ+GpUo5hlbpg51QRiuqHAJz8+BrxE/N" crossorigin="anonymous">
    </script>
</body>

</html>
