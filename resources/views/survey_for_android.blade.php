@extends('index_android')
@section('content')
    <style>
        .modal-footer button {
            float:right!important;
            margin-left: 10px!important;
        }
    </style>
    <section class="content" style="margin-top:30px!important;">
        <div class="row" >
            <div class="col-sm-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <div class="box-tools">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                            </div>
                        </div>
                    </div>
                    <form class="form-horizontal" method="POST" action="{{url('/survey/submit')}}" >
                        {{ csrf_field() }}
                        <input type="hidden" name="facility_id" value="{{Auth::user()->facility_id}}"/>
                        <div class="box-body">
                            <div class="fields-group">
                                @foreach($sections as $section)
                                    <div class="row ">
                                        <div class="col-sm-12">
                                            <div class="panel panel-info section-panel">
                                                <div class="panel-heading panel-heading-section">
                                                    <h3 class="panel-title">
                                                        <span class="clickable"><i class="btn-plus fa fa-minus"></i></span>
                                                        {{$section->section_name}} &nbsp;&nbsp;({{$section->details}})
                                                    </h3>
                                                    <span class="pull-right clickable"><i class="btn-arrow fa fa-chevron-up"></i></span>
                                                </div>
                                                <div class="panel-body">
                                                    {{--<div class="form-group row">--}}
                                                        {{--<div class="col-sm-3 col-sm-offset-5">--}}
                                                            {{--<input class="toggle-ed" type="checkbox" >--}}
                                                            {{--<input class="toggle-ed" type="checkbox" data-toggle="toggle" data-on="Enabled">--}}
                                                        {{--</div>--}}
                                                    {{--</div>--}}
                                                    @foreach($section->questions as $question)
                                                        <div class="single-question row">
                                                            <div class="survey-question col-sm-10">
                                                                <div class="question-title">{{$section->section_code}}.{{$loop->iteration}}&nbsp;&nbsp;{{$question->question_text}}</div>
                                                                <div class="question-body {{$question->question_id}}">
                                                                    @foreach($question->options as $option)
                                                                        <div class="option-block ">
                                                                            @if($question->question_type == 'multiple')
                                                                                <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$option->option_id}}]" value="{{$option->option_id}}" id="{{$option->option_id}}" class="{{$option->disabled_question_ids}}">
                                                                                <label class="control-label" for="{{$option->option_id}}">&nbsp;{{$option->option_text}}</label>
                                                                                <div class="form-check-inline" style="display: none">
                                                                                    @foreach($option->child_options as $child_option)
                                                                                        <div class="child-option-block form-check-inline">
                                                                                            @if($option->child_option_type == 'multiple')
                                                                                                <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_option->option_id}}]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}">
                                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;{{$child_option->option_text}}</label>
                                                                                            @else
                                                                                                <input type="radio" name="feedback[{{$section->section_id}}_{{$question->question_id}}_xx]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}">
                                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;&nbsp;{{$child_option->option_text}}</label>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            @elseif ($question->question_type == 'single')
                                                                                <input type="radio" name="feedback[{{$section->section_id}}_{{$question->question_id}}_x]" id="{{$option->option_id}}" value="{{$option->option_id}}" class="{{$option->disabled_question_ids}}">
                                                                                <label class="control-label" for="{{$option->option_id}}">&nbsp;{{$option->option_text}}</label>
                                                                                <div class="form-check-inline child-option child-option-border" style="display: none">
                                                                                    @foreach($option->child_options as $child_option)
                                                                                        <div class="child-option-block form-check-inline">
                                                                                            @if($option->child_option_type == 'multiple')
                                                                                                <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_option->option_id}}]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}">
                                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;&nbsp;{{$child_option->option_text}}</label>
                                                                                            @elseif($option->child_option_type == 'single')
                                                                                                <input type="radio" name="feedback[{{$section->section_id}}_{{$question->question_id}}_xx]" id="{{$child_option->option_id}}" value="{{$child_option->option_id}}" class="{{$child_option->disabled_question_ids}}">
                                                                                                <label class="" for="{{$child_option->option_id}}">&nbsp;&nbsp;{{$child_option->option_text}}</label>
                                                                                                <div class="form-check-inline child-option-border" style="display: none">
                                                                                                    @foreach($child_option->child_options as $child_of_child)
                                                                                                        <input type="checkbox" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_of_child->option_id}}]" id="{{$child_of_child->option_id}}" value="{{$child_of_child->option_id}}" class="{{$child_of_child->disabled_question_ids}}">
                                                                                                        <label class="" for="{{$child_of_child->option_id}}">&nbsp;&nbsp;{!! $child_of_child->option_text!!}</label>
                                                                                                    @endforeach
                                                                                                </div>
                                                                                            @else
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group row">
                                                                                                        <div class="">
                                                                                                            <label class="" for="{{$child_option->option_id}}">{{$child_option->serial}}.&nbsp;{{$child_option->option_text}}</label>
                                                                                                        </div>
                                                                                                        <div class="">
                                                                                                            <input type="number" min="0" max="5"  name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$child_option->option_id}}_value]" id="text_{{$child_option->option_id}}" value="" class="{{$child_option->disabled_question_ids}}">
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            @endif
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                                @else
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-6">
                                                                                            <label for="{{$option->option_id}}">{{$option->serial}}.&nbsp;{{$option->option_text}}</label>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-2">
                                                                                            <input type="number" min="0" max="5"  class="form-control" name="feedback[{{$section->section_id}}_{{$question->question_id}}_x]" id="text_{{$option->option_id}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endif
                                                                        </div>
                                                                    @endforeach
                                                                        <div class="option-block ">
                                                                        @foreach($question->extra_options as $extra_option)
                                                                                <div class="col-md-3">
                                                                                    <div class="form-group row">
                                                                                        <div class="col-md-6">
                                                                                            <label for="{{$extra_option->option_id}}">{{$extra_option->serial}}.&nbsp;{{$extra_option->option_text}}</label>
                                                                                        </div>
                                                                                        <div class="col-md-4 col-sm-2">
                                                                                            <input type="number" min="0" max="5" class="form-control" name="feedback[{{$section->section_id}}_{{$question->question_id}}_{{$extra_option->option_id}}_value]" id="text_{{$extra_option->option_id}}" value="{{$extra_option->feedback_option_id}}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                        @endforeach
                                                                        </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="form-group row">
                                    <div class="col-sm-3 col-sm-offset-5">
                                        <button id="submit" type="button" class="btn btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div id="data" data-pos="{{$data}}"></div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            // close all
            $('.panel-heading span.clickable').parents('.panel').find('.panel-body').slideUp();
            $('.panel-heading .panel-title').addClass('panel-collapsed');
            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
            $('.panel-heading span.clickable').closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus');


            // tangle click
            $('.panel-title').click(function (e) {
                var $this = $(this);
                if (!$this.hasClass('panel-collapsed')) {
                    $this.closest('.panel').find('.panel-body').slideUp();
                    $this.addClass('panel-collapsed');
                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-up').addClass('fa-chevron-down');
                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-minus').addClass('fa-plus');
                } else {
                    $this.closest('.panel').find('.panel-body').slideDown();
                    $this.removeClass('panel-collapsed');
                    $this.closest('.panel-heading').find('.btn-plus').removeClass('fa-plus').addClass('fa-minus');
                    $this.closest('.panel-heading').find('.btn-arrow').removeClass('fa-chevron-down').addClass('fa-chevron-up');
                }
            });

            //active inactive

            //child option show/hide
            $('.option-block > input, .child-option-block > input').on('ifChanged', function(event){
                var ids = $(this).prop('class');
                    if(ids != '' && ids.indexOf('[') != -1 ) {
                        ids = JSON.parse(ids);
                        for(var i=0;i<ids.length;i++){
                            $('.'+ids[i]).closest('div').closest('.survey-question').toggle('show');
                            if(ids[i].indexOf('XX') != -1){
                                $('#'+ids[i].split('XX')[1]).closest('div').closest('.option-block').toggle('show');
                            }else if(ids[i].indexOf('RR') != -1){
                                //alert(ids[i].split('RR')[0]);
                                $('#text_'+ids[i].split('RR')[0]).val(ids[i].split('RR')[1]).prop('readonly', true);
                            }else if(ids[i].indexOf('FF') != -1){
                                $('#text_'+ids[i].split('FF')[0]).val("").prop('readonly', false);
                            }
                            $('.'+ids[i]).find('input').iCheck('uncheck');
                        }
                    }
                $(this).on('ifUnchecked',function () {
                    jQuery(this).closest('div').siblings('.form-check-inline').find('input').iCheck('uncheck');
                    jQuery(this).closest('div').siblings('.form-check-inline:has(input)').hide();
                });
                jQuery(this).closest('div').siblings('.form-check-inline:has(input)').show();
            });

            //checked previous result
            load_data($('#data').data("pos"));

            function load_data(result) {
                $(':radio').iCheck('uncheck');
                $(':checkbox').iCheck('uncheck');
                $('#facility-info').show();
                var latest_submission = result;
                latest_submission = latest_submission['data'];
                var score = 0;
                for (var i = 0; i < latest_submission.length; i++) {
                    if (latest_submission[i]['feedback_option_id'] != '77777') {
                        score += latest_submission[i]['value'];
                        //TODO UNCHECK
                        //console.log(latest_submission[i]['feedback_option_id']);
                        //$('input:checked').removeAttr('checked');
                        $('#' + latest_submission[i]['feedback_option_id']).iCheck('check');
                        $('#text_' + latest_submission[i]['feedback_option_id']).val(latest_submission[i]['feedback_text']);
                        $('#' + latest_submission[i]['feedback_option_id']).closest('.option-block').find('.form-check-inline:has(input)').show();
                        $('#' + latest_submission[i]['feedback_option_id']).closest('.child-option-block').siblings().iCheck('uncheck');
                        $('#' + latest_submission[i]['feedback_option_id']).closest('.child-option-block').siblings().find('.form-check-inline').hide();
                    }else{

                    }
                }
            }
            //max min range
            $( "input[type='number']" ).change(function() {
                var max = parseInt($(this).attr('max'));
                var min = parseInt($(this).attr('min'));
                if ($(this).val() > max)
                {
                    $(this).val(max);
                }
                else if ($(this).val() < min)
                {
                    $(this).val(min);
                }
            });

