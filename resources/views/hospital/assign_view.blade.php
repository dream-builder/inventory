@extends('index')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <h3>Assign Assessor</h3>
            </div>

        </div>


        <div class="row" style="margin-top: 15px;">

            <!-- selection area -->
            <div class="col-md-12">

                <div class="box box-warning">
                    <div class="box-header">
                        <h3 class="box-title">Assignment</h3>
                    </div>
                    <div class="box-body">

                        <!-- Hospital -->
                        <div class="col-md-3">
                            <div class="form-group" id="">
                                <label for="facility">{{ __('forms.factory') }}</label>
                                <select class="form-control js-example-basic-single" id="facility">
                                    <option value="-1" selected="selected">Please select...</option>
                                    @if (isset($facility) && is_array($facility))
                                        @foreach ($facility as $f)
                                            <option value="{{ $f->facilityid }}">{{ $f->facility_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>


                        <!-- section -->
                        <div class="col-md-3">
                            <div class="form-group" id="">
                                <label for="section">Section</label>
                                <select class="form-control js-example-basic-single" id="section">
                                    <option value="-1" selected="selected">Please select...</option>

                                    @if (isset($section) && is_array($section))
                                        @foreach ($section as $f)
                                            <option value="{{ $f->id }}">{{ $f->assessment }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <!-- Assessor -->
                        <div class="col-md-3">
                            <div class="form-group" id="">
                                <label for="assessor">Assessor</label>
                                <select class="form-control js-example-basic-single" id="assessor">
                                    <option value="-1" selected="selected">Please select...</option>

                                    @if (isset($assessor) && is_array($assessor))
                                        @foreach ($assessor as $f)
                                            <option value="{{ $f->user_id }}">{{ $f->name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                    </div>

                    <div class="box-footer">
                        <button class="btn btn-primary" id="assingsection">Assign</button>
                    </div>
                </div>


                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Assignment List</h3>
                    </div>

                    <div class="box-body" id="assign-list">

                    </div>

                </div>

            </div>



        </div>

    </section>

    <script>
        function get_list() {
            $("#app-loader").show();
            $.ajax({
                type: "GET",
                url: site_url + "/assign_list",
                // data: data,
                cache: false,
                success: function(data) {
                    // console.log(data);

                    $("#assign-list").html(data);
                    $("#app-loader").hide();
                }
            });
        }

        function resigter_assignment() {
            $("#app-loader").show();

            var facility = $("#facility").val();
            var section = $("#section").val();
            var assessor = $("#assessor").val();

            var data = {
                "facility": facility,
                "section": section,
                "assessor": assessor
            };

            $.ajax({
                type: "GET",
                url: site_url + "/register_assignment",
                data: data,
                cache: false,
                success: function(return_data) {

                    if (return_data == 'Already assigned') {
                        swal({
                                title: "Already assigned",
                                text: "This assessment is already assign to other assessor. Do you want to assign it again?",
                                type: "warning",
                                showCancelButton: true,
                                confirmButtonColor: "#DD6B55",
                                confirmButtonText: "Yes, Assign again",
                                cancelButtonText: "No",
                                closeOnConfirm: true,
                                closeOnCancel: true
                            },
                            function(isConfirm) {
                                if (isConfirm) {
                                    //Duplicate entry
                                    data.duplicate = true;

                                    $.ajax({
                                        type: "GET",
                                        url: site_url + "/register_assignment",
                                        data: data,
                                        cache: false,
                                        success: function(data) {
                                            $("#assign-list").html(data);
                                            swal("Assignment", "Successfully added.",
                                            "success");
                                        }
                                    });


                                } else {
                                    swal("Cancelled", "", "error");
                                    return;
                                }
                                sweetAlert
                            }
                        );
                    } else {
                        swal("Assignment", "Successfully added.", "success");
                        $("#assign-list").html(return_data);
                    }

                    $("#app-loader").hide();
                }
            });
        }

        function remove_assessment(id) {
            data = {
                "id": id
            };

            $.ajax({
                type: "GET",
                url: site_url + "/remove_assignment",
                data: data,
                cache: false,
                success: function(data) {
                    $("#assign-list").html(data);
                    $("#app-loader").hide();
                }
            });
        }


        $(document).ready(function() {
            get_list();

            $('.js-example-basic-single').select2();

            $("#assingsection").click(function() {

                var facilityid = $("#facility").val();
                var section = $("#section").val();
                var assessor = $("#assessor").val();

                if (facilityid == -1 || section == -1 || assessor == -1) {

                    sweetAlert('Please select Facility, Section and Assessor');
                    return;
                }

                resigter_assignment();
            });


            $(document).on('click', '.assign_id', function() {

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
                            swal("Deleted!", "Assessor has been removed from assessment list.",
                                "success");
                        } else {

                            swal("Cancelled", "", "error");
                            return;
                        }
                        sweetAlert
                    }
                );

            });

        });
    </script>

@endsection
@section('script')
    <script></script>
@endsection
