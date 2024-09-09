<style>
    .attachment-item{
        position: relative;
        overflow: auto;
        height: auto;
        width: 100px;
        display: inline-block;
    }

    .attachment-item img{
        width: 100px;
    }

    .attachment-item .close-icon{
        position: absolute;
        top: 0px;
        right: 10px;
    }

</style>
<!-- issue Modal -->
<!-- Modal -->
<div class="modal fade" id="modal-issue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id="">Create New Issue</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <!-- form -->
                <form>

                    <div style="border-bottom: solid 1px #BF9E9E;margin-bottom: 20px;">
                        <div class="">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="no_issue" id="no-issue" value="1"> <span style="font-weight: bold; display: inline-block; padding-top: 9px; color: red">This facility has no issue</span>
                                </label>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="" class="text-bold">Title <sup class="text-warning">*</sup></label>
                        <input type="text" class="form-control" id="issue-title" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="issue-visit-reason" class="text-bold">Reason of Visit</label>
                        <input type="text" class="form-control" id="issue-visit-reason" placeholder="Reason of Visit" >
{{--                        <select class="form-control" id="issue-visit-reason">--}}
{{--                            <option value="" selected="selected"></option>--}}
{{--                        </select>--}}
                    </div>

                    <div class="form-group">
                        <label for="" class="text-bold">Category</label>
                        <select class="form-control" id="issue-category">

                            <option value="issue" selected="selected">Issue</option>
                            <option value="comment">Comment</option>

                        </select>
                    </div>

                    <div id="issue-period">
                        <div class="form-group">
                            <label for="" class="text-bold">Issue Create Date (M-D-Y)</label>
                            <input type="text" class="form-control" id="issue-create-date" placeholder="" disabled >
                        </div>

                        <div class="form-group">
                            <label for="" class="text-bold">Issue Completion Date (M-D-Y)</label>
                            <input type="email" class="form-control" id="issue-completion-date" placeholder="">
                        </div>

                        <div class="form-group">
                            <label for="" class="text-bold">Assign To</label>
                            <select class="form-control select2" id="assign-user">
                            </select>
                        </div>

{{--                        <div class="">--}}
{{--                            <label for="" class="text-bold">Email receivers</label>--}}

{{--                        </div>--}}

                    </div>

                    <div class="form-group">
                        <label for="" class="text-bold">Priority</label>
                        <select class="form-control" id="issue-priority">
                            <option selected="selected">Normal</option>
                            <option>Low</option>
                            <option>High</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-bold">Description</label>
                        {{--								<textarea class="form-control" id="issue-detail"></textarea>--}}
                        <div class="form-control tags-input" id="issue-detail" contenteditable="true" style="height: 80px;"></div>
                    </div>
                    <div class="form-group">
                        <label for="" class="text-bold">Attachment</label>
                        <div style="padding: 5px; border:solid 1px #DDD;"  id="attachments">
{{--                            <div class="attachment-item">--}}
{{--                                <img class="" src="http://localhost/activity_tracking_system/uploads/260000_20210708032729.jpg">--}}
{{--                                <div class="close-icon">--}}
{{--                                    <button class="btn btn-xs btn-danger btn-remove-file" data-file="260000_20210708032729.jpg">--}}
{{--                                        <span class="fa fa-remove"></span>--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                </form>
                <!-- /form -->

                <!-- file upload modal -->
                <form action="upload" method="POST" enctype="multipart/form-data" id="upload-file">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file_to_upload" id="file_to_upload" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger btn-sm" id="create-issue">Create</button>
            </div>
        </div>
    </div>
</div>
<!-- /issue Modal -->

<script>
    $(document).ready(function() {

        $("#comments-to-add-btn").click(function (){
            $("#no-issue").prop('checked',false);
            $("#issue-period").show();
            $("#issue-category").val("issue");
        });


        $('.select2').select2({
            width: '100%',
            dropdownParent: $("#modal-issue")
        });


        //chek if checbox is checked
        $(document).on('click',"#no-issue",function (){
            if ($(this).is(":checked")){
                hide_issue_inputs();

                $("#issue-period").hide('slow');
            }
            else{
                clean_issue_inputs();
                $("#issue-period").show('slow');
            }
        })

    });


    function hide_issue_inputs(){
        $("#issue-title").val("This facility has no Issue.");
        //$("#issue-title").attr('disabled');
        $("#issue-category").val("comment");
        //$("#issue-category").hide();

        $("#issue-detail").html("This facility has no Issue.");
       // $("#issue-detail").hide();

    }

    function clean_issue_inputs(){
        $("#issue-title").val("");
        $("#issue-title").show();
        $("#issue-detail").html("");
        $("#issue-detail").show("");

        $("#issue-category").val("issue");
        $("#issue-category").show();

    }
</script>