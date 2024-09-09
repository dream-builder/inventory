<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    {{--    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/font-awesome/css/font-awesome.min.css">
    <link href="{{ env('APP_URL') }}public/css/app.css" rel="stylesheet">
    <link href="{{ env('APP_URL') }}public/css/common.css" rel="stylesheet">
    <style type="text/css">
        body {
            background-image: url("{{ env('APP_URL') }}public/image/login-background.jpg");
            background-size: cover;
        }

        .title-block {
            border-bottom: solid 1px #6baee0;
            padding: 20px;
            font-size: 31px;
            font-weight: bold;
            color: #2276b7;
            background-color: #fff;
            box-shadow: -3px 0px 6px #000;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="title-block">{{ env('APP_NAME') }}</div>
    <div id="wrapper">
        <div class="login-box" id="remove_div">

            <div class="center-block">
                <br>
                <br>
                <br>
                <br>
            </div>
            <style>
            </style>
            <div class="login-box-body">
                <div class="row">
                    <div class="center-block" style="text-align: center">
                        <i class="fa fa-key" style="font-size: xxx-large;color: #b75b0b;"></i>
                        <h1
                            style="text-align: center;margin-top: 15px;margin-bottom: 30px;font-size: 38px;text-shadow: 4px 4px 3px #e2e2e2;">
                            <b>
                                <span style="color:#2276b7">Login</span>
                            </b>
                        </h1>
                    </div>
                </div>
                <div id="error_msg" style="color: red"></div>
                <form id="loginData " class="form-signin" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="email" name="email" class="form-control"
                                value="{{ old('email') }}" placeholder="Email address" />
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password" />

                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember" value="true"> <span
                                    style="display: inline-block; padding-top: 9px;">Stay sign-in</span>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" id="login" class='btn btn-primary btn-block btn-flat'
                                value="Log in" />
                        </div>
                    </div>


                </form>
                <br>
                <a href="forgot_password">Forgot password?</a> <br>
                {{--            <a href="create_account_request">No account yet? Create account</a><br> --}}
                {{--            <a target="_blank"  href="{{asset('docs/password_reset_manual.pdf')}}">How to reset password (Manual)?</a> --}}
            </div>
        </div>
    </div>

    {{-- <script src="{{ asset("js/popper.min.js")}}" type="application/javascript"></script> --}}
    <!-- jQuery  -->
    {{-- <script src="{{ asset("js/jquery.min.js")}}" type="application/javascript"></script> --}}
    <!-- Bootstrap 3.3.5 -->
    {{-- <script src="{{ asset('public/js/bootstrap.min.js') }}" type="application/javascript"> </script> --}}
    <script src="{{ env('APP_URL') }}public/js/common.js" type="application/javascript"></script>
</body>

</html>
