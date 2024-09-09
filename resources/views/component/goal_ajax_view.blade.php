<table class="table table-hover" id="goal-table">

    <thead>
        <tr>
            <th>Facility ID</th>
            <th>Facility Name</th>
            <th>Zilla</th>
            <th>Issue</th>
            <th>Comment</th>
        </tr>
    </thead>

    @if( sizeof($data)>0 && is_array($data))

        <tbody>
            @foreach($data as $d)
                <tr>
                    <td>{{$d->facilityid}}</td>
                    <td>{{$d->facility_name}}</td>
                    <td>{{$d->zilla}}</td>

                    <td>{{$d->issues}}</td>
                    <td>{{$d->comment}}</td>
                </tr>
            @endforeach
        </tbody>
    @endif
</table>


<script>
    $(document).ready( function () {

        $('#goal-table').DataTable({

            dom: 'Blfrtip',
            responsive: true,
            pageLength: 25,
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
                { "searchable": true, "targets": [0] }  // Disable search on first and last columns
            ]
            //lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]

        });
    } );

</script>


