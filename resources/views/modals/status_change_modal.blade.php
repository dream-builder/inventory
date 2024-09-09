<!-- issue status change Modal -->
<!-- Modal -->
<div class="modal fade" id="modal-issue-status" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id="">Issue</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <!-- form -->
                <form>
                    <input  type="hidden" id="issue_id1" value="">
                    <input type="hidden"  id="facility_id1" value="">
                    <div class="form-group">
                        <label for="" class="text-bold">Status</label>
                        <select class="form-control" id="issue-status">
                            <option value="ongoing">Ongoing</option>
                            <option value="postpone">Postpone</option>
                            <option value="resolved">Resolved</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="issue-update-detail" class="text-bold">Details</label>
{{--                        <textarea id="issue-update-detail" class="form-control"></textarea>--}}
                        <div class="form-control tags-input" id="issue-update-detail" contenteditable="true" style="min-height: 80px; height: auto;"></div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-bold">Attachment</label>
                        <div style="padding: 5px; border:solid 1px #DDD;min-height: 100px;"  id="attachments1"></div>
                        <input type="hidden" name="attachment" id ="issue-edit-attachment" value="">
                    </div>

                </form>
                <!-- /form -->
                <!-- file upload modal -->
                <form action="upload" method="POST" enctype="multipart/form-data" id="upload-file3">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="row">
                        <div class="col-md-6">
                            <input type="file" name="file_to_upload" id="file_to_upload3" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <button type="button" class="btn btn-success"><span class="fa fa-upload"></span> Upload</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="change-status">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /issue status change Modal -->