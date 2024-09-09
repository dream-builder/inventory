@extends('index')

@section('content')
    <section class="content-header">
        <h1>Add User</h1>
    </section>

    <div class="content">

        <div class="row">

            <!-- /.col -->
            <div class="col-md-9">
              <!-- user interface -->
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
              <!-- //user interface -->
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


