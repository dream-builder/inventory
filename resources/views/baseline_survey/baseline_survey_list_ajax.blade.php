@if (isset($assignment) && sizeof($assignment) > 0)

    @if (is_array($assignment))
        <table class="table table-hover">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ __('forms.factory') }}</th>
                    <th>Question Set (Section)</th>
                    {{-- <th>Assessment Number</th> --}}
                    <th>Assessor</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($assignment as $ass)
                    <tr>
                        <td><i class="fa fa-trash text-red cursor-pointer assign_id" data-id="{{ $ass->id }}"
                                title="Delete"></i> </td>
                        <td>{{ $ass->facility_name }}</td>
                        <td>{{ $ass->assessment }}</td>
                        {{-- <td style="text-align: center">{{ $ass->survey_num }}</td> --}}
                        <td>{{ $ass->name }}</td>
                        <td>{{ ucfirst($ass->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif
