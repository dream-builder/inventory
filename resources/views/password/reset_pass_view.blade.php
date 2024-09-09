<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Facility Assessment | Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    {{--    <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">--}}
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("public/font-awesome/css/font-awesome.min.css") }}">
    <link href="{{ asset('public/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('public/css/common.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset("public/AdminLTE/sweetalert/dist/sweetalert.css") }}">
    <link rel="stylesheet" href="{{ asset("public/css/custom.css") }}">

    <script src="{{ asset("public/js/jquery.min.js")}}" type="application/javascript"></script>
    <script src="{{ asset("public/js/passwd.js")}}" type="application/javascript"></script>
    <script src="{{ asset ("public/AdminLTE/sweetalert/dist/sweetalert.min.js") }}"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini" style="margin-top: 0px; background: #d2d6de;" >

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
    <div class="site_title">Activity Tracking System</div>
</div>

<section class="content">

    <div class="col-md-4"></div>
    <div class="col-md-4" style="background-color: #FFF; border-radius: 0px;border: solid 1px #2276B7;box-shadow: -1px 3px 14px #666; padding-left: 25px;padding-right: 25px;">
    <h3 style="color: #2276b7;">Change Account Password</h3><br>

    <div class="row">
        <!--region-->
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <!-- form -->
                    <div class="box-body">
                        <form role="form">
                            <input type="hidden" name="user_id" id="user_id" value="{{$data->user_id}}">
                            <input type="hidden" name="token" id="token" value="{{$token}}">

                            <div class="form-group">
                                <label for="newpass">New Password</label>
                                <input type="password" class="form-control" id="newpass" placeholder="New Password">
                            </div>

                            <div class="form-group">
                                <label for="repass">Re-type New Password </label>
                                <input type="password" class="form-control" id="repass" placeholder="Re-type New Password">
                            </div>
                        </form>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="button" class="btn btn-success" id="reset_submit">Change Password</button>
                    </div>
                    <br>

                </div>
            </div>
        </div>
        <!--//region-->

    </div>
    </div>
    <div class="col-md-4"> </div>
</section>
</body>
</html>
