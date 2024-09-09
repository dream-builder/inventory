<table class="table table-hover" id="gfc">
    <tr>
        <th>Serial</th>
        <th>Question</th>
        <th>Answers/Options</th>
        <th>Action</th>
    </tr>

    <tbody>
        @if (isset($questions) && is_array($questions))

            @foreach ($questions as $q)
                <?php $qjosn = json_decode($q->question); ?>
                <tr class="ui-sortable-handle" data-qid="{{ $qjosn->qid }}">
                    <td> {{ $qjosn->serial }}</td>
                    <td contenteditable="false" class="edit-content">
                        {{ $qjosn->question }} </td>
                    <td>
                        @if (is_array($qjosn->options))
                            @foreach ($qjosn->options as $option)
                                <input type="radio" name="r{{ $qjosn->qid }}" disabled /> {{ $option }}
                                &nbsp;&nbsp;&nbsp;
                            @endforeach
                        @endif
                    </td>
                    <td>

                        <i class="fa fa-pencil edit-q text-primary" data-qid="{{ $qjosn->qid }}" style="cursor: pointer"
                            title="Edit"></i>
                        &nbsp;&nbsp;
                        <i class="fa fa-trash del-q text-danger" data-qid="{{ $qjosn->qid }}" style="cursor: pointer"
                            title="Remove"></i>



                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>

</table>

<script>
    function update_serial(update) {

        console.log(update);


        $.ajax({
            data: {
                'update': JSON.stringify(update)
            },
            type: "GET",
            url: site_url + "/question/update_serial",
            cache: false,
            success: function(data) {

            }
        });


    }

    $(document).ready(function() {

        $(".del-q").click(function() {

            qid = $(this).data('qid');


            swal({
                    title: "Delete.",
                    text: "Do you want to delete now? ",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes",
                    cancelButtonText: "Not now",
                    closeOnConfirm: false,
                    closeOnCancel: true
                },
                function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            data: {
                                'qid': qid
                            },
                            type: "GET",
                            url: site_url + "/question/delete_question",
                            cache: false,
                            success: function(data) {

                                load_question_by_section($("#que").val());

                            }
                        });
                        swal("Deleted!", "Deleted Successfully.",
                            "success");
                    } else {

                        swal("Cancelled", "", "error");
                        return;
                    }
                    sweetAlert
                }
            );



        });

        //Edit 
        $(".edit-q").click(function() {
            qid = $(this).data('qid');
            //console.log(qid);

            $.ajax({
                data: {
                    'qid': qid,
                    'action': 'edit'
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


        $(".edit-content").click(function() {
            $(this).attr('contenteditable', 'true').focus();
        });


        $("tbody").sortable({
            cursor: 'row-resize',
            placeholder: 'ui-state-highlight',
            opacity: '0.55',
            items: '.ui-sortable-handle',
            //update: function(event, ui) {

            start: function(G, ui) {
                ui.item.addClass("select");
            },
            stop: function(G, ui) {

                let specificRow = $('.select');
                ui.item.removeClass("select");

                //Re arrange the serial
                var update = [];
                $(this).find("tr").each(function(GFG) {
                    $(this).find("td").eq(0).html(GFG + 1);
                    $(this).attr('data-serial', GFG + 1);

                    update.push({
                        qid: $(this).data('qid'),
                        serial: GFG + 1,
                    });
                });


                //update serial in DB
                update_serial(update);


            }
        }).disableSelection();








    });
</script>
