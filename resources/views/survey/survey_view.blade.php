@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-sm-12">
                <div class="box box-danger">
                    <div class="box-header with-border">
                        <h3 class="box-title">General Information</h3>
                    </div>

                    <div class="box-body">
                        <div class="facility-info-group">
                            @if ($assignment != '')
                                <div class="col-md-12">
                                    <div class="text-muted">Assessment Set</div>
                                    <div class="h4">{{ $assignment[0]->assessment }}</div>
                                </div>
                                <div>
                                    <div class="col-md-3">
                                        <div class="text-muted">Factory</div>
                                        <div class="h4"></div>
                                    </div>



                                    <div class="col-md-2">
                                        <div class="text-muted">Assessor</div>
                                        <div class="h4">{{ $assignment[0]->name }}</div>
                                    </div>
                                </div>

                                <div>

                                    <div class="col-md-2">
                                        <div class="text-muted">Survey Start Date</div>
                                        <div class="h4">
                                            {{ date('d-m-Y', strtotime($assignment[0]->assessment_start_date)) }}</div>
                                    </div>
                                    {{--    
                                                                    {{var_dump($assignment)}} --}}

                                    <div class="col-md-2">
                                        <div class="text-muted">Survey Number</div>
                                        <div class="h4" style="text-align: center">{{ $assignment[0]->survey_num }}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="text-muted">Survey Status</div>
                                        <div class="h4">{{ ucfirst($assignment[0]->status) }}</div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

                <div class="box box-info">
                    <div class="box-header">
                        <h3 class="box-title">Note</h3>
                    </div>
                    <div class="box-body">{{ $asmnt_note }}</div>
                </div>
            </div>
        </div>
        {{--            Survey question --}}
        <div class="fields-group">
            <?php $i = 0; ?>
            @foreach ($sections as $section)
                <div class="row ">
                    <div class="col-sm-12">
                        <div class="box box-default <?php if($i!=0){ ?> <?php }else{$i++;} ?>">
                            <div class="box-header panel-heading-section">
                                <h3 class="box-title">{{ $section->section_name }} @if ($section->details != '')
                                        [{{ $section->details }}]
                                    @endif
                                </h3>
                            </div>
                            <div class="box-body">
                                <style>
                                    .que-ans {
                                        padding: 5px 15px;
                                    }

                                    .question span,
                                    .answer span {
                                        font-weight: bold;
                                    }
                                </style>
                                @foreach ($section->questions as $question)
                                    <div class="que-ans">
                                        <div class="question"><span>Question:
                                            </span>&nbsp;&nbsp;{{ $question->question_text }}</div>
                                        <div class="{{ $question->question_id }}">
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
                                                    @elseif ($question->question_type == 'single')
                                                        @if (array_search($option->option_id, $answers))
                                                            <div class="answer"><span>Answer:
                                                                </span>{{ $option->option_text }}</div>
                                                        @endif
                                                    @else
                                                        <div class="col-md-4">
                                                            <div class="form-group row">
                                                                <div class="col-md-6">
                                                                    <label
                                                                        for="{{ $option->option_id }}">{{ $option->serial }}.&nbsp;{{ $option->option_text }}</label>
                                                                </div>
                                                                <div class="col-md-4 col-sm-2">
                                                                    <input type="number" min="0" max="5"
                                                                        class="form-control"
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
                                                                <input type="number" min="0" max="5"
                                                                    class="form-control"
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
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
@endsection
@section('script')
@endsection
