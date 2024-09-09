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

    <link href="{{ env('APP_URL') }}public/css/mw.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .form-control::placeholder {
            color: #fff;
            opacity: 1;
        }

        .main-nav {
            padding: 30px 15px;
            background-color: #FFF;
            font-family: sans-serif;
            height: 120px;
        }

        .logo-title {
            float: left;
            width: auto;
            height: auto;
        }

        .main-menu {
            float: left;
            width: auto;
            margin-left: 50px;
        }

        .logo-title img {
            width: 140px;
        }

        .main-nav ul {
            list-style: none;
            padding: 0px;
            position: relative;
            z-index: 1000;
        }

        .main-nav>ul {
            list-style: none;
            padding: 0px;
            margin: 0px;
            position: relative;
        }

        .main-nav ul li {
            display: inline-block;
            background-color: rgb(255, 255, 255);
            padding: 10px 20px;
        }

        .main-nav ul li ul {
            position: absolute;
            box-shadow: 1px 1px 3px #616161;
            display: none;
            padding-top: 20px;
        }

        .main-nav ul li:hover ul {
            display: block;
        }

        .main-nav ul li ul li {
            min-width: 350px;
            width: auto;
            display: block;
        }

        .main-nav li a {
            text-decoration: none;
            color: rgb(13, 13, 63);
            font-size: 14px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.5px;
            line-height: 28.8px;
            list-style-image: none;
            list-style-position: outside;
            list-style-type: none;
            text-align: center;
            text-rendering: optimizelegibility;

            cursor: pointer;
        }

        .main-nav ul li ul li a {
            color: rgb(118, 118, 130);
            font-weight: normal;
        }

        .main-nav li a:hover {
            color: rgb(41, 183, 155);
        }

        .under-line {

            padding-bottom: 10px;
            border-bottom: solid 1px #DDD;
        }
    </style>
</head>

<body>

    <div class="main-nav">
        <div class="logo-title"><img src="{{ env('APP_URL') }}public/image/logo-title.png"></div>
        <div class="main-menu">

            <ul>
                <li><a href="https://mothersatwork.info/matw/">HOME</a></li>
                <li><a href="#">POSTERS</a>
                    <ul>
                        <li class="under-line"><a href="https://mothersatwork.info/matw/seven-minimum-standards/">Seven
                                Minimum Standards</a></li>
                        <li class="under-line"><a
                                href="https://mothersatwork.info/matw/breastfeeding-posters/">Breasfeeding Posters</a>
                        </li>
                        <li><a href="https://mothersatwork.info/matw/what-other-stakeholders-can-do/">What Other
                                Stakeholders Can Do</a></li>

                    </ul>
                </li>
                <li><a href="https://mothersatwork.info/matw/partners/">PARTNERSHIP</a></li>
                <li><a href="#">MONITORING</a></li>
            </ul>

        </div>

    </div>
    <div class="login-container">
        <div class="left-side">

            <img src="{{ env('APP_URL') }}public/image/login-bg.png">

        </div>
        <div class="right-side">

            <div class="gov-logo" style="text-align: center; padding-top:30px;">
                <img src="{{ env('APP_URL') }}public/image/gov-logo.svg" width="70px">
            </div>

            <!-- login form -->
            <div class="login-area">

                <div class="sign-in">Sign In</div>


                <!-- login form -->

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
                            <span class="input-group-addon mw">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <input type="text" id="email" name="email" class="form-control mw"
                                value="{{ old('email') }}" placeholder="Email address" />
                        </div>
                    </div>
                    <div class="form-group  {{ $errors->has('password') ? ' has-error' : '' }}">
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                        <div class="input-group ">
                            <span class="input-group-addon mw">
                                <i class="fa fa-lock" aria-hidden="true"></i>
                            </span>
                            <input type="password" id="password" name="password" class="form-control mw"
                                placeholder="Password" />

                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <input type="submit" id="login" class='btn btn-default btn-mw btn-block btn-flat'
                                value="Log in" />
                        </div>
                    </div>


                </form>
                <br>
                <a href="forgot_password" class="forgot-pass">Forgot password?</a> <br>

            </div>

            <div class="partner-logo">
                <img class="logo-unicef" src="{{ env('APP_URL') }}public/image/unicef-logo.svg">
                <img class="logo-bgmea" src="{{ env('APP_URL') }}public/image/bgmea-logo.png">
                <img class="logo-bkmea" src="{{ env('APP_URL') }}public/image/bkmea-logo.png">
            </div>


        </div>

    </div>

    <script src="{{ env('APP_URL') }}public/js/common.js" type="application/javascript"></script>

    <script>
        $(document).ready(function() {
            function centerDiv() {
                var $window = $(window);
                var $div = $('.login-container');
                var windowHeight = $window.height();
                var divHeight = $div.outerHeight();
                var topMargin = (windowHeight - divHeight) / 2;

                $div.css({
                    'margin-top': topMargin + 'px'
                });
            }

            // Center the div on page load
            centerDiv();

            // Re-center the div when the window is resized
            $(window).resize(function() {
                centerDiv();
            });
        });
    </script>

</body>

</html>
