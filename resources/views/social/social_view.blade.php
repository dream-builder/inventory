<html xmlns="http://www.w3.org/1999/html">

    <head>
        <title>Activity Tracking System</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" >
        <link href="{{ asset('public/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset("public/font-awesome/css/font-awesome.min.css") }}">

        <!-- Social -->
        <link rel="stylesheet" href="{{ asset("public/css/social/social.css") }}">


        <script src="{{ asset("public/js/jquery.min.js")}}" type="application/javascript"></script>
        <script src="{{ asset('public/js/bootstrap.min.js') }}" type="application/javascript"> </script>
        <script src="{{ asset('public/js/social/social.js') }}" type="application/javascript"> </script>
    </head>

    <body>

            <div class="social_header">
                <div class="social-title">Activity Tracking</div>

                <div class="action-bar">
                    <div class="action-icon-group">
                        <div class="action-icon active"><i class="fa fa-home"></i></div>
                        <div class="action-icon"><i class="fa fa-dashboard"></i></div>
                        <div class="action-icon"><i class="fa fa-plus"></i></div>
                        <div class="action-icon"><i class="fa fa-info"></i></div>
                        <div class="action-icon"><i class="fa fa-search"></i></div>
                    </div>
                </div>

                <div class="search-bar col-md-12" style="background-color:#00a65a; padding-top: 3px; padding-bottom: 3px;">

                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group-sm">
                                <select class="form-control">
                                    <option>Select Division</option>
                                    <option>Dhaka</option>
                                    <option>Chottrogram</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group-sm">
                                <select class="form-control">
                                    <option>Select Zilla</option>
                                    <option>Dhaka</option>
                                    <option>Chottrogram</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sx-2">
                            <div class="form-group-sm">
                                <select class="form-control">
                                    <option>Select Upazila</option>
                                    <option>Dhaka</option>
                                    <option>Chottrogram</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-2 ">
                            <div class="form-group-sm">
                                <select class="form-control">
                                    <option>Select Union</option>
                                    <option>Dhaka</option>
                                    <option>Chottrogram</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sx-2">
                            <div class="form-group-sm">
                                <select class="form-control">
                                    <option>Select Facility</option>
                                    <option>Dhaka</option>
                                    <option>Chottrogram</option>
                                </select>
                            </div>
                        </div>


                    </div>



                </div>
                <!-- /search-bar -->

            </div>
            <!--/social_header -->

            <div class="social-container">
                
                <!-- Activity -->
                @for($i=0;$i<=5;$i++)
                <!-- comment -->
                <div class="direct-chat-msg">
                    <div class="direct-chat-info clearfix">
                        <small>
                            <span class="text-bold"><strong>Created By:</strong> <i class="fa fa-user-circle"></i> Md. Nazrul Islam</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;<span class="text-bold"><strong>Facility:</strong> <i class="fa fa-hospital-o"></i> Daulatpur UH&FWC</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i><span class="text-bold"> 2020-12-02 12:12:02</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;<strong>Tentative Completion Date: </strong><i class="fa fa-calendar"></i><span class="text-bold"> 2020-12-02 12:12:02</span>
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-star"></i><span class="text-bold"> High</span>
                        </small>
                    </div>

                    <div class="direct-chat-text">
                        In ANC &amp; PNC corner all types of logistics (BP machine, height scale, Talquist book, Watch, step for PW) are not available in this facility.
                    </div>


                    <div class="action-button">
                        <i class="fa fa-reply"></i> Reply &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-flag"></i> Change Status &nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="fa fa-edit"></i> Edit &nbsp;&nbsp;&nbsp;&nbsp;
                    </div>

                    <!-- Reply -->
                    <div style="padding: 5px; margin-bottom: 3px; background-color: #FFF;">
                        <small style="color:#999"><strong>Reply from:</strong> <i class="fa fa-user-circle"></i> Fazlur Rahman &nbsp;&nbsp;&nbsp;&nbsp;
                            <i class="fa fa-calendar"></i> 2020-12-14 13:16:18</small>
                        <p style="margin-top: 7px;">test 1</p>


                    <!--
                    <div class="direct-chat-btn">

                        <button class="btn btn-xs reply-issue" data-parentid="62" data-facility_id="5678471"><span class="fa fa-reply"></span></button>


                        </div>

                    -->
                    </div>
                </div>
                <!--/comments -->
                @endfor
                <!-- /Activity -->

            </div>
            <!-- /social-container -->

    </body>

</html>
