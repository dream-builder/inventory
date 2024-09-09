<!-- Reply -->
<div class="modal fade" id="modal-reply" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id=""><i class="fa fa-reply"></i> Reply</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <!-- form type="hidden" -->
                <form>
                    <input  type="hidden" id="reply_parent_id">
                    <input  type="hidden" id="reply_facility_id">

                    <div class="form-group">
                        <div class="form-control tags-input" id="issue-reply-txt" contenteditable="true" style="min-height: 80px; height: auto;"></div>
                    </div>



                </form>

                <div style="padding: 5px; border:solid 1px #DDD;"  id="attachments2"></div>
                <!-- /form -->

                <!-- file upload modal -->
                <form action="upload" method="POST" enctype="multipart/form-data" id="upload-file2">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file_to_upload2" id="file_to_upload2" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="reply-btn">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /reply -->

<script>
    var upload_files = '';

    $(document).ready(function (e) {


        $("#upload-file2").on('submit',(function(e) {
            e.preventDefault();

            // If file is not selected it will show an alert
            if ($("#file_to_upload2").val() == "")
            {
                sweetAlert("Please select a file to upload");
                $("#file_to_upload2").val("");
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
                        upload_files += obj.file + ',';

                        //Append items to list
                        $("#attachments2").append(attachment);


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

    $(document).on('click','.btn-remove-file',function (){

        var item = $(this).parent('.close-icon').parent('.attachment-item');
        var item_file_name = $(this).data('file');

        //remove file user file from server
        $.ajax({
            url: site_url + "/remove_user_file",
            type: "GET",
            data: "file=" + $(this).data('file'),
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $("#app-loader").show();
            },
            success: function (data) {
                item.remove();

                console.log(item_file_name);
                //Remove file name from upload file list
                upload_files= upload_files.replaceAll(item_file_name,'');

                console.log(upload_files);
                $("#app-loader").hide();
            }
        });

        //$("#issue-detail").focus();

    });
</script>