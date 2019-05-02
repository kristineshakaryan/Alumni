<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="token" content="{{ csrf_token() }}"/>
    <meta name="url" content="{{ URL('/') }}"/>
    <title>Datalumni</title>
    <!-- Icons-->
    <link href="{{ asset('css/custom/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/custom-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.carousel.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom/owl.theme.default.min.css') }}" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @toastr_css
</head>
<body>
<main class="login_bg  ">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-md-6 mx-auto col-sm-7 p-4 bg-white rounded op-8 border border-theme-vii border-width-3">
                <div class="row">
                    <div class="col-sm-6 mx-auto">
                        <img src="{{ asset('images/custom/logo2.png') }}" class="img-fluid" />
                    </div>
                    <div class="col-sm-6 mx-auto">
                        <img src="{{ asset('images/custom/wharton_sm.png') }}" class="img-fluid" />
                    </div>
                </div>

                <form class="mt-3 clearfix" action="{{ route('ResetPassword') }}" method="post">
                    @csrf
                    <div class="form-group">
                        @if ($errors->has('email'))
                            <p role="alert" class='text-danger'>
                                <strong>{{ $errors->first('email') }}</strong>
                            </p>
                        @endif
                        <label for="exampleInputEmail" class="text-dark">Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail" placeholder="e-mail adresse">
                    </div>
                    <p class="clearfix text-uppercase mt-2">
                        <a href="{{ route('login.view') }}" class="text-right"><small id="forgotpassword" class="form-text text-dark text-capitalize">Login</small></a>
                    </p>
                    <button type="submit" class="btn btn-theme-iv btn-block">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</main>
</body>

<script src="{{ asset('js/custom/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom/wow.min.js') }}"></script>
<script src="{{ asset('js/custom/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/custom/custom.js') }}"></script>

@toastr_js
@toastr_render
</html>



<form action="{{ route('ResetPassword') }}" method="post">
    @csrf
    <div class="card-body">
        <h1>Reset Password</h1>
        <p class="text-muted"></p>
        <div class="input-group mb-3">
            @if ($errors->has('email'))
                <p role="alert" class='text-danger'>
                    <strong>{{ $errors->first('email') }}</strong>
                </p>
            @endif
            <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-user"></i>
                      </span>
            </div>
            <input class="form-control" type="text" name="email" placeholder="Email" required="">
        </div>
        <div class="row">
            <div class="col-6">
                <button class="btn btn-primary px-4" >Submit</button>
            </div>
            <div class="col-6 text-right">
                <a class="btn btn-link px-0" href="{{ route('login.view') }}">Login</a>
            </div>
        </div>
    </div>
</form>