//
        $('#submit').on("click",function () {
            bootbox.confirm({
                size: "small",
                message: "দয়া করে সংগৃহীত তথ্য যাচাই করুন, নিশ্চিত করে CONFIRM চাপুন",
                buttons: {
                    confirm: {
                        label: 'Confirm',
                        className: 'btn-success'
                    },
                    cancel: {
                        label: 'Cancel',
                        className: 'btn-danger'
                    }
                },
                callback: function(result){
                    if(result){
                        submit();
                    }
                }
            })
        });


            //submit form
            function submit() {
                var data = {};
                var formData = $('form').serializeObject();
                data['_token'] = $("[name='_token']").val();
                data['data'] = formData;
                console.log("data");
                console.log(formData);
                $('.data-str').val(formData);
                $.ajax({
                    url: '{{url('survey/submit')}}',
                    type: 'post',
                    dataType: 'json',
                    data: data,
                    success: function(result) {
                        if(result.outcome == 'success'){
                            swal("Saved !!", result.msg, "success");
                            load_data(result.data)
//                            location.reload();
                        }else{
                            swal("Error "+result.status, result.statusText, "warning");
                        }
                    },
                    error:function (result) {
                        if(result.outcome == 'success'){
                            swal("Saved !!", result.msg, "success");
                            location.reload();
                        }else{
                            swal("Error "+result.status, result.statusText, "warning");
                        }
                    }
                });
            };

        });
    </script>
@endsection