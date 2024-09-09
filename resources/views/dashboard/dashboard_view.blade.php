@extends('index')
@section('content')

    <section class="content-header" style="margin-bottom: 25px">
        <h1 style="display: inline-block">
            My Assignment
        </h1>
    </section>

    <section>
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header">
                    <div class="box-title">Assigned Survey</div>
                </div>
                <div class="box-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>{{ __('forms.factory') }}</th>
                                <th>{{ __('forms.section') }}</th>
                                <th>{{ __('forms.assessor') }}</th>
                                <th>Survey Number</th>
                                <th>{{ __('forms.survey_status') }}</th>
                                <th>{{ __('forms.action') }}</th>

                            </tr>
                        </thead>

                        @if (isset($survey_list) && is_array($survey_list))
                            <tbody>
                                @foreach ($survey_list as $survey)
                                    <tr>
                                        <td>{{ $survey->facility_name }}</td>
                                        <td>{{ $survey->assessment }}</td>
                                        <td>{{ $survey->name }}</td>
                                        <td style="text-align: center">{{ $survey->survey_num }}</td>
                                        <td>
                                            @if ($survey->status == 'active')
                                                <label class="label label-primary">{{ ucfirst($survey->status) }}</label>
                                            @endif
                                            @if ($survey->status == 'finished')
                                                <label class="label label-success">{{ ucfirst($survey->status) }}</label>
                                            @endif
                                            @if ($survey->status == 'on-going')
                                                <label class="label label-warning">{{ ucfirst($survey->status) }}</label>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($survey->status != 'finished')
                                                <a href="{{ url('/survey?asmnt=') }}{{ $survey->id }}&survey_num={{ $survey->survey_num }}"
                                                    class="btn btn-sm btn-success">
                                                    Start survey
                                                </a>
                                            @endif

                                            <a href="{{ url('/survey?asmnt=') }}{{ $survey->id }}&survey_num={{ $survey->survey_num }}&d=show"
                                                class="btn btn-sm btn-primary">
                                                Show Survey
                                            </a>

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        @endif

                    </table>
                </div>
            </div>
        </div>

    </section>

@endsection
@section('script')
    <script></script>
@endsection
