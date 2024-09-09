@extends('index')

@section('content')
    <section class="content-header">
    </section>

    <section class="content">



        <!-- Detail and list -->
        <div class="row">

            <!-- Search -->

            <div class="col-md-12">
                <div class="box box-warning">
                    <div class="box-header with-border">
                        <h3 class="box-title">Search </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <hr />
                        <div class="row">
                            @if (isset($custom_fileds) && is_array($custom_fileds))
                                @foreach ($custom_fileds as $field)
                                    <div class="col-sm-2"><input type="checkbox" value="{{ $field->column_name }}">
                                        {{ str_replace('_', ' ', ucfirst($field->column_name)) }}</div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                    <!-- /.box-body -->


                </div>
            </div>


            <!-- Issue detail -->
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">List of Factories</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="issue-detail-reply">
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

        @include('modals.create_issue_modal_view')
        @include('modals.reply_modal')
        @include('modals.status_change_modal')
        @include('modals.reply_edit')
    </section>

    <style>
        .facility_tr {
            cursor: pointer;
        }
    </style>

    <script>
        $(document).ready(function() {
            $("#get_facilities_by_geo").click(function() {

                var zilla = $("#zilla_dropdown").val();;
                var upazila = $("#upazila_dropdown").val();
                var union = null;

                //if zilla id <9 then add 0 prefix
                if ($("#zilla_dropdown").val() <= 9) {
                    zilla = "0" + $("#zilla_dropdown").val();
                }

                //if upzaila id <9 then add 0 prefix
                if ($("#zilla_dropdown").val() <= 9) {
                    zilla = "0" + $("#zilla_dropdown").val();
                }

                //console.log(zilla);

                $("#app-loader").show(); //show loader
                var data_post = {
                    'div': $("#div_dropdown").val(),
                    'zilla': zilla,
                    'upazila': upazila,
                    'facility_type': $("#facility_type_dropdown").val()
                };

                //console.log(data_post);
                $("#issue-detail-reply").html('');
                $.ajax({
                    type: "GET",
                    url: "report/facilities_ajax",
                    data: data_post,
                    cache: false,
                    success: function(data) {
                        $("#issue-detail-reply").html(data);

                        $("#app-loader").hide();
                    }
                });


            });


        });
    </script>
@endsection
@section('script')
    <script></script>
@endsection
