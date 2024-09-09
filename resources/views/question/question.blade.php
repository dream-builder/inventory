@extends('index')
@section('content')

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Sections</h3>
                    </div>

                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group">

                                <select class="form-control" id="que">
                                    <option>Please select...</option>

                                    @if (isset($section) && is_array($section))
                                        @foreach ($section as $sec)
                                            <option value="{{ $sec->section_id }}">{{ $sec->section_name }}</option>
                                        @endforeach
                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="loader"></div>
                            {{-- <button class="btn btn-sm btn-info" id="btn-search-q">Search</button> --}}
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <!-- question list -->
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Question and Answers/Options</h3>
                <button class="btn btn-sm btn-primary pull-right" id="add-question"><i class="fa fa-plus"></i> Add new
                    Question</button>
            </div>

            <div class="box-body" id="question-list">
            </div>
        </div>
    </section>

    {{-- Modal --}}
    <div class="modal" id="q-modal">

    </div>

    <script>
        function load_question_by_section(qid) {

            $(".loader").show();
            $.ajax({
                data: {
                    'qid': qid
                },
                type: "GET",
                url: site_url + "/question/load_by_section",
                cache: false,
                success: function(data) {
                    $("#question-list").html(data);
                    $(".loader").hide();
                }
            });
        }


        $(document).ready(function() {

            $("#btn-search-q").click(function() {
                load_question_by_section($("#que").val());
            });

            $("#que").change(function() {
                load_question_by_section($("#que").val());
            })

            //New question
            $("#add-question").click(function() {

                $.ajax({
                    data: {
                        'qid': 0,
                        'section_id': $("#que").val(),
                        'section_text': $("#que :selected").text()
                    },
                    type: "GET",
                    url: site_url + "/question/add_edit",
                    cache: false,
                    success: function(data) {

                        $("#q-modal").html(data);
                        $("#q-modal").modal('show');

                    }
                });
            });


        });
    </script>
@endsection
