<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>F-Assessment</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("font-awesome/css/font-awesome.min.css") }}">
<!-- Theme style -->
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/skins/skin-purple.min.css") }}">

    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/iCheck/all.css") }}">

    <link rel="stylesheet" href="{{ asset("AdminLTE/plugins/select2/select2.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/nprogress/nprogress.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/sweetalert/dist/sweetalert.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/nestable/nestable.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/toastr/build/toastr.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/bootstrap3-editable/css/bootstrap-editable.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/dist/css/AdminLTE.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/jqgrid/jqgrid.min.css") }}">
    <link rel="stylesheet" href="{{ asset("AdminLTE/jquery-ui/jquery-ui.css")}}">
    <link rel="stylesheet" href="{{ asset("css/common.css") }}" type="text/css">


    {{--<!-- REQUIRED JS SCRIPTS -->--}}
    <script src="{{ asset("js/popper.min.js")}}" type="application/javascript"></script>
    <script src="{{ asset("js/jquery.min.js")}}" type="application/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="application/javascript"> </script>
    <script src="{{ asset ("AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js") }}"></script>
    <script src="{{ asset ("AdminLTE/dist/js/app.min.js") }}" type="application/javascript"></script>
    <script src="{{ asset ("AdminLTE/jquery-pjax/jquery.pjax.js") }}" type="application/javascript"></script>
    <script src="{{ asset ("AdminLTE/nprogress/nprogress.js") }}" type="application/javascript"></script>
    <script src="{{ asset ("AdminLTE/jqgrid/jqgrid.min.js") }}" type="application/javascript"></script>
    <script src="{{ asset ("AdminLTE/plugins/bootbox/bootbox.js") }}" type="application/javascript"></script>
</head>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">
    @include('layouts.header')
    @include('layouts.sidebar')
    <div class="content-wrapper" id="pjax-container">
        @yield('content')
        {{--{!! Admin::script() !!}--}}
    </div>
    @include('layouts.footer')
</div>

<!-- ./wrapper -->

@yield('script')
<script>
    function LA() {}
    LA.token = "{{ csrf_token() }}";
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>

<!-- REQUIRED JS SCRIPTS -->

<script src="{{ asset ("AdminLTE/jquery-ui/jquery-ui.js") }}"></script>
<script src="{{ asset ("AdminLTE/nestable/jquery.nestable.js") }}"></script>
<script src="{{ asset ("AdminLTE/toastr/build/toastr.min.js") }}"></script>
<script src="{{ asset ("AdminLTE/bootstrap3-editable/js/bootstrap-editable.min.js") }}"></script>
<script src="{{ asset ("AdminLTE/sweetalert/dist/sweetalert.min.js") }}"></script>
<script src="{{ asset ("AdminLTE/plugins/select2/select2.full.min.js") }}"></script>
<script src="{{ asset("AdminLTE/plugins/iCheck/icheck.min.js")}}"></script>

{{--{!! Admin::js() !!}--}}
<script src="{{ asset ("js/admin_theme.js") }}"></script>
<script src="{{ asset("js/common.js")}}" type="application/javascript"></script>
<script src="{{ asset("js/jquery-serialize.js")}}" type="application/javascript"></script>


</body>
</html>

