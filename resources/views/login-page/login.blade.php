<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('login-page/fonts/icomoon/style.css') }}">

    <link rel="stylesheet" href="{{ asset('login-page/css/owl.carousel.min.css') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('login-page/css/bootstrap.min.css') }}">
    
    <!-- Style -->
    <link rel="stylesheet" href="{{ asset('login-page/css/style.css') }}">
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <title>Worker System Aplication</title>
    </head>
    <body>
    <div class="content">
        <div class="container">
        <div class="row">
            <div class="col-md-6">
            <img src="{{ asset('login-page/images/undraw_remotely_2j6y.svg') }}" alt="Image" class="img-fluid">
            </div>
            <div class="col-md-6 contents">
            <div class="row justify-content-center">
                <div class="col-md-8">
                <div class="mb-4">
                <h3>Sign In</h3>
                <p class="mb-4">Sign in with your account.</p>
                @if (session('error'))
                    <div class="alert alert-danger">
                        <ul>
                                <li>{{ session('error') }}</li>
                        </ul>
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                        </div>
                            <form method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
                                <div class="form-group first">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email">
                                </div>
                                <div class="form-group last mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>

                                <div class="d-flex mb-5 align-items-center">
                                    <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked"/>
                                    <div class="control__indicator"></div>
                                    </label>
                                    <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span> 
                                </div>  

                                <input type="submit" value="Log In" class="btn btn-block btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <script src="{{ asset('login-page/js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('login-page/js/popper.min.js') }}"></script>
        <script src="{{ asset('login-page/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('login-page/js/main.js') }}"></script>
    </body>
</html>