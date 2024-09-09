<?php
    $zilla = json_decode('{
	"01": "BAGERHAT",
	"03": "BANDARBAN",
	"04": "BARGUNA",
	"06": "BARISAL",
	"09": "BHOLA",
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


                <div class="col-md-2">
                    <!-- District -->
                    <div class="form-group" id="">
                        <label for="zilla_dropdown">Zilla</label>
                        <select class="form-control" id="geo_zilla_dropdown">
							<option value="-1" selected="selected">Please select...</option>
                            @foreach($zilla as $key=>$val)
                                <option value="{{$key}}">{{$val}} [{{$key}}]</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-2" >
                    <!-- Upazilla -->
                    <div class="form-group " id="" >
                        <label for="upazila_dropdown">Upazila</label>
                        <select class="form-control" id="geo_upazila_dropdown" >
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-2">
                    <!-- union -->
                    <div class="form-group " id=""  >
                        <label for="upazila_dropdown">Union</label>
                        <select class="form-control" id="geo_union_dropdown" >
                            <option value="0"></option>
                        </select>
                    </div>
                </div>

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

                $('#geo_upazila_dropdown').append('<option value="0" ed="selected"></option>');
                $('#geo_union_dropdown').append('<option  value="0" selected="selected"></option>');

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

                $('#geo_union_dropdown').append('<option  value="0" selected="selected"></option>');

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

</script>