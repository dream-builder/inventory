@extends('index')
@section('content')
    <section class="content-header"></section>

    <section class="content">
        <!-- issue Details header -->
        <div  class="row">
            <div class="col-md-12" style="margin-bottom: 10px;padding-top: 20px;padding-bottom: 10px;margin-top: -60px;background-color: #80A5DF;color: #FFF;">

                <h3 style="color: #000;">Focal Person Mail</h3>

            </div>

        </div>
        <!-- issue Details header -->


        <!-- Detail and list -->
        <div class="row">
            <!-- Issue detail -->
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Region</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="issue-detail-reply"  >
                        @include('component.geo_component_view')
                            <div class="col-md-2">
                                <label for="list_focal">&nbsp;</label>
                                <div class="input-group" >
                                    <button type="button" class="btn btn-primary" id="list_focal"><i class="fa fa-binoculars"></i> Search</button>
                                </div>
                            </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div><!--/row -->

        <div class="row">
            <!-- Focal person -->
            <div id="Issue_detatils" class="col-md-6">
                <div id="comment-panel">
                    <!-- search result -->
                    <div class="box box-primary">
                        <div class="box-header with-border" >
                            <h3 class="box-title">Focal Person</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="focal-person-list" style="height: 500px; overflow-y: scroll; padding-bottom: 15px;">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                                </thead>

                                <tbody id="focal-person-table" >

                                </tbody>


                            </table>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-danger" id="remove-focal">Remove from Focal Person</button>
                        </div>

                    </div>



                </div>
            </div>

            <!-- Focal person -->
            <div id="Issue_detatils" class="col-md-6">
                <div id="comment-panel">
                    <!-- search result -->
                    <div class="box box-primary">
                        <div class="box-header with-border" >
                            <h3 class="box-title">All Users</h3>
                            <div class="input-group input-group-sm" style="width: 350px; float: right;">

                                <input type="text" class="form-control" id="find-user" placeholder="User name or email">
                                <span class="input-group-btn">
                                  <button type="button" id="find-user-btn" class="btn btn-info btn-flat">Find</button>
                                </span>

                            </div>


                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="height: 500px; overflow-y: scroll; padding-bottom: 15px;">



                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                        </tr>
                                    </thead>


                                    @if(sizeof($data)>0 && is_array($data))
                                        <tbody id="all-user-list" >
                                        @foreach ($data as $d)

                                            <tr>
                                                <td><input class="userid-ul" type="checkbox" value="{{$d->user_id}}" name="useridul[]"> </td>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->email}}</td>
                                            </tr>


                                        @endforeach
                                        </tbody>
                                    @endif
                                </table>
                        </div>
                        <div class="box-footer">
                            <button class="btn btn-success" id="add-to-focal-person">Add to Focal Person</button>
                            <button class="btn btn-default ">Deselect All</button>
                        </div>
                    </div>

                </div>
            </div>


        </div>
        <!-- /Detail and list -->



    </section>

    <style>
        .facility_tr{
            cursor:pointer;
        }

        table {
            text-align: left;
            position: relative;
        }

        thead tr {
            background: white;
            position: sticky;
            top: 0;
        }

    </style>
    <script>


        //Clean Focla person table when changing GEO fields
        $("#geo_zilla_dropdown, #geo_upazila_dropdown, #geo_union_dropdown").change(function (){
            //Empty focal persion list table
            $("#focal-person-table").empty();
        });

        function generate_table(){

            $("#app-loader").show();

            var data = {
                "ajax":true,
                "zillaid": $("#geo_zilla_dropdown").val(),
                "upazilaid": $("#geo_upazila_dropdown").val(),
                "unionid": $("#geo_union_dropdown").val()
            };

            $.ajax({
                type: "GET",
                url: site_url+"/focalpersonmail",
                data: data,
                cache: false,
                success: function(data){
                    console.log(data);

                    //Empty focal persion list table
                    $("#focal-person-table").empty();

                    $.each( data, function( key, val ) {
                        $('#focal-person-table').append(
                            "<tr>" +
                            "<td><input type=\"checkbox\" value=\""+val.user_id+"\" name=\"userlisted\" class=\"userlisted\"> </td>" +
                            "<td>"+val.name+"</td>" +
                            "<td>"+val.email+"</td>" +
                            "</tr>");
                    });

                    $("#app-loader").hide();
                }
            });

        }
        $(document).ready(function (){
            $("#list_focal").click(function (){
                generate_table();
            });


            //Add to Focal person
            $("#add-to-focal-person").click(function (){

                var users = [];
                $('.userid-ul:checked').each(function(i, e) {
                    users.push($(this).val());
                });

                var data = {
                    "ajax":true,
                    "zillaid": $("#geo_zilla_dropdown").val(),
                    "upazilaid": $("#geo_upazila_dropdown").val(),
                    "unionid": $("#geo_union_dropdown").val(),
                    "users":users.join() // make user CSV
                };

                $("#app-loader").show();
                $.ajax({
                    url: site_url+"/set_focal_person",
                    type: "get",
                    data: data,
                    success: function(data) {
                        console.log(data);
                        generate_table();

                        //Uncheck all checkbox checked
                        $('.userid-ul').prop('checked', false); // Unchecks it

                    }
                });

            });

            function  del_focal_person(){
                var users = [];
                $('.userlisted:checked').each(function(i, e) {
                    users.push($(this).val());
                });

                var data = {
                    "ajax":true,
                    "zillaid": $("#geo_zilla_dropdown").val(),
                    "upazilaid": $("#geo_upazila_dropdown").val(),
                    "unionid": $("#geo_union_dropdown").val(),
                    "users":users.join() // make user CSV
                };

                $("#app-loader").show();
                $.ajax({
                    url: site_url+"/del_focal_person",
                    type: "get",
                    data: data,
                    success: function(data) {
                        console.log(data);
                        generate_table();
                    }
                });
            }

            //Remove Focal persons
            $("#remove-focal").click(function (){

                swal({
                        title: "Are you sure?",
                        text: "Selected users will be removed from email list.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            del_focal_person();
                            swal("Deleted!", "User has been removed from email list.", "success");
                        } else {

                            swal("Cancelled", "", "error");
                            return ;
                        }
                        sweetAlert
                    }
                );



            });

            $("#find-user-btn").click(function (){
                var data = {
                    "ajax":true,
                    "find": $("#find-user").val()
                };

                $("#app-loader").show();
                $.ajax({
                    url: site_url+"/find_user",
                    type: "get",
                    data: data,
                    success: function(data) {
                        $("#all-user-list").empty().append(data);
                        $("#app-loader").hide();
                    }
                });
            });


        });

    </script>


@endsection
@section('script')

@endsection