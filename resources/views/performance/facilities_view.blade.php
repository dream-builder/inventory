@extends('index')

@section('content')
    <section class="content-header">
    </section>

    <section class="content">
        <!-- issue Details header -->

           <div class="col-md-12" style="margin-top: -15px;margin-bottom: 30px;border-bottom: solid 2px #000;">
               <div class="row">
                   <div style="color: #fff;display: inline-block;background-color: #4D4D4D;padding: 10px 25px; font-size: 16px;">Facilities</div>
               </div>

           </div>
           

        <!-- issue Details header -->


        <!-- Detail and list -->
        <div class="row">

            <!-- GEO --->
            <div class="col-md-12">

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Location</h3>
                    </div>
                    <div class="box-body">
                       

                            <div class="col-md-2">
                                <!-- Upazilla -->
                                <div class="form-group" id="facility_type_group" >
                                    <label for="facility_type">Facility Type</label>
                                    <select class="form-control" id="facility_type_dropdown">
                                        <option value="=0" selected="selected">All</option>
                                        @foreach($facility_type as $ft)
                                            <?php
                                                $selected = '';
                                                if(isset($_GET['type'])){
                                                    if($ft->type == $_GET['type']){
                                                        $selected = 'selected=""selected"';
                                                    }
                                                }

                                            ?>
                                            <option {{$selected}} value="{{$ft->type}}">{{$ft->description}}({{($ft->short_code)}})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <!-- Division -->
                                <div class="form-group" >
                                    <label for="div_dropdown">Division</label>
                                    <select class="form-control" id="div_dropdown">
                                        <option selected="selected" value="0">All</option>
                                        <option value="10">Barisal [10]</option>
                                        <option value="20">Chittagong [20]</option>
                                        <option value="30">Dhaka [30]</option>
                                        <option value="40">Khulna [40]</option>
                                        <option value="70">Mymensingh [70]</option>
                                        <option value="50">Rajshahi [50]</option>
                                        <option value="55">Rangpur [55]</option>
                                        <option value="60">Sylhet [60]</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <!-- District -->
                                <div class="form-group" id="zilla_group"  style="display:none">
                                    <label for="zilla_dropdown">Zilla</label>
                                    <select class="form-control" id="zilla_dropdown">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-2">
                                <!-- Upazilla -->
                                <div class="form-group" id="upazila_group" style="display:none">
                                    <label for="upazila_dropdown">Upazila</label>
                                    <select class="form-control" id="upazila_dropdown">

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <button type="button" class="btn btn-primary" id="get_facilities_by_geo"><i class="fa fa-binoculars"></i> Search</button>
                            </div>

                    </div>
                </div>

            </div>


            <!-- Issue detail -->
            <div class="col-md-12">
                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Facilities</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body" id="issue-detail-reply"  >
                    @include('reports.facilities_ajax_view')
                </div>
                <!-- /.box-body -->


            </div>
            </div>

            <!-- More related issue in this facility -->
          
            <!-- /More related issue in this facility -->
            <!-- Issue list -->
        </div>
        <!-- /Detail and list -->

        <!-- Edit modal will load here-->
        <div id="issue-edit-modal"></div>


    </section>

    <style>
        .facility_tr{
            cursor:pointer;
        }
    </style>

    <script>
        $(document).ready(function (){
            $("#get_facilities_by_geo").click(function (){

                var zilla = $("#zilla_dropdown").val();;
                var upazila = $("#upazila_dropdown").val();
                var union = null;

                //if zilla id <9 then add 0 prefix
                if($("#zilla_dropdown").val() <=9){
                    zilla = "0"+$("#zilla_dropdown").val();
                }

                //if upzaila id <9 then add 0 prefix
                if($("#zilla_dropdown").val() <=9){
                    zilla = "0"+$("#zilla_dropdown").val();
                }

                //console.log(zilla);

                $("#app-loader").show();//show loader
                var data_post ={
                    'div': $("#div_dropdown").val(),
                    'zilla': zilla,
                    'upazila':upazila,
                    'facility_type':$("#facility_type_dropdown").val()
                };

               //console.log(data_post);
                $("#issue-detail-reply").html('');
               $.ajax({
                    type: "GET",
                    url: "report/facilities_ajax",
                    data: data_post,
                    cache: false,
                    success: function(data){
                        $("#issue-detail-reply").html(data);

                        $("#app-loader").hide();
                    }
                });


            });


        });
    </script>
@endsection
@section('script')
    <script>

    </script>
@endsection

