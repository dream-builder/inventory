<!-- issue edit Modal -->
<!-- Modal -->
<?php $issue = $issue[0];?>

<div class="modal fade" id="modal-edit-issue" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id="">Edit Issue</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">


                <!-- form -->
                <form>
                    <input type="hidden" id="issue-edit-user-id" value="{{$issue->user_id}}">
                    <input type="hidden" id="issue-edit-issue-id" value="{{$issue->id}}">
                    <input type="hidden" id="issue-edit-facility-id" value="{{$issue->facility_id}}">

                    <div class="form-group">
                        <div class="form-control" placeholder="" >{{$issue->title}}</div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-bold">Category</label>
                        <select class="form-control" id="issue-edit-category">

                            @if($issue->category=='issue')
                                <option value="issue" selected="selected">Issue</option>
                            @else
                                <option value="issue" >Issue</option>
                            @endif

                            @if($issue->category=='comment')
                                <option value="comment" selected="selected">Comment</option>
                                @else
                                    <option value="comment">Comment</option>
                                @endif
                        </select>
                    </div>

                    <div id="issue-period">
                        <div class="form-group">
                            <label for="" class="text-bold">Issue Create Date (M-D-Y)</label>
                            <input disabled type="text" class="form-control" id="issue-edit-create-date" placeholder="" value="{{$issue->create_date}}">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-bold">Issue Completion Date (M-D-Y)</label>
                            <input type="email" class="form-control" id="issue-edit-completion-date" placeholder="" value="{{$issue->completion_date}}">
                        </div>


                        <div class="form-group">
                            <label for="" class="text-bold">Assign To</label>
                            <select class="form-control" id="assign-edit-user">

                                    <?php
                                        foreach($users as $user){
                                            $selected = '';
                                            if($user->user_id == $issue->assign_to){
                                                $selected = 'selected="selected"';
                                            }
                                            else{
                                                $selected = '';
                                            }
                                        ?>

                                        <option value="{{$user->user_id}}" {{$selected}}>{{$user->name}}</option>
                                    <?php
                                        }
                                    ?>


                            </select>

                        </div>
                    </div>



                    <div class="form-group">
                        <label for="" class="text-bold">Priority</label>
                        <select class="form-control" id="issue-edit-priority">

                            @if($issue->priority == 'Normal')
                                <option selected="selected" value="Normal">Normal</option>
                            @else
                                <option value="Normal">Normal</option>
                            @endif

                            @if($issue->priority == 'Low')
                                <option selected="selected" value="Low">Low</option>
                            @else
                                <option value="Low">Low</option>
                            @endif

                            @if($issue->priority == 'High')
                                <option selected="selected" value="High">High</option>
                            @else
                                <option value="High">High</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-bold">Description</label>
                        {{--								<textarea class="form-control" id="issue-detail"></textarea>--}}
                        <div class="form-control tags-input" id="issue-edit-detail" contenteditable="true" style="min-height: 80px; height: auto;">{{$issue->details}}</div>


                    </div>

                    <div class="form-group">
                        <label for="" class="text-bold">Attachment</label>
                        <div style="padding: 5px; border:solid 1px #DDD;"  id="attachments1">
                            <?php

                                $attachments=explode(",",$issue->attachment) ;

                            ?>
                            <input type="hidden" name="attachment" id ="issue-edit-attachment" value="{{$issue->attachment}}">
                            @if(sizeof($attachments)>0)
                                @foreach($attachments as $att)
                                    @if($att!="")
                                            <div class="attachment-item">
                                                <img class="" src="http://localhost/activity_tracking_system/uploads/{{$att}}">
                                                <div class="close-icon">
                                                    <button class="btn btn-xs btn-danger btn-remove-file1" data-file="{{$att}}">
                                                        <span class="fa fa-remove"></span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endif
                                @endforeach
                            @endif
                        </div>
                    </div>



                </form>
                <!-- /form -->
                <!-- file upload modal -->
                <form action="upload" method="POST" enctype="multipart/form-data" id="upload-file1">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file_to_upload" id="file_to_upload1" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <button type="submit1" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-sm" id="update-issue-edit">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- /issue edit Modal -->

<script>
    $("#issue-edit-create-date").datepicker().datepicker("setDate", new Date($("#issue-edit-create-date").val()));
    $("#issue-edit-completion-date").datepicker().datepicker("setDate",new Date($("#issue-edit-completion-date").val()));

    //File upload
    var upload_files_edit = '{{$issue->attachment}}';

    console.log(upload_files_edit);
    $(document).ready(function (e) {


        $("#upload-file1").on('submit',(function(e) {
            e.preventDefault();

            // If file is not selected it will show an alert
            if ($("#file_to_upload1").val() == "")
            {
                sweetAlert("Please select a file to upload");

                return ;
            }

            //Uploading selected file
            $.ajax({
                url: site_url + "/upload",
                type: "POST",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                beforeSend : function()
                {
                    $("#app-loader").show();
                    //$("#preview").fadeOut();
                    //$("#err").fadeOut();
                },
                success: function(data)
                {

                    var obj = JSON.parse(data);

                    // IF file upload error
                    if(obj.status == 'error'){
                        sweetAlert(obj.msg);
                    }

                    //When upload success
                    if(obj.status == 'success'){
                        //Attachment item container
                        img = site_url+'/uploads/'+obj.file;

                        attachment ='<div class="attachment-item">' +
                            '<a href="'+img+'" target="_blank"><img class="" src="'+img+'"></a>'+
                            '<div class="close-icon">'+
                            '<button class="btn btn-xs btn-danger btn-remove-file" data-file="'+obj.file+'">'+
                            '<span class="fa fa-remove"></span>'+
                            '</button>'+
                            '</div>'+
                            ' </div>';

                        //Add file to global upload_files
                        upload_files_edit += obj.file + ',';
                        $("#issue-edit-attachment").val(upload_files_edit);

                        //Append items to list
                        $("#attachments1").append(attachment);


                    }

                    console.log(obj.status);
                    console.log(upload_files);
                    $("#app-loader").hide();
                },
                error: function(e)
                {
                    sweetAlert(e);
                    $("#app-loader").hide();
                    // $("#err").html(e).fadeIn();
                }
            });
        }));
    });

    $(document).on('click','.btn-remove-file1',function (){

        var item = $(this).parent('.close-icon').parent('.attachment-item');
        var item_file_name = $(this).data('file');
        item.remove();
       // Remove file name from upload file list
        upload_files_edit= upload_files_edit.replaceAll(item_file_name,'');

        $("#issue-edit-attachment").val(upload_files_edit);

        console.log(upload_files_edit);
        //remove file user file from server
        // $.ajax({
        //     url: site_url + "/remove_user_file",
        //     type: "GET",
        //     data: "file=" + $(this).data('file'),
        //     contentType: false,
        //     cache: false,
        //     processData: false,
        //     beforeSend: function () {
        //         $("#app-loader").show();
        //     },
        //     success: function (data) {
        //         item.remove();
        //
        //         console.log(item_file_name);
        //         //Remove file name from upload file list
        //         upload_files= upload_files.replaceAll(item_file_name,'');
        //
        //         console.log(upload_files);
        //         $("#app-loader").hide();
        //     }
        // });

        //$("#issue-detail").focus();

    });
</script>
