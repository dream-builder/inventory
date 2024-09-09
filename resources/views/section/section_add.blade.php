@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Section Add</h3>

                    </div>

                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group row {{ $errors->has('section_name') ? ' has-error' : '' }}">
                                <label for="section_name" class="control-label col-sm-2 inline-label">Section
                                    Name</label>
                                <div class="col-sm-8">
                                    @if ($errors->has('section_name'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                            {{ $errors->first('section_name') }}
                                        </label><br />
                                    @endif
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="section_name" name="section_name"
                                            value="{{ old('section_name') }}" class="form-control"
                                            placeholder="Section Name" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="control-label col-sm-2 inline-label">Details</label>
                                <div class="col-sm-8">
                                    @if ($errors->has('details'))
                                        <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                            {{ $errors->first('details') }}
                                        </label><br />
                                    @endif
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                        <input type="text" id="details" name="details" value="{{ old('details') }}"
                                            class="form-control" placeholder="Details" required autofocus>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row {{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="control-label col-sm-2 inline-label">Serial</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                        <input type="number" min="1" id="serial" name="serial">

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-2"></div>
                                <div class="col-md-3">
                                    <button class="btn btn-primary" id="add-section-btn">
                                        Add Section
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <!-- Section list -->
        <div id="section-list"></div>
        <!-- /Section list -->

        <div id="modal"></div>

    </section>

    <script>
        function load_list() {
            $.ajax({
                type: "GET",
                url: site_url + "/section/list_all",
                cache: false,
                success: function(data) {
                    $("#section-list").html(data);

                }
            });
            $("#section-list").html("adsfklaslkdf");

        }

        $(document).ready(function() {

            $("#add-section-btn").click(function() {

                var data = {
                    "section_name": $("#section_name").val(),
                    "details": $("#details").val(),
                    "serial": $("#serial").val(),
                };

                console.log(data);

                token = "e040cb79944b0c6e6da7862ea2266243";

                $("#app-loader").show();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: site_url + "/section/add_section",
                    data: {
                        "data": JSON.stringify(data),
                        "token": token
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        sweetAlert("Section Added Successfully.", '', 'success');

                        load_list();

                        //Clear input fields
                        $("#section_name").val('');
                        $("#details").val('');
                        $("#serial").val('');

                        $("#app-loader").hide();
                    }
                });


                //load_list();
            });

            //Load Section list

            load_list();


            $(document).on('click', '.sec-del', function() {



                var data = {
                    "section_id": $(this).data('id')
                };

                swal({
                        title: "Are you sure?",
                        text: "You wan to delete section.",
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
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                                }
                            });

                            $.ajax({
                                type: "POST",
                                url: site_url + "/section/del",
                                data: {
                                    "data": JSON.stringify(data)
                                },
                                cache: false,
                                success: function(data) {
                                    //console.log(data);
                                    //sweetAlert("Section Added Successfully.", '', 'success');

                                    load_list();
                                    $("#app-loader").hide();
                                }
                            });
                            swal("Deleted!", "Section has been removed from  list.",
                                "success");
                        } else {

                            swal("Cancelled", "", "error");
                            return;
                        }
                        sweetAlert
                    }
                );

            });


            $(document).on('click', '.sec-edit', function() {

                var id = $(this).data('id');

                //load value for edit
                // $("#section_name").val($("#sec-name" + id).html());
                // $("#details").val($("#sec-details" + id).html());
                // $("#serial").val($("#sec-serial" + id).html());
                var data = {
                    "section_id": id
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: site_url + "/section/edit",
                    data: {
                        "data": JSON.stringify(data)
                    },
                    cache: false,
                    success: function(data) {

                        $("#modal").html(data);
                        $("#app-loader").hide();

                        $("#modal-edit-section").modal('show');
                    }
                });
            });


            $(document).on('click', '#update-section', function() {
                var data = {
                    "section_id": $("#id-edit").val(),
                    "section_name": $("#section_name-edit").val(),
                    "details": $("#details-edit").val(),
                    "serial": $("#serial-edit").val()
                };

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').attr('value')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: site_url + "/section/update",
                    data: {
                        "data": JSON.stringify(data)
                    },
                    cache: false,
                    success: function(data) {
                        $("#modal-edit-section").modal('hide');
                        load_list();
                        $("#app-loader").hide();

                    }
                });
            });
        });
    </script>
@endsection
