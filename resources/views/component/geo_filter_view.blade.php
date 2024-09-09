<?php
    $zilla = json_decode('{
	"1": "BAGERHAT",
	"3": "BANDARBAN",
	"4": "BARGUNA",
	"6": "BARISAL",
	"9": "BHOLA",
	"10": "BOGRA",
	"12": "BRAHMANBARIA",
	"13": "CHANDPUR",
	"15": "CHITTAGONG",
	"18": "CHUADANGA",
	"19": "COMILLA",
	"22": "COXS BAZAR",
	"26": "DHAKA",
	"27": "DINAJPUR",
	"29": "FARIDPUR",
	"30": "FENI",
	"32": "GAIBANDHA",
	"33": "GAZIPUR",
	"35": "GOPALGANJ",
	"36": "HABIGANJ",
	"38": "JOYPURHAT",
	"39": "JAMALPUR",
	"41": "JESSORE",
	"42": "JHALOKATI",
	"44": "JHENAIDAH",
	"46": "KHAGRACHHARI",
	"47": "KHULNA",
	"48": "KISHOREGONJ",
	"49": "KURIGRAM",
	"50": "KUSHTIA",
	"51": "LAKSHMIPUR",
	"52": "LALMONIRHAT",
	"54": "MADARIPUR",
	"55": "MAGURA",
	"56": "MANIKGANJ",
	"57": "MEHERPUR",
	"58": "MAULVIBAZAR",
	"59": "MUNSHIGANJ",
	"61": "MYMENSINGH",
	"64": "NAOGAON",
	"65": "NARAIL",
	"67": "NARAYANGANJ",
	"68": "NARSINGDI",
	"69": "NATORE",
	"70": "CHAPAI NABABGANJ",
	"72": "NETRAKONA",
	"73": "NILPHAMARI",
	"75": "NOAKHALI",
	"76": "PABNA",
	"77": "PANCHAGARH",
	"78": "PATUAKHALI",
	"79": "PIROJPUR",
	"81": "RAJSHAHI",
	"82": "RAJBARI",
	"84": "RANGAMATI",
	"85": "RANGPUR",
	"86": "SHARIATPUR",
	"87": "SATKHIRA",
	"88": "SIRAJGANJ",
	"89": "SHERPUR",
	"90": "SUNAMGANJ",
	"91": "SYLHET",
	"93": "TANGAIL",
	"94": "THAKURGAON"}'

    );

   // var_dump($zilla);
?>

<!-- GEO --->
<div class="col-md-12">

    <div class="box box-warning">
        <div class="box-header">
            <h3 class="box-title">Search Options</h3>
        </div>
        <div class="box-body">
            <div class="row">
{{--                <div class="col-md-2">--}}
{{--                    <!-- Division -->--}}
{{--                    <div class="form-group" >--}}
{{--                        <label for="div_dropdown">Division</label>--}}
{{--                        <select class="form-control" id="div_dropdown">--}}
{{--                            <option selected="selected" value="0">All</option>--}}
{{--                            <option value="10">Barisal [10]</option>--}}
{{--                            <option value="20">Chittagong [20]</option>--}}
{{--                            <option value="30">Dhaka [30]</option>--}}
{{--                            <option value="40">Khulna [40]</option>--}}
{{--                            <option value="70">Mymensingh [70]</option>--}}
{{--                            <option value="50">Rajshahi [50]</option>--}}
{{--                            <option value="55">Rangpur [55]</option>--}}
{{--                            <option value="60">Sylhet [60]</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="col-md-2">
                    <!-- District -->
                    <div class="form-group" id="">
                        <label for="zilla_dropdown">Zilla</label>
                        <select class="form-control" id="geo_zilla_dropdown">
							<option value="-1" selected="selected">Please select...</option>
                            @foreach($zilla as $key=>$val)
                                <?php $k = $key<=9?"0".$key:$key;?>
                                <option value="{{$k}}">{{$val}} [{{$k}}]</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2" >
                    <!-- Upazilla -->
                    <div class="form-group " id="" >
                        <label for="upazila_dropdown">Upazila</label>
                        <select class="form-control" id="geo_upazila_dropdown" >

                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <!-- union -->
                    <div class="form-group " id=""  >
                        <label for="upazila_dropdown">Union</label>
                        <select class="form-control" id="geo_union_dropdown" >

                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-md-2 " >
                    <label for="upazila_dropdown">Start Date</label>
                    <div class="input-group" >
                        <input type="text" class="form-control datepicker" id="start_date" >
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-2 " >
                    <label for="upazila_dropdown">End Date</label>
                    <div class="input-group" >
                        <input type="text" class="form-control datepicker" id="end_date" >
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="upazila_dropdown">&nbsp &nbsp;</label>
                        <div class="input-group" >
                            <button type="button" class="btn btn-primary" id="get_result"><i class="fa fa-binoculars"></i> Search</button>
                        </div>
                    </div>

            </div>

        </div>
    </div>



</div>

@include('component.date_range_filter_vew')

<script>
    $("#geo_zilla_dropdown").change(function(){

        $("#app-loader").show();
        console.log($(this).val());
        $.ajax({
            type: "GET",
            url: site_url+"/getupazila",
            data: {"zillaid":$(this).val()},
            cache: false,
            success: function(data){

                console.log(data);
                //Populate Zilla Deopdown

                $("#geo_upazila_dropdown").empty();
                $("#geo_union_dropdown").empty();

                $('#geo_upazila_dropdown').append('<option selected="selected"></option>');

                $.each( data, function( key, val ) {

                    if(val.UpazilaId<10)
                        upazilaid = "0" +  val.UpazilaId;
                    else
                        upazilaid = val.UpazilaId;

                    $('#geo_upazila_dropdown').append($('<option>', {value:upazilaid, text:val.UpazilaNameEng + ' ['+upazilaid+']'}));
                });

                $("#app-loader").hide();



            }
        });

    });

    $("#geo_upazila_dropdown").change(function(){

        $("#app-loader").show();

        $.ajax({
            type: "GET",
            url: site_url+"/getunions",
            data: {"zillaid":$("#geo_zilla_dropdown").val(),"upazilaid":$("#geo_upazila_dropdown").val()},
            cache: false,
            success: function(data){
                console.log(data);

                $("#geo_union_dropdown").empty();

                $('#geo_union_dropdown').append('<option selected="selected"></option>');

                $.each( data, function( key, val ) {

                    if(val.UpazilaId<10)
                        upazilaid = "0" +  val.UnionId;
                    else
                        upazilaid = val.UnionId;

                    $('#geo_union_dropdown').append($('<option>', {value:val.UnionId, text:val.UnionNameEng + ' ['+val.UnionId+']'}));
                });

                $("#app-loader").hide();
            }
        });

    });


    // //Date pickere
     $('.datepicker').datepicker({
         dateFormat: 'yy-mm-dd',
     });
</script>