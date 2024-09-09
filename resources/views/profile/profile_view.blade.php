@extends('index')

@section('content')
    <section class="content-header">
        <h1>User Profile</h1>
    </section>

    <div class="content">

        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
{{--                        <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">--}}

                        <h3 class="profile-username text-center">{{$user_info->name}}</h3>

                        <p class="text-muted text-center">{{$user_info->designation_name}}</p>

                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Issue Created</b> <a class="pull-right">{{$activity->issue}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Issue Solved</b> <a class="pull-right">{{$activity->resolved}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Postpone</b> <a class="pull-right">{{$activity->postpone}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Comments</b> <a class="pull-right">{{$activity->comment}}</a>
                            </li>
                        </ul>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact Info</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow: hidden">

                        <strong><i class="fa fa-user margin-r-5"></i> System ID</strong>
                        <p class="text-muted">
                            {{$user_info->user_id}}
                        </p>
                        <hr>

                        <strong><i class="fa fa-envelope margin-r-5"></i> Email</strong>
                        <p class="text-muted" title="{{$user_info->email}}">
                            {{$user_info->email}}
                        </p>
                        <hr>

                        <strong><i class="fa fa-phone margin-r-5"></i> Phone/Mobile</strong>
                        <p class="text-muted">
                            {{$user_info->phone}}
                        </p>
                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Work Location</strong>
                        <p class="text-muted">{{$user_info->address}}</p>

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li ><a href="#Performance" data-toggle="tab">Performance</a></li>
                        <li class="active" ><a href="#detail-section" data-toggle="tab">Profile</a></li>
                        <li><a href="#passwordsection" data-toggle="tab">Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class=" tab-pane " id="Performance">
                            <!-- Post -->
                            <div class="post">
                                <!-- /.user-block -->
                                @include('profile.donut_performance_view')
                            </div>
                            <!-- /.post -->

                        </div>
                        <!-- //about -->

                        <!-- /.tab-pane -->
                        <div class="tab-pane active" id="detail-section">
                            <form class="form-horizontal">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label"></label>
                                    <div class="col-sm-10" style="padding:15px">
                                        <span class="alert alert-info" >Dear <b>{{$user_info->name}}</b>, your profile is not updated. Please Update your profile.</span>
                                    </div>
                                </div>

                               <div class="form-group">
                                   <label for="name" class="col-sm-2 control-label"></label>
                                   <div class="col-sm-10" >
                                    <span class="text-red" >* Marked fields are mandatory.</span>
                                   </div>
                               </div>
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Name<sup class="text-red">*</sup> </label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" placeholder="Name" value="{{$user_info->name}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label" >Email<sup class="text-red">*</sup></label>

                                    <div class="col-sm-10">
                                        <input disabled type="email" class="form-control" id="email" placeholder="Email" value="{{$user_info->email}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="designation" class="col-sm-2 control-label">Phone/Mobile<sup class="text-red">*</sup></label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" placeholder="Phone/Mobile" value="{{$user_info->phone}}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="designation" class="col-sm-2 control-label">Designation<sup class="text-red">*</sup></label>

                                    <div class="col-sm-10">

                                        <select class="form-control" id="designation">
                                            <option value="0" >Please select</option>

                                            @foreach($designation as $d)
                                                <option value="{{$d->id}}"
                                                        @if($d->id == $user_info->designation)
                                                            selected="selected"
                                                        @endif
                                                >{{$d->designation}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Address<sup class="text-red">*</sup></label>

                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="address" placeholder="Address">{{$user_info->address}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="zilla" class="col-sm-2 control-label">Zilla<sup class="text-red">*</sup></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="zilla">
                                            <option></option>

                                            @foreach($zilla as $z)
                                                <option value="{{$z->ZillaId}}"
                                                        @if($z->ZillaId == $user_info->zilla_id)
                                                            selected
                                                        @endif
                                                >{{$z->ZillaNameEng}} [{{$z->ZillaId}}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="upazilla" class="col-sm-2 control-label">Upazila<sup class="text-red">*</sup></label>
                                    <div class="col-sm-10">

                                        <select class="form-control" id="upazilla">
                                            <option selected></option>
                                            @foreach($upazila as $uz)
                                                <option value="{{$uz->UpazilaId}}"
                                                        @if($uz->UpazilaId == $user_info->upazilla_id)
                                                        selected
                                                        @endif
                                                >{{$uz->UpazilaNameEng}} [{{$uz->UpazilaId}}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="union" class="col-sm-2 control-label">Union<sup class="text-red">*</sup></label>
                                    <div class="col-sm-10">
                                        <select class="form-control" id="union">
                                            <option selected></option>
                                            @foreach($union as $un)
                                                <option value="{{$un->UnionId}}"
                                                        @if($un->UnionId == $user_info->union_id)
                                                        selected
                                                        @endif
                                                >{{$un->UnionNameEng}} [{{$un->UnionId}}]</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-danger" id="profile-update" >Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="passwordsection">
                            <form role="form" class="form-horizontal">
                                <div class="form-group">
                                    <label for="oldpass" class="col-sm-3 control-label">Old Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="oldpass" placeholder="Old Password">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="newpass" class="col-sm-3 control-label">New Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="newpass" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="repass" class="col-sm-3 control-label">Re-type New Password </label>
                                    <div class="col-sm-9">
                                        <input type="password" class="form-control" id="repass" placeholder="Re-type New Password">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="button" class="btn btn-danger" id="reset_submit">Change Password</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/COntent-->

    <script>
        $(document).ready(function (){

            $("#profile-update").click(function (){

                var data_post ={
                    'name': $("#name").val(),
                    'phone': $("#phone").val(),
                    'designation':$("#designation").val(),
                    'address': $("#address").val(),
                    'zilla_id': $("#zilla").val(),
                    'upazila_id':$("#upazilla").val(),
                    'union_id':$("#union").val()
                };

                //console.log("edit value", data_post);

                //Data validation
                if($("#name").val().length<5){
                    sweetAlert("Please write your full name.");
                    return ;
                }

                if($("#phone").val().length<5){
                    sweetAlert("Please write your phone/mobile number.");
                    return ;
                }

                if($("#address").val().length<5){
                    sweetAlert("Please write your address.");
                    return ;
                }

                $("#app-loader").show();
                $.ajax({
                    type: "GET",
                    url: site_url + "/profile_update",
                    data: data_post,
                    cache: false,
                    success: function(data){
                        if(data=="Success")
                        {
                            //sweetAlert("",'success');
                            $("#app-loader").hide();
                            swal("Success", "Information update Success", "success");
                        }
                    }
                });
            });

            //Zilla select
            $("#zilla").change(function (){
                $.ajax({
                    type: "GET",
                    url: site_url + "/getupazila",
                    data: {"zillaid":$(this).val()},
                    cache: false,
                    success: function(data){
                            $("#upazilla").empty();

                            $('#upazilla').append('<option selected="selected"></option>');
                            $.each( data, function( key, val ) {
                                $('#upazilla').append($('<option>', {value:val.UpazilaId, text:val.UpazilaNameEng + ' ['+val.UpazilaId+']'}));
                            });

                            $("#app-loader").hide();

                    }
                });

            });

            //Upz Zilla select
            $("#upazilla").change(function (){

                $.ajax({
                    type: "GET",
                    url: site_url + "/getunions",
                    data: {"zillaid":$("#zilla").val(),"upazilaid": $("#upazilla").val()},
                    cache: false,
                    success: function(data){
                        $("#union").empty();

                        $('#union').append('<option selected="selected"></option>');
                        $.each( data, function( key, val ) {
                            $('#union').append($('<option>', {value:val.UnionId, text:val.UnionNameEng + ' ['+val.UnionId+']'}));
                        });

                        $("#app-loader").hide();

                    }
                });

            });

        });


    </script>



@endsection
@section('script')




@endsection