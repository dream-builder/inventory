<style>
    .column_shade {
        /* background-color: #e7f4eb; */
    }
</style>
<table class="table table-hover table-striped" id="datatable1">
    <thead>
        <tr>
            <th>Action</th>
            {{-- <th>Factory ID</th> --}}
            <th>Factory Registration Number</th>
            <th>Factory Name</th>
            <th>Membership Organization</th>
            {{--        <th>Issue</th> --}}
            {{--        <th>Resolved</th> --}}
            {{--        <th>Ongoing</th> --}}
            {{--        <th>Postpone</th> --}}
            <th>District</th>
            <th>Address</th>
            {{-- <th>Contact</th> --}}

        </tr>
    </thead>
    <tbody>

        @foreach ($facilities as $facility)
            <tr data-facilityid="{{ $facility->facilityid }}" style="cursor: pointer" class="facilityrow">
                <td>
                    <i class="fa fa-trash text-danger xs del" data-fid="{{ $facility->facilityid }}"></i>
                    <i class="fa fa-pencil text-info xs"></i>
                    <a href="{{ env('APP_URL') }}organization/profile?id={{ $facility->facilityid }}"><i
                            class="fa fa-bank"></i></a>

                </td>
                {{-- <td>{{ $facility->facilityid }}</td> --}}
                <td class="column_shade">{{ $facility->facility_reg_no }}</td>
                <td>{{ $facility->facility_name }}</td>
                <td class="column_shade">{{ $facility->facility_owner }}</td>
                {{--            <td style="text-align: center">{{$facility->issues}}</td> --}}
                {{--            <td style="text-align: center">{{$facility->resolved}}</td> --}}
                {{--            <td style="text-align: center">{{$facility->ongoing}}</td> --}}
                {{--            <td style="text-align: center">{{$facility->postpone}}</td> --}}
                <td>{{ $facility->zilla_name }}</td>
                <td class="column_shade">{{ $facility->facility_address }}</td>
                {{-- <td>{{ $facility->facility_mobile }}</td> --}}
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function varify_facility(userid, facilityid) {
        var data = {
            "ajax": true,
            "user_id": userid,
            "facility_id": facilityid
        };

        $("#app-loader").show();
        $.ajax({
            url: site_url + "/verify_facility",
            type: "get",
            data: data,
            success: function(data) {
                //$("#all-user-list").empty().append(data);
                $("#app-loader").hide();
            }
        });
    }

    $(document).ready(function() {

        $('#datatable1').DataTable({

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

        $(document).on('click', '.facilityrow', function() {
            // alert($(this).data('facilityid')) ;
            //window.location.href = "facility/info?id=" + $(this).data('facilityid');
        });

        $(document).on('click', '.btn-verify', function() {

            userid = $(this).data('user_id');
            facility_id = $(this).data('facility_id');

            btn = $(this);

            swal({
                    title: "Verify",
                    text: "Is the facility information correct?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, It is correct",
                    cancelButtonText: "No, It is not correct.!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {

                        varify_facility(userid, facility_id);
                        //btn.html('Verified').addClass('btn-success').prop("disabled",true);
                        btn.replaceWith('<span class="btn btn-success btn-sm">Verified</span>');

                        swal("Verify", "Facility Information verified", "success");
                    } else {

                        swal("Cancelled", "", "error");
                        return;
                    }
                    sweetAlert
                }
            );
        });


        //delete facility
        $(document).on('click', ".del", function() {


            var data = {
                "ajax": true,
                "facility_id": $(this).data('fid')
            };


            swal({
                    title: "Are you sure?",
                    text: "Selected Factory will be removed. Any information related to this factory will not availabel in future. ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, remove it!",
                    cancelButtonText: "No, cancel plx!",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            url: site_url + "/facility/delete",
                            type: "get",
                            data: data,
                            success: function(data) {

                            }
                        });
                        swal("Deleted!", "Factory deleted Successfully.",
                            "success");
                    } else {

                        swal("Cancelled", "", "error");
                        return;
                    }
                    sweetAlert
                }
            );


        });


    });
</script>
