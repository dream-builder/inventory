@if (isset($assignment) && sizeof($assignment) > 0)

    @if (is_array($assignment))
        <table class="table table-hover" id="datatable2">
            <thead>
                <tr>
                    <th>Question Set (Section)</th>
                    <th>Assessor</th>
                    <th>Factory</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>Completion Date</th>

                </tr>
            </thead>

            <tbody>
                @foreach ($assignment as $ass)
                    <tr>
                        <td>{{ $ass->assessment }}</td>
                        <td>{{ $ass->name }}</td>
                        <td>{{ $ass->facility_name }}</td>
                        <td>
                            @if ($ass->status == 'active')
                                <label class="label label-info">{{ ucfirst($ass->status) }}</label>
                            @endif
                            @if ($ass->status == 'finished')
                                <label class="label label-success">{{ ucfirst($ass->status) }}</label>
                            @endif
                            @if ($ass->status == 'on-going')
                                <label class="label label-primary">{{ ucfirst($ass->status) }}</label>
                            @endif

                        </td>
                        <td>{{ $ass->assessment_start_date }}</td>
                        <td>{{ $ass->assessment_end_date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endif

<script>
    $(document).ready(function() {

        $('#datatable2').DataTable({

            dom: 'Blfrtip',
            responsive: true,
            pageLength: 10,
            buttons: [{
                    //className:'btn-info',
                    extend: 'copyHtml5',
                    text: '<i class="fa fa-files-o"></i>',
                    titleAttr: 'Copy'
                },
                {
                    //className:'btn-info',
                    extend: 'excelHtml5',
                    text: '<i class="fa fa-file-excel-o"></i>',
                    titleAttr: 'Excel'
                },
                {
                    // className:'btn-info',
                    extend: 'csvHtml5',
                    text: '<i class="fa fa-file-text-o"></i>',
                    titleAttr: 'CSV'
                },
                {
                    //className:'btn-info',
                    extend: 'pdfHtml5',
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    titleAttr: 'PDF'
                },
                //            {
                //                extend: 'print',
                //                text: 'Print current page',
                //                exportOptions: {
                //                    modifier: {
                //                        page: 'current'
                //                    }
                //                }
                //            }
                {
                    text: '<i class="fa fa-print"></i>',
                    extend: 'print',
                    className: 'btn-print',
                    titleAttr: 'Print',

                }


            ],
            "order": [],
            "columnDefs": [{
                    "searchable": false,
                    "targets": [0]
                } // Disable search on first and last columns
            ]
            //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]

        });
    });
</script>
