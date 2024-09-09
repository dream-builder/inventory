@extends('index')

@section('content')
    <section class="content-header"></section>

    <section class="content">

        <div class="box box-warning " >
            <div class="box-header with-border">
                <h3 class="box-title">Edit/Delete Facility</h3>
                <div class="pull-right" id="small-loader" style="display:none"><img src="{{ asset('public/image/loading.gif')}}" width="32px" ></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Facility Registration form -->
                <form>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="zilla_dropdownf"><sup class="text-red">*</sup>Zilla</label>
                            <select id="zilla_dropdownf" class="form-control">
                                <option>Please select</option>
                                <?php
                                if(isset($zilla) && is_array($zilla)){
                                ?>
                                @foreach($zilla as $z)

                                    <option value="{{abs($z->ZillaId)}}"
                                        @if($z->ZillaId == $facility[0]->zillaid)
                                            selected="selected"
                                            @endif
                                    >{{$z->ZillaNameEng}} [{{abs($z->ZillaId)}}]</option>
                                @endforeach
                                <?php
                                }
                                ?>


                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="upazila_dropdownf"><sup class="text-red">*</sup>Upazila</label>
                            <select id="upazila_dropdownf" class="form-control">
                                <option></option>
                                <?php
                                if(isset($upazila) && is_array($upazila)){
                                ?>
                                @foreach($upazila as $u)

                                    <option value="{{abs($u->UpazilaId)}}"
                                            @if($u->UpazilaId == $facility[0]->upazilaid)
                                            selected="selected"
                                            @endif
                                    >{{$u->UpazilaNameEng}} [{{abs($u->UpazilaId)}}]</option>
                                @endforeach
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group" >
                            <label for="union_dropdownf">Union</label>
                            <select id="union_dropdownf" class="form-control">
                                <option></option>
                                <?php
                                if(isset($unions) && is_array($unions)){
                                ?>
                                @foreach($unions as $un)

                                    <option value="{{abs($un->UnionId)}}"
                                            @if($un->UnionId == $facility[0]->unionid)
                                            selected="selected"
                                            @endif
                                    >{{$un->UnionNameEng}} [{{abs($un->UnionId)}}]</option>
                                @endforeach
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facilityid"><sup class="text-red">*</sup> Facility ID</label>
                            <input type="text" class="form-control" value="{{$facility[0]->facilityid}}" id="facilityid" placeholder="Facility id" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lat"><sup class="text-red">*</sup>Facility Name</label>
                            <input type="text" class="form-control" id="facilityname" value="{{$facility[0]->facility_name}}" placeholder="Facility Name" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facilitynameeng"><sup class="text-red">*</sup>Facility Name (Eng.)</label>
                            <input type="text" class="form-control" id="facilitynameeng" value="{{$facility[0]->facility_name_eng}}" placeholder="Facility Name (Eng.)" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facility_type"><sup class="text-red">*</sup>Facility Type</label>
                            <select id="facility_type" class="form-control">
                                <option value="0" selected>Please select facility type</option>

                                <?php
                                if(isset($facility_type) && is_array($facility_type)){
                                ?>
                                @foreach($facility_type as $ft)

                                    <option value="{{abs($ft->type)}}"
                                            @if($ft->type == $facility[0]->facility_type_id)
                                            selected="selected"
                                            @endif
                                    >{{$ft->short_code }} [{{$ft->type }}]</option>
                                @endforeach
                                <?php
                                }
                                ?>
                                
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="facility_owner">Facility Owner</label>
                            <select id="facility_owner" class="form-control">
                                <option value="0" @if($facility[0]->facility_owner=='0') selected="selected" @endif >Not Defined</option>
                                <option value="DGFP" @if($facility[0]->facility_owner=='DGFP') selected="selected" @endif>DGFP</option>
                                <option value="DGHS" @if($facility[0]->facility_owner=='DGHS') selected="selected" @endif>DGHS</option>
                                <option value="Private" @if($facility[0]->facility_owner=='Private') selected="selected" @endif>Private</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lat">Latitude</label>
                            <input type="text" class="form-control" id="lat" value="{{$facility[0]->lat}}" placeholder="Lat" >
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="lat">Lon</label>
                            <input type="text" class="form-control" id="lon" value="{{$facility[0]->lon}}" placeholder="Longitude" >
                        </div>
                    </div>


                    <div class="col-md-12">
                        <button type="button" id="facility-update-btn" class="btn btn-info">Update</button>
                        <button type="button" id="facility-del-btn" class="btn btn-danger pull-right">Delete this facility</button>
                    </div>

                </form>

                <!-- //Facility Registration form -->
            </div><!--/box-body -->

        </div> <!--/ box -->

    </section>

    <script>
        function check_existing_facility(id){
            var result;


            return result;
        }

        $(document).ready(function (){

            $("#zilla_dropdownf").change (function (){
                $("#app-loader").show();
                $.ajax({
                    type: "GET",
                    url: site_url+"/getupazila",
                    data: {"zillaid":$(this).val()},
                    cache: false,
                    success: function(data){
                        //console.log(data);

                        //Populate Zilla Deopdown

                        $("#upazila_dropdownf").empty();
                        $("#union_dropdownf").empty();

                        $('#upazila_dropdownf').append('<option selected="selected"></option>');
                        $.each( data, function( key, val ) {

                            if(val.UpazilaId<10)
                                upazilaid = "0" +  val.UpazilaId;
                            else
                                upazilaid = val.UpazilaId;

                            $('#upazila_dropdownf').append($('<option>', {value:val.UpazilaId, text:val.UpazilaNameEng + '['+val.UpazilaId+']'}));
                        });

                        $("#app-loader").hide();

                    }
                });
            });


            //Getting Union
            $("#upazila_dropdownf").change(function (){
                $("#app-loader").show();
                //alert('');
                console.log({"zillaid":$("#zilla_dropdownf").val(),"upazilaid":$("#upazila_dropdownf").val()});
                $.ajax({
                    type: "GET",
                    url: site_url+"/getunions",
                    data: {"zillaid":$("#zilla_dropdownf").val(),"upazilaid":$("#upazila_dropdownf").val()},
                    cache: false,
                    success: function(data){
                        console.log(data);


                        //Populate Unions Dropdown

                        $("#union_dropdownf").empty();

                        $('#union_dropdownf').append('<option selected="selected"></option>');
                        $.each( data, function( key, val ) {

                            if(val.UnionId<10)
                                unionid = "0" +  val.UnionId;
                            else
                                unionid = val.UnionId;

                            $('#union_dropdownf').append($('<option>', {value:val.UnionId, text:val.UnionNameEng +'[' + val.UnionId +']' }));
                        });

                        $("#app-loader").hide();

                    }
                });
            });


            $("#facility-update-btn").click(function (){

                $("#app-loader").show();
                //Creating Json
                var facility_json= {
                    "zillaid": $("#zilla_dropdownf").val(),
                    "upazilaid": $("#upazila_dropdownf").val(),
                    "unionid": $("#union_dropdownf").val(),
                    "facilityid":$("#facilityid").val(),
                    "facility_type": $("#facility_type").val(),
                    "facility_owner": $("#facility_owner").val(),
                    "lat":$("#lat").val(),
                    "lon":$("#lon").val(),
                    "facility_name":$("#facilityname").val(),
                    "facility_name_eng":$("#facilityname").val()
                };


                csr_token = "e040cb79944b0c6e6da7862ea2266243";

                $.ajax({
                    type: "GET",
                    url: site_url+"/facility/update",
                    data: {"facility_data": facility_json },
                    cache: false,
                    success: function(data){

                        // if(data != 0){
                        //     sweetAlert('Facility Already exists','Faility ID: '+$("#facilityid").val());
                        //
                        //     return false;
                        // }else{
                        //     $.ajax({
                        //         type: "GET",
                        //         url: site_url+"/api/add_facility",
                        //         data: {"data": JSON.stringify(facility_json) ,"token":token},
                        //         cache: false,
                        //         success: function(data){
                        //             console.log(data);
                        //             sweetAlert("Facility Added Successfully.",'','success');
                        //         }
                        //     });
                        //
                        // }
                        sweetAlert("Facility Update Success.",'','success');
                        $("#app-loader").hide();
                    }
                });

            });


        })
    </script>

@endsection
@section('script')
    <script></script>
@endsection

