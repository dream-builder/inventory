
@extends('index')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-6"><h3>Assignment Status</h3></div>

        </div>


        <div class="row" style="margin-top: 15px;">

            <!-- selection area -->
            <div class="col-md-12">


                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Assignment Status</h3>
                    </div>

                    <div class="box-body" id="assign-list">

                    </div>

                </div>

            </div>

        </div>

    </section>

    <script>

        function get_list(){
            $("#app-loader").show();
            $.ajax({
                type: "GET",
                url: site_url+"/assessment_status_list",
                // data: data,
                cache: false,
                success: function(data){
                    // console.log(data);

                    $("#assign-list").html(data);
                    $("#app-loader").hide();
                }
            });
        }

        function resigter_assignment(){
            $("#app-loader").show();

            var facility = $("#facility").val();
            var section = $("#section").val();
            var assessor = $("#assessor").val();

            data = {
                "facility":facility,
                "section":section,
                "assessor":assessor
            };

            $.ajax({
                type: "GET",
                url: site_url+"/register_assignment",
                data: data,
                cache: false,
                success: function(data){
                    //console.log(data);
                    $("#assign-list").html(data);
                    $("#app-loader").hide();
                }
            });
        }

        function remove_assessment(id){
            data = {
                "id":id
            };

            $.ajax({
                type: "GET",
                url: site_url+"/remove_assignment",
                data: data,
                cache: false,
                success: function(data){
                    $("#assign-list").html(data);
                    $("#app-loader").hide();
                }
            });
        }


        $(document).ready(function (){
            get_list();

            $("#assingsection").click(function (){
                resigter_assignment();
            });


            $(document).on('click','.assign_id',function (){

                var id = $(this).data('id');
                swal({
                        title: "Are you sure?",
                        text: "Selected assessor will be removed from assessment list. ",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, remove it!",
                        cancelButtonText: "No, cancel plx!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            remove_assessment(id)
                            swal("Deleted!", "Assessor has been removed from assessment list.", "success");
                        } else {

                            swal("Cancelled", "", "error");
                            return ;
                        }
                        sweetAlert
                    }
                );

            });

        });



    </script>

@endsection
@section('script')
    <script>
    </script>
@endsection