@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-danger box-mw">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Information</h3>
                    </div>

                    <div class="box-body">
                        <div class="facility-info-group">
                            @if ($assignment != '')
                                <div class="col-md-3">
                                    <div class="text-muted">Factory</div>
                                    <div class="h4">{{ $assignment[0]->facility_name }}</div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-muted">Assessment Set</div>
                                    <div class="h4">{{ $assignment[0]->assessment }}</div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-muted">Survey Number</div>
                                    <div class="h4">{{ $assignment[0]->survey_num }}</div>
                                </div>

                                <div class="col-md-3">
                                    <div class="text-muted">Assessor</div>
                                    <div class="h4">{{ $assignment[0]->name }}</div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
        {{--            Survey question --}}
        <form name="survey_form" method="GET" action="{{ url('/survey/save_survey') }}">

            <input type="hidden" name="facility_id" value="{{ $assignment[0]->facilityid }}">
            <input type="hidden" name="assessor_id" value="{{ $assignment[0]->user_id }}">
            <input type="hidden" name="assessment_id" value="{{ $_GET['asmnt'] }}">
            <input type="hidden" name="survey_num" value="{{ $_GET['survey_num'] }}">

            <div class="fields-group">
                <?php $i = 0; ?>
                @foreach ($sections as $section)
                    <div class="row ">
                        <div class="col-sm-12">
                            {{-- <div class="box box-default section-panel"> --}}
                            <div class="box box-info <?php if($i!=0){ ?>collapsed-box <?php }else{$i++;} ?>">
                                <div class="box-header panel-heading-section" style="background-color: #ddf8ff">

                                    <h3 class="box-title">{{ $section->section_name }} @if ($section->details != '')
                                            [{{ $section->details }}]
                                        @endif
                                    </h3>

                                    <div class="box-tools pull-right">
                                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                                class="fa  <?php if($i!=0){ ?> fa-plus <?php }else{$i++;} ?>"></i>
                                        </button>
                                    </div>

                                </div>
                                <div class="box-body">
                                    <div class="row">
                                        @foreach ($section->questions as $question)
                                            <div class="col-md-6">
                                                <div class="box box-default">
                                                    <div class="box-header box-question "
                                                        style="background-color: #F7F7F7;">

                                                        <h3 class="box-title">
                                                            {{ $loop->iteration }}.&nbsp;&nbsp;{{ $question->question_text }}
                                                        </h3>


                                                    </div>
                                                    <div class="box-body">
                                                        <div class="question-body {{ $question->question_id }}">
                                                            @foreach ($question->options as $option)
                                                                <div class=" ">
                                                                    @if ($question->question_type == 'multiple')
                                                                        <input type="checkbox"
                                                                            name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_{{ $option->option_id }}]"
                                                                            value="{{ $option->option_value }}"
                                                                            id="{{ $option->option_id }}"
                                                                            class="{{ $option->disabled_question_ids }}">
                                                                        <label class="control-label"
                                                                            for="{{ $option->option_id }}">&nbsp;{{ $option->option_text }}</label>
                                                                        <div class="form-check-inline"
                                                                            style="display: none">
                                                                            @foreach ($option->child_options as $child_option)
                                                                                <div
                                                                                    class="child-option-block form-check-inline">
                                                                                    {{ $option->child_option_type }}
                                                                                    @if ($option->child_option_type == 'multiple')
                                                                                        <input type="checkbox"
                                                                                            name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_{{ $child_option->option_id }}]"
                                                                                            id="{{ $child_option->option_id }}"
                                                                                            value="{{ $child_option->option_value }}"
                                                                                            class="{{ $child_option->disabled_question_ids }}">
                                                                                        <label class=""
                                                                                            for="{{ $child_option->option_id }}">&nbsp;{{ $child_option->option_text }}</label>
                                                                                    @else
                                                                                        <input type="radio"
                                                                                            name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_xx]"
                                                                                            id="{{ $child_option->option_id }}"
                                                                                            value="{{ $child_option->option_value }}"
                                                                                            class="{{ $child_option->disabled_question_ids }}">
                                                                                        <label class=""
                                                                                            for="{{ $child_option->option_id }}">&nbsp;&nbsp;{{ $child_option->option_text }}</label>
                                                                                    @endif
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    @elseif ($question->question_type == 'single')
                                                                        @if (array_search($option->option_id, $answers))
                                                                            <?php $checked = 'checked'; ?>
                                                                        @else
                                                                            <?php $checked = ''; ?>
                                                                        @endif

                                                                        <div class="form-group-option">
                                                                            <div class="radio">
                                                                                <label>
                                                                                    <input type="radio"
                                                                                        style="margin-top: -5px;"
                                                                                        {{ $checked }}
                                                                                        name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_x]"
                                                                                        id="{{ $option->option_id }}"
                                                                                        value="{{ $option->option_id }}">
                                                                                    {{ $option->disabled_question_ids }}
                                                                                    {{ $option->option_text }}</label>
                                                                            </div>
                                                                        </div>


                                                                        {{--                                                                    <div class="form-check-inline child-option child-option-border" style="display: none"> --}}
                                                                        {{--                                                                    @foreach ($option->child_options as $child_option) --}}
                                                                        {{--                                                                        <div class="child-option-block form-check-inline"> --}}
                                                                        {{--                                                                            @if ($option->child_option_type == 'multiple') --}}
                                                                        {{--                                                                                <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_option->option_id}}]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}"> --}}
                                                                        {{--                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;&nbsp;{{$child_option->option_text}}</label> --}}
                                                                        {{--                                                                            @elseif($option->child_option_type == 'single') --}}


                                                                        {{--                                                                                <input type="radio" name="feedback[{{$section->section_id}}_{{$question->question_id}}_xx]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}"> --}}
                                                                        {{--                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;&nbsp;{{$child_option->option_text}}</label> --}}
                                                                        {{--                                                                                <div class="form-check-inline child-option-border" style="display: none"> --}}
                                                                        {{--                                                                                    @foreach ($child_option->child_options as $child_of_child) --}}
                                                                        {{--                                                                                        <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_of_child->option_id}}]" id="{{$child_of_child->option_id}}" value="{{$child_of_child->option_id}}" class="{{$child_of_child->disabled_question_ids}}"> --}}
                                                                        {{--                                                                                        <label class="" for="{{$child_of_child->option_id}}">&nbsp;&nbsp;{!! $child_of_child->option_text!!}</label> --}}
                                                                        {{--                                                                                    @endforeach --}}
                                                                        {{--                                                                                </div> --}}
                                                                        {{--                                                                            @else --}}
                                                                        {{--                                                                                <div class="col-md-12"> --}}
                                                                        {{--                                                                                    <div class="form-group row"> --}}
                                                                        {{--                                                                                        <div class=""> --}}
                                                                        {{--                                                                                            <label class="" for="{{$child_option->option_id}}">{{$child_option->serial}}.&nbsp;{{$child_option->option_text}}</label> --}}
                                                                        {{--                                                                                        </div> --}}
                                                                        {{--                                                                                        <div class=""> --}}
                                                                        {{--                                                                                            <input type="number" min="0" max="5"  name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_option->option_id}}_value]" id="{{$child_option->option_id}}" value="" class="{{$child_option->disabled_question_ids}}"> --}}
                                                                        {{--                                                                                        </div> --}}
                                                                        {{--                                                                                    </div> --}}
                                                                        {{--                                                                                </div> --}}
                                                                        {{--                                                                            @endif --}}
                                                                        {{--                                                                        </div> --}}
                                                                        {{--                                                                    @endforeach --}}
                                                                        {{--                                                                </div> --}}
                                                                    @else
                                                                        <div class="col-md-4">
                                                                            <div class="form-group row">
                                                                                <div class="col-md-6">
                                                                                    <label
                                                                                        for="{{ $option->option_id }}">{{ $option->serial }}.&nbsp;{{ $option->option_text }}</label>
                                                                                </div>
                                                                                <div class="col-md-4 col-sm-2">
                                                                                    <input type="number" min="0"
                                                                                        max="5" class="form-control"
                                                                                        name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_x]"
                                                                                        id="{{ $option->option_id }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endforeach
                                                            <div class="option-block ">
                                                                @foreach ($question->extra_options as $extra_option)
                                                                    <div class="col-md-4">
                                                                        <div class="form-group row">
                                                                            <div class="col-md-6">
                                                                                <label
                                                                                    for="{{ $extra_option->option_id }}">{{ $extra_option->serial }}.&nbsp;{{ $extra_option->option_text }}</label>
                                                                            </div>
                                                                            <div class="col-md-4 col-sm-2">
                                                                                <input type="number" min="0"
                                                                                    max="5" class="form-control"
                                                                                    name="feedback[{{ $section->section_id }}_{{ $question->question_id }}_{{ $extra_option->option_id }}_value]"
                                                                                    id="{{ $extra_option->option_id }}"
                                                                                    value="{{ $extra_option->feedback_option_id }}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="form-group row">
                    <div class="col-md-12">
                        {{-- <button id="submit" type="button" class="btn btn-primary"> --}}
                        {{-- Submit --}}
                        {{-- </button> --}}

                        <div class="box box-primary">
                            <div class="box-header">
                                <div class="box-title">Note/Comment</div>
                            </div>
                            <div class="box-body">
                                <textarea class="form-control" name="note" rows="5" id="comment-note">{{ $asmnt_note }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="csr_token" value="e040cb79944b0c6e6da7862ea2266243" />
                        <button id="save-survey" type="button" class="btn btn-success"
                            data-surveyid="{{ $_GET['asmnt'] }}">Save</button>
                        <button id="submit-survey" type="button" class="btn btn-danger"
                            data-surveyid="{{ $_GET['asmnt'] }}">Submit</button>
                    </div>


                </div>
            </div>
        </form>
        {{--            End of Survey question --}}

        <script>
            function check_all_fields_checked() {
                var names = {};

                //get all individual radion name group
                $('input:radio').each(function() { // find unique names
                    names[$(this).attr('name')] = true;
                });


                //Check all name group are checked
                var count = 0;
                $.each(names, function() { // then count them
                    count++;
                });
                if ($('input:radio:checked').length == count) {
                    return true;
                } else {
                    return false;
                }

            }

            function check_any_fields_checked() {
                var names = {};

                //get all individual radion name group
                $('input:radio').each(function() { // find unique names
                    names[$(this).attr('name')] = true;
                });


                //Check all name group are checked
                var count = 0;
                $.each(names, function() { // then count them
                    count++;
                });
                if ($('input:radio:checked').length > 0) {
                    return true;
                } else {
                    return false;
                }

            }

            function save_survey() {
                $("#app-loader").show();
                $.ajax({
                    type: "GET",
                    url: site_url + "/survey/save_survey",
                    data: $("form").serialize(),
                    cache: false,
                    success: function(data) {

                        $("#app-loader").hide();
                        //console.log(data);
                    }
                });
            }
        </script>
        <script>
            $(document).ready(function() {

                //collaps panel
                $(".box-header").click(function() {

                    //$(this).parent().find('.box-body').show();
                    //$(this).closest('.box').show();

                });

                $("#save-survey").click(function() {

                    if (!check_any_fields_checked()) {
                        sweetAlert("PLease answer some questions before save.");
                        return false;
                    }

                    save_survey();
                });

                $("#submit-survey").click(function() {

                    if (!check_all_fields_checked()) {
                        sweetAlert("PLease answer all questions.");
                        return false;
                    }

                    var id = $(this).data('surveyid');

                    swal({
                            title: "Are you sure?",
                            text: "You want to submit survey?",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#0be236",
                            confirmButtonText: "Yes, submit",
                            cancelButtonText: "No, cancel",
                            closeOnConfirm: false,
                            closeOnCancel: true
                        },
                        function(isConfirm) {
                            if (isConfirm) {
                                $("#app-loader").show();
                                data = {

                                    "id": id
                                };

                                save_survey();

                                $.ajax({
                                    type: "GET",
                                    url: site_url + "/update_survey_status",
                                    data: data,
                                    cache: false,
                                    success: function(data) {
                                        $("#app-loader").hide();
                                        window.location.replace(site_url + "/dashboard");
                                    }
                                });


                                swal("Submitted!", "Assessment has been submitted successfully.",
                                    "success");
                            } else {

                                //swal("Cancelled", "", "error");
                                return;
                            }
                            // sweetAlert
                        }
                    );



                });


            });
        </script>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            {{--            // close all --}}
            {{--            $('.panel-heading span.clickable').parents('.panel').find('.panel-body').slideUp(); --}}
            {{--            $('.panel-heading .panel-title').addClass('panel-collapsed'); --}}
            {{--            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down'); --}}
            {{--            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus'); --}}

            {{--            //open first --}}
            {{--            $('.panel-heading span.clickable:first').parents('.panel').find('.panel-body').slideDown(); --}}
            {{--            $('.panel-heading .panel-title:first').removeClass('panel-collapsed'); --}}
            {{--            $('.panel-heading span.clickable:first').closest('.panel-heading').find('.btn-plus').removeClass('fa-plus').addClass('fa-minus'); --}}
            {{--            $('.panel-heading span.clickable:first').closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up'); --}}

            {{--            // tangle click --}}
            {{--            $('.panel-title').click(function (e) { --}}
            {{--                var $this = $(this); --}}
            {{--                if (!$this.hasClass('panel-collapsed')) { --}}
            {{--                    $this.closest('.panel').find('.panel-body').slideUp(); --}}
            {{--                    $this.addClass('panel-collapsed'); --}}
            {{--                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down'); --}}
            {{--                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus'); --}}
            {{--                } else { --}}
            {{--                    $this.closest('.panel').find('.panel-body').slideDown(); --}}
            {{--                    $this.removeClass('panel-collapsed'); --}}
            {{--                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-plus').addClass('fa-minus'); --}}
            {{--                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up'); --}}
            {{--                } --}}
            {{--            }); --}}
            {{--            // geo code --}}
            {{--            $("#zilla_id,#upazilla_id,#facility_id").select2({ --}}
            {{--                placeholder: "-- Select --", --}}
            {{--                allowClear: true --}}
            {{--            }); --}}
            {{--            $("#union_id").select2({ --}}
            {{--                placeholder: "Select Union", --}}
            {{--                allowClear: true --}}
            {{--            }); --}}
            {{--            //Load Zilla Data --}}
            {{--            $.ajax({ --}}
            {{--                url: "{{ route('/api/get_geo_code')}}", --}}
            {{--                cache: false, --}}
            {{--                success: function (result) { --}}
            {{--                    $('#zilla_id').select2({ --}}
            {{--                        data: JSON.parse(result), --}}
            {{--                        placeholder: "Select District", --}}
            {{--                        allowClear: true --}}
            {{--                    }).val("{{ old('zilla_id') }}").trigger('change'); --}}

            {{--                } --}}
            {{--            }); --}}
            {{--            //load Upazila data --}}
            {{--            $('#zilla_id').select2().on('change', function() { --}}
            {{--                $('#upazilla_id').find('option').remove(); --}}
            {{--                $('#union_id').find('option').remove(); --}}
            {{--                $('#facility_id').find('option').remove(); --}}
            {{--                var zilla = $('#zilla_id').val(); --}}
            {{--                if(zilla == null){ --}}
            {{--                    return ; --}}
            {{--                } --}}
            {{--                $.ajax({ --}}
            {{--                    url: "{{ route('/api/get_geo_code')}}?ZillaId="+zilla, --}}
            {{--                    cache: false, --}}
            {{--                    success: function (result) { --}}
            {{--                        $('#upazilla_id').select2({ --}}
            {{--                            data: JSON.parse(result), --}}
            {{--                            placeholder: "Select Upazila", --}}
            {{--                            allowClear: true --}}
            {{--                        }).val("{{ old('upazilla_id') }}").trigger('change'); --}}
            {{--                    } --}}
            {{--                }); --}}
            {{--            }); --}}
            {{--            //load Union data --}}
            {{--            $('#upazilla_id').select2().on('change', function() { --}}
            {{--                $('#union_id').find('option').remove(); --}}
            {{--                var zilla = $('#zilla_id').val(); --}}
            {{--                var upa_zilla = $('#upazilla_id').val(); --}}
            {{--                $('#facility_id').find('option').remove(); --}}
            {{--                if(zilla == null || upa_zilla == null){ --}}
            {{--                    return ; --}}
            {{--                } --}}
            {{--                $.ajax({ --}}
            {{--                    url: "{{ route('/api/get_geo_code')}}?ZillaId="+zilla+"&UpazilaId="+upa_zilla, --}}
            {{--                    cache: false, --}}
            {{--                    success: function (result) { --}}
            {{--                        $('#union_id').select2({ --}}
            {{--                            data: JSON.parse(result), --}}
            {{--                            placeholder: "Select Union", --}}
            {{--                            allowClear: true --}}
            {{--                        }).val("{{ old('union_id') }}").trigger('change'); --}}
            {{--                    } --}}
            {{--                }); --}}
            {{--            }); --}}
            {{--            //load Facility name --}}
            {{--            $('#union_id').select2().on('change', function() { --}}
            {{--                $('#facility_id').find('option').remove(); --}}
            {{--                var zilla = $('#zilla_id').val(); --}}
            {{--                var upa_zilla = $('#upazilla_id').val(); --}}
            {{--                var union_id = $('#union_id').val(); --}}
            {{--                if(zilla == null || upa_zilla == null|| union_id == null){ --}}
            {{--                    return ; --}}
            {{--                } --}}
            {{--                $.ajax({ --}}
            {{--                    url: "{{ route('/api/get_geo_code')}}?ZillaId="+zilla+"&UpazilaId="+upa_zilla+"&UnionId="+union_id, --}}
            {{--                    cache: false, --}}
            {{--                    success: function (result) { --}}
            {{--                        $('#facility_id').select2({ --}}
            {{--                            data: JSON.parse(result), --}}
            {{--                            placeholder: "Select Facility", --}}
            {{--                            allowClear: true --}}
            {{--                        }).trigger('change'); --}}
            {{--                    } --}}
            {{--                }); --}}
            {{--            }); --}}
            {{--            //child option show/hide --}}
            {{--            $('.option-block > input, .child-option-block > input').on('ifToggled', function(event){ --}}
            {{--                var ids = $(this).prop('class'); --}}
            {{--                if(ids != '' && ids.indexOf('[') != -1 ) { --}}
            {{--                    ids = JSON.parse(ids); --}}
            {{--                    for(var i=0;i<ids.length;i++){ --}}
            {{--                        $('.'+ids[i]).closest('div').closest('.survey-question').toggle('show'); --}}
            {{--                        if(ids[i].indexOf('XX') != -1){ --}}
            {{--                            $('#'+ids[i].split('XX')[1]).closest('div').closest('.option-block').toggle('show'); --}}
            {{--                        }else if(ids[i].indexOf('RR') != -1){ --}}
            {{--                            $('#'+ids[i].split('RR')[0]).val(ids[i].split('RR')[1]).prop('readonly', true);; --}}
            {{--                        }else if(ids[i].indexOf('FF') != -1){ --}}
            {{--                            $('#'+ids[i].split('FF')[0]).val("").prop('readonly', false); --}}
            {{--                        } --}}
            {{--                        $('.'+ids[i]).find('input').iCheck('uncheck'); --}}
            {{--                    } --}}
            {{--                } --}}
            {{--                $(this).on('ifUnchecked',function () { --}}
            {{--                    jQuery(this).closest('div').siblings('.form-check-inline').find('input').iCheck('uncheck'); --}}
            {{--                    jQuery(this).closest('div').siblings('.form-check-inline:has(input)').hide(); --}}
            {{--                }); --}}
            {{--                jQuery(this).closest('div').siblings('.form-check-inline:has(input)').show(); --}}


            {{-- //                $(this).on('ifUnchecked',function () { --}}
            {{-- //                    jQuery(this).closest('div').siblings('.form-check-inline').find('input').iCheck('uncheck'); --}}
            {{-- //                }); --}}
            {{-- //                jQuery(this).closest('div').siblings('.form-check-inline:has(input)').addClass('child-option-border'); --}}
            {{-- //                jQuery(this).closest('div').siblings('.form-check-inline:has(input)').toggle('show'); --}}
            {{--            }); --}}

            {{--            //checked previous result --}}
            {{--            $('#facility_id').on("change",function () { --}}
            {{--                $(':radio').iCheck('uncheck'); --}}
            {{--                $(':checkbox').iCheck('uncheck'); --}}
            {{--                var facility_id = $(this).val(); --}}
            {{--                if (facility_id != null) { --}}
            {{--                    $.ajax({ --}}
            {{--                        url: "{{ route('/api/get_latest_submission')}}?facility_id=" + facility_id, --}}
            {{--                        cache: false, --}}
            {{--                        async:false, --}}
            {{--                        success: function (result) { --}}
            {{--                            var zilla = $('#zilla_id option:selected').text(); --}}
            {{--                            var upazila = $('#upazilla_id option:selected').text(); --}}
            {{--                            var union = $('#union_id option:selected').text(); --}}
            {{--                            var facility = $('#facility_id option:selected').text(); --}}
            {{--                            $('.district-name').html(zilla); --}}
            {{--                            $('.upazila-name').html(upazila); --}}
            {{--                            $('.union-name').html(union); --}}
            {{--                            $('.facility-name').html(facility); --}}
            {{--                            $('#facility-info').show(); --}}
            {{--                            var latest_submission = result.replace(/&quot;/g, '"'); --}}
            {{--                            latest_submission = JSON.parse(latest_submission); --}}
            {{--                            latest_submission = latest_submission['data']; --}}
            {{--                            var score = 0; --}}
            {{--                            for (var i = 0; i < latest_submission.length; i++) { --}}
            {{--                                if (latest_submission[i]['feedback_option_id'] != '77777') { --}}
            {{--                                    score += latest_submission[i]['value']; --}}
            {{--                                    $('#' + latest_submission[i]['feedback_option_id']).iCheck('check'); --}}
            {{--                                    $('#' + latest_submission[i]['feedback_option_id']).val(latest_submission[i]['feedback_text']); --}}
            {{-- //                                    $('#' + latest_submission[i]['feedback_option_id']).closest('.option-block').find('.form-check-inline:has(input)').addClass('child-option-border'); --}}
            {{--                                    $('#' + latest_submission[i]['feedback_option_id']).closest('.form-check-inline').show(); --}}
            {{--                                } --}}
            {{--                            } --}}
            {{--                            $(':radio').attr('disabled', true); --}}
            {{--                            $(':checkbox').attr('disabled', true); --}}
            {{--                            $('input[type="number"]').prop('readonly', true); --}}
            {{--                            var cat = ''; --}}
            {{--                            $('.facility-score').html(score); --}}
            {{--                            if(score>200){ --}}
            {{--                                cat='A'; --}}
            {{--                            }else if(score<201 && score>100){ --}}
            {{--                                cat='B'; --}}
            {{--                            }else if(score<101){ --}}
            {{--                                cat='C'; --}}
            {{--                            } --}}
            {{--                            $('.facility-category').html(cat); --}}
            {{--                        } --}}
            {{--                    }); --}}
            {{--                } --}}
            {{--            }); --}}

            {{--            // back button --}}
            {{--            $('.form-history-back').on('click', function (event) { --}}
            {{--                event.preventDefault(); --}}
            {{--                history.back(1); --}}
            {{--            }); --}}
        });
    </script>
@endsection
