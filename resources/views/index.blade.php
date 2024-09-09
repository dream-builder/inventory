<?php
use App\Http\Controllers\Notification;
use App\Http\Controllers\Tour;
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ env('APP_NAME') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{--    <meta http-equiv="refresh" content="300"> --}}
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet"
        href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    {{--    <link rel="stylesheet" href="{{ asset("public/AdminLTE-2.3.11/plugins/datepicker/datepicker3.css")}}"> --}}
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
        type="text/css">
    <!-- Daterange picker -->
    <link rel="stylesheet"
        href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet"
        href="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}public/css/style-1.1.css" type="text/css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/css/dashboard.css" type="text/css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}public/css/tags-input-with-autocomplete_typeahead.css"
        type="text/css">
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/css/tags-input-with-autocomplete_bootstrap-tagsinput.css"
        type="text/css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" type="text/css">

    <link rel="stylesheet" href="{{ env('APP_URL') }}public/AdminLTE/sweetalert/dist/sweetalert.css">

    <!-- Rich text -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/richtext/src/richtext.min.css">

    <!-- MW customs -->
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/css/mw.css">

    <!-- Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    {{--    <link rel="stylesheet" href="{{asset("public1/datatables/data-table-custom.css")}}" type="text/css"> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <!-- jQuery 2.2.3 -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <script src="{{ env('APP_URL') }}public/datatables/datatables.js" type="application/javascript"></script>
    <script src="{{ env('APP_URL') }}public/datatables/buttons.print.min.js" type="application/javascript"></script>
    <script src="{{ env('APP_URL') }}public/datatables/Blfrtip.js" type="application/javascript"></script>
    <script src="{{ env('APP_URL') }}public/AdminLTE/sweetalert/dist/sweetalert.min.js"></script>

    <!-- rich text -->
    <script src="{{ env('APP_URL') }}public/richtext/src/jquery.richtext.min.js"></script>

    <!-- Jquery validator -->
    {{-- <script src="{{ env('APP_URL') }}public/js/jquery.validate.min.js"></script> --}}

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0px;
        }

        .dt-buttons btn-group {
            margin-left: 15px;
        }

        #app-loader {
            position: fixed;
            left: 45%;
            top: 40%;
            z-index: 10000;
            background-color: #FFF;
            border-radius: 5px;
            border: solid 2px #DDD;
            box-shadow: 3px 3px 5px #666;
            display: none;
        }

        #app-loader .loader,
        #app-loader .loader-text {
            float: left;
        }

        #app-loader .loader-text {
            font-weight: bold;
            font-size: 20px;
            padding-top: 34px;
            margin-right: 50px;
        }

        #app-loader .loader img {
            width: 100px;
        }

        #notice {
            position: fixed;
            top: 0px;
            z-index: 10000;
            background-color: #F2A91E;
            padding: 10px;
            width: 50%;
            left: 30%;
            text-align: center;
            font-weight: bold;
        }

        /*.modal-content{*/
        /*   box-shadow: 0 0px 6px rgb(0, 0, 0);*/
        /*}*/
    </style>

    <style>
        .loader {
            height: 30px;
            aspect-ratio: 2.5;
            --_g: no-repeat radial-gradient(farthest-side, #fa0b0b 90%, #0000);
            --_g1: no-repeat radial-gradient(farthest-side, #0f03ff 90%, #0000);
            --_g2: no-repeat radial-gradient(farthest-side, #07ff03 90%, #0000);
            --_g3: no-repeat radial-gradient(farthest-side, #ffdd03 90%, #0000);
            background: var(--_g), var(--_g1), var(--_g2), var(--_g3);
            background-size: 20% 50%;
            animation: l44 1s infinite linear alternate;
            display: none;
        }

        @keyframes l44 {

            0%,
            5% {
                background-position: calc(0*100%/3) 50%, calc(1*100%/3) 50%, calc(2*100%/3) 50%, calc(3*100%/3) 50%
            }

            12.5% {
                background-position: calc(0*100%/3) 0, calc(1*100%/3) 50%, calc(2*100%/3) 50%, calc(3*100%/3) 50%
            }

            25% {
                background-position: calc(0*100%/3) 0, calc(1*100%/3) 0, calc(2*100%/3) 50%, calc(3*100%/3) 50%
            }

            37.5% {
                background-position: calc(0*100%/3) 100%, calc(1*100%/3) 0, calc(2*100%/3) 0, calc(3*100%/3) 50%
            }

            50% {
                background-position: calc(0*100%/3) 100%, calc(1*100%/3) 100%, calc(2*100%/3) 0, calc(3*100%/3) 0
            }

            62.5% {
                background-position: calc(0*100%/3) 50%, calc(1*100%/3) 100%, calc(2*100%/3) 100%, calc(3*100%/3) 0
            }

            75% {
                background-position: calc(0*100%/3) 50%, calc(1*100%/3) 50%, calc(2*100%/3) 100%, calc(3*100%/3) 100%
            }

            87.5% {
                background-position: calc(0*100%/3) 50%, calc(1*100%/3) 50%, calc(2*100%/3) 50%, calc(3*100%/3) 100%
            }

            95%,
            100% {
                background-position: calc(0*100%/3) 50%, calc(1*100%/3) 50%, calc(2*100%/3) 50%, calc(3*100%/3) 50%
            }
        }
    </style>

    {{--    SELECT 2 Plugin --}}

    <link rel="stylesheet" href="{{ env('APP_URL') }}public/plugins/select2/css/select2.min.css">
    <script src="{{ env('APP_URL') }}public/plugins/select2/js/select2.js" type="application/javascript"></script>

</head>

<body class="hold-transition skin-blue sidebar-mini">
    <script>
        var current_user_name = '<?php echo Auth::user()->name; ?>';
        var current_user_id = '<?php echo Auth::id(); ?>';
        var site_url = "{{ url('/') }}";
    </script>

    <?php
    $sql = "SELECT * FROM notice WHERE status ='enable'";
    $result = DB::select($sql);
    ?>
    @if (sizeof($result) > 0)
        <div id="notice" class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="right:0px">×</button>
            <div>{{ $result[0]->info }}</div>
        </div>
    @endif

    <div id="tags">
        <ul>
        </ul>
    </div>

    <div id="app-loader">
        <div class="loader"><img src="{{ env('APP_URL') }}public/image/loading_android.gif"></div>
        <div class="loader-text">Processing...</div>
    </div>
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b><i class="fa fa-certificate"></i></b></span>

                Inventory
                <!-- logo for regular state and mobile devices -->
                {{-- <span class="logo-lg"><img src="{{ env('APP_URL') }}public/image/mother_at_works.png"
                        style="width: 35%"></span> --}}
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <?php
                        $notification = new Notification();
                        
                        $pending_issue = $notification->my_pending_task_list(Auth::user()->user_id);
                        //  $pending_issue = $notification->my_pending_task_list(9055);
                        ?>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            {{--                        <a href="{{url('dashboard/my_pending_issue')}}" class="dropdown-toggle" data-toggle="dropdown" title="My pending issues" id="pending-issue-flag"> --}}
                            {{--                            <i class="fa fa-flag-o"></i> --}}
                            {{--                            @if (sizeof($pending_issue) > 0) --}}
                            {{--                            <span class="label label-danger">{{sizeof($pending_issue)}}</span> --}}
                            {{--                            @endif --}}
                            {{--                        </a> --}}

                            @if (sizeof($pending_issue) > 0)
                                <ul class="dropdown-menu">
                                    {{--                                <li class="header">You have {{sizeof($pending_issue)}} pending issue(s)</li> --}}
                                    {{--                                <li> --}}
                                    {{--                                    <!-- inner menu: contains the actual data --> --}}
                                    {{--                                    <ul class="menu"> --}}
                                    {{--                                        @foreach ($pending_issue as $issue) --}}

                                    {{--                                        <li> --}}
                                    {{--                                            <a href="#"> --}}
                                    {{--                                                <i class="fa fa-info text-warning"></i> {{$issue->details}} --}}
                                    {{--                                            </a> --}}
                                    {{--                                        </li> --}}
                                    {{--                                        @endforeach --}}

                                    {{--                                    </ul> --}}
                                    {{--                                </li> --}}
                                    <li class="footer"><a href="{{ url('dashboard/my_pending_issue') }}">View all</a>
                                    </li>
                                </ul>
                            @endif
                        </li>

                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                {{-- <img src="{{ env('APP_URL') }}public/image/admin.jpg" class="user-image"
                                    alt="User Image"> --}}
                                <span class="hidden-xs">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{ env('APP_URL') }}public/image/admin.jpg" class="img-circle"
                                        alt="User Image">

                                    <p>
                                        {{ Auth::user()->name }}
                                        <small><?php echo $mytime = Carbon\Carbon::now()->toDateTimeString(); ?></small>
                                    </p>
                                </li>
                                {{--                            <!-- Menu Body --> --}}
                                {{--                            <li class="user-body"> --}}
                                {{--                                <div class="row"> --}}
                                {{--                                    <div class="col-xs-4 text-center"> --}}
                                {{--                                        <a href="#">Followers</a> --}}
                                {{--                                    </div> --}}
                                {{--                                    <div class="col-xs-4 text-center"> --}}
                                {{--                                        <a href="#">Sales</a> --}}
                                {{--                                    </div> --}}
                                {{--                                    <div class="col-xs-4 text-center"> --}}
                                {{--                                        <a href="#">Friends</a> --}}
                                {{--                                    </div> --}}
                                {{--                                </div> --}}
                                {{--                                <!-- /.row --> --}}
                                {{--                            </li> --}}
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ env('APP_URL') }}profile"
                                            class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                            class="btn btn-default btn-flat">Sign out</a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        {{--                    <li> --}}
                        {{--                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a> --}}
                        {{--                    </li> --}}
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar" style="background-color: #39474F">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ env('APP_URL') }}public/image/admin.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <!-- search form -->
                {{--            <form action="#" method="get" class="sidebar-form"> --}}
                {{--                <div class="input-group"> --}}
                {{--                    <input type="text" name="q" class="form-control" placeholder="Search..."> --}}
                {{--                    <span class="input-group-btn"> --}}
                {{--                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i> --}}
                {{--                </button> --}}
                {{--              </span> --}}
                {{--                </div> --}}
                {{--            </form> --}}
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                @include('layouts.sidebar_menu')
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
            {{-- {!! Admin::script() !!} --}}
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Version</b> 1.0.0
            </div>
            Copyright © {{ env('APP_NAME') }} - {{ date('Y') }}. All rights reserved.

        </footer>


    </div>
    <!-- ./wrapper -->

    <!-- Tagging System -->
    <script src="{{ env('APP_URL') }}public/richtext/src/jquery.richtext.min.js"></script>
    <script src="{{ env('APP_URL') }}public/richtext/src/jquery.caret.js"></script>
    <script src="{{ env('APP_URL') }}public/tags/tags_2.1.js"></script>
    <link rel="stylesheet" href="{{ env('APP_URL') }}public/tags/tags.css">

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.6 -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/jvectormap/jquery-jvectormap-world-mill-en.js">
    </script>
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/chartjs/Chart.min.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js">
    </script>
    <!-- Slimscroll -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/plugins/fastclick/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ env('APP_URL') }}public/AdminLTE-2.3.11/dist/js/app.min.js"></script>


    <script src="{{ env('APP_URL') }}public/js/common.js" type="application/javascript"></script>
    <script src="{{ env('APP_URL') }}public/js/comment_2.1.3.js"></script>
    <script src="{{ env('APP_URL') }}public/js/file_upload1.0.js"></script>

    <!-- tour -->
    <style>


    </style>
    <script src="{{ env('APP_URL') }}public/tour/tour.js"></script>
    <script>
        function position_tour(target) {
            //$(".tour").css({left:$(target).left});

            callout = target + "-callout";

            tour_left_pos = parseInt($(target).offset().left + 350);
            window_width = parseInt($(window).width());
            // if the element is outside screen

            // $("#pending-issue-flag-callout").hide();

            // alert ($(window).width());
            if (tour_left_pos > window_width) {
                // $("#pending-issue-flag-callout").css({left:200+"px"});
            }

        }
    </script>
    <?php
    // $tour = new Tour();
    //$tour->tour();
    ?>
    <script>
        $(document).ready(function() {
            $(document).on("click", "#tour-dont-show", function() {

                datas = "";

                if ($("#tour-dont-show").prop("checked") == true) {
                    datas = 'false';
                } else {
                    datas = 'true';
                }

                $.ajax({
                    type: "GET",
                    url: "tour/save_status",
                    data: {
                        "status": datas
                    },
                    cache: false,
                    success: function(data) {

                    }
                });
            })
        });
    </script>

    {{-- <div id="tour" style="position: absolute; background-color: #000; width: 350px; height: 200px; top: 0; left: 0;"></div> --}}
</body>

</html>
