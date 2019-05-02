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
	<link href="{{ asset('css/template/coreui-icons.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/template/flag-icon.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/template/font-awesome.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/template/simple-line-icons.css') }}" rel="stylesheet">
	<!-- Main styles for this application-->
	<link href="{{ asset('css/template/style.css') }}" rel="stylesheet">
	<link href="{{ asset('css/template/pace.min.css') }}" rel="stylesheet">
  @toastr_css
	</head>
<body>
<div class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card-group">
            <div class="card p-4">
              <form action="{{ route('login.super_admin') }}" method="post">
                @csrf
                <div class="card-body">
                  <h1>Login</h1>
                  <p class="text-muted">Sign In to your account</p>
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
                    <input class="form-control" type="text" name="email" value="{{ old('email') }}" placeholder="Email" required="">
                  </div>
                  <div class="input-group mb-4">
                    @if ($errors->has('password'))
                      <p role="alert" class='text-danger'>        
                        <strong>{{ $errors->first('password') }}</strong>
                      </p>
                    @endif
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="icon-lock"></i>
                      </span>
                    </div>
                    <input class="form-control" type="password" name="password" placeholder="Password" required="">
                  </div>
                  <div class="row">
                    <div class="col-6">
                      <button class="btn btn-primary px-4" >Login</button>
                    </div>
                    <div class="col-6 text-right">
                      <a class="btn btn-link px-0" href="{{ route('ResetPassword.view') }}">Reset password?</a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
{{--                  <button class="btn btn-primary active mt-3" type="button">Register Now!</button>--}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</body>
<script src="https://rawgit.com/jackmoore/autosize/master/dist/autosize.min.js"></script>
<script src="{{ asset('js/template/jquery.min.js') }}"></script>
<script src="{{ asset('js/template/popper.min.js') }}"></script>
<script src="{{ asset('js/template/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/template/pace.min.js') }}"></script>
<script src="{{ asset('js/template/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('js/template/coreui.min.js') }}"></script>
<script src="{{ asset('js/template/custom-tooltips.min.js') }}"></script>
@toastr_js
@toastr_render
</html>