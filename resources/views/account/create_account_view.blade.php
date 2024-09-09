<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MNH Certification</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
{{--    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">--}}
<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("public/font-awesome/css/font-awesome.min.css") }}">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/common.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("public/css/custom.css") }}">

    <script src="{{ asset("public/js/jquery.min.js")}}" type="application/javascript"></script>


    <!-- Sweet Alert -->
    <link rel="stylesheet" href="{{ asset("public/AdminLTE/sweetalert/dist/sweetalert.css") }}">
    <script src="{{ asset ("public/AdminLTE/sweetalert/dist/sweetalert.min.js") }}"></script>

    <script src="{{ asset("public/js/passwd.js")}}" type="application/javascript"></script>
    <script src="{{ asset ("public/js/create_account.js") }}"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini"
      style="background: #d2d6de;">

<div class="app-loader" style="position: absolute;
    width: 100%;
    height: 100%;
    z-index: 10000;
    opacity: 1;
    display: none;">
    <div class="loader-back"></div>
    <div style="position: absolute;left: 45%;top: 40%;z-index: 10001;"><img src="{{asset('public/image/loading-blue.gif')}}" width="50%"> </div>
</div>

<div class="title_header">
    <div class="site_title">MNH Certification</div>
</div>

<div id="wrapper">
    <div class="login-box" id="remove_div">
        <div class="center-block">
            <br>

        </div>
        <style>
        </style>
        <div class="login-box-body">
            <div class="row">
                <div class="center-block">
                    <h1 style="text-align: center;margin-top: -2px;margin-bottom: 15px;font-size: 30px;text-shadow: 4px 4px 3px #e2e2e2;">
                            <span style="color:#2276b7">Create Assessor</span>
                    </h1>

                </div>
            </div>
            <div id="error_msg" style="color: red"></div>
            <form id="loginData " class="form-signin"  method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">

                    <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-user" aria-hidden="true"></i>
	                        </span>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                               placeholder="Person name" />
                    </div>
                </div>

                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">

                    <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-envelope" aria-hidden="true"></i>
	                        </span>
                        <input type="text" id="email" name="email" class="form-control" value="{{ old('email') }}"
                               placeholder="Email address" />
                    </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-lock" aria-hidden="true"></i>
	                        </span>
                        <input type="password"  id="password" name="password" class="form-control" value="{{ old('password') }}"
                               placeholder="Password" />
                    </div>
                </div>
                <div class="form-group {{ $errors->has('Confirmpassword') ? ' has-error' : '' }}">
                    <div class="input-group">
							<span class="input-group-addon">
	                            <i class="fa fa-lock" aria-hidden="true"></i>
	                        </span>
                        <input type="password" id="Confirmpassword" name="Confirmpassword" class="form-control" value="{{ old('password') }}"
                               placeholder="Confirm password" />
                    </div>
                </div>

                <div class="row">
                    <div class="col-xs-12">
{{--                        <a href="{{url('/login')}}">--}}
                        <input type="button" id="create-account"
                               class='btn btn-primary btn-block btn-flat' value="Create account for registration" />
{{--                        </a>--}}

                        <br/> Back to <a href="{{url('/login')}}" >Login</a>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>
</body>
</html>
