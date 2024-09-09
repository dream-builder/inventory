var upload_files = '';

$(document).ready(function (e) {


        $("#upload-file").on('submit',(function(e) {
            e.preventDefault();

            // If file is not selected it will show an alert
            if ($("#file_to_upload").val() == "")
            {
                sweetAlert("Please select a file to upload");
                $("#file_to_upload").val("");
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
                        $("#attachments").append(attachment);


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

    $("#issue-detail").focus();

});