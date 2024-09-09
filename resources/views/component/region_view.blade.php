<!--region-->

        <table class="table table-hover" id="datatable2">
            <thead>
            <tr>
                <th>#</th>
                <th>Ref. No.</th>
                <th>Issue Date</th>
                <th>Due Date</th>
                <th>Naratives</th>
                <th>Facility</th>
                <th>Zilla</th>
                <th>Upazila</th>
                <th>Unioin</th>
                <th>Assign</th>
                <th>Creator</th>

                <th>status</th>

            </tr>
            </thead>

            <tbody>

            @if(sizeof($data)>0)
                <?php $i=1;?>
                @foreach($data as $issue)

                    <tr class='clickable-row' style="cursor: pointer" data-href="{{url('/issueDetails/id=')}}{{$issue->id}}">
                        <td>{{$i++}}</td>
                        <td>{{$issue->id}}</td>
                        <td>{{$issue->create_date}}</td>
                        <td>{{$issue->due_date}}</td>

                        @if($issue->title != 'Title')
                            <td data-toggle="tooltip" data-placement="bottom" title="{{$issue->details}}">{{$issue->title}}</td>
                        @else
                            <td>{{$issue->details}}</td>
                        @endif
                        <td>{{$issue->facility_name}}</td>
                        <td>{{$issue->zilla_name}}</td>
                        <td>{{$issue->upazila_name}}</td>
                        <td>{{$issue->union_name}}</td>
                        <td>{{$issue->assign_to}}</td>
                        <td>{{$issue->creator}}</td>
                        <td>
                            @if($issue->category !== 'comment')
                                @if($issue->status == 'ongoing')
                                    <span class="label label-warning" style="font-weight: normal">Ongoing</span>
                                @elseif($issue->status == 'resolved')
                                    <span class="label label-success" style="font-weight: normal">Resolved</span>
                                @elseif($issue->status == 'postpone')
                                    <span class="label label-danger" style="font-weight: normal">Postpone</span>
                                @else
                                    <span class="label" style="font-weight: normal">{{$issue->status}}</span>
                                @endif
                            @endif

                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>

        </table>

<!--//region-->
<script>
$(document).ready( function () {

    $('#datatable2').DataTable({

    dom: 'Blfrtip',
    responsive: true,
    pageLength: 10,
    buttons: [
    {
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
    "columnDefs": [
    { "searchable": false, "targets": [0] }  // Disable search on first and last columns
    ]
    //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]

    });
} );

</script>