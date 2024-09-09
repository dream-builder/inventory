<!-- reply edit Modal -->
<!-- Modal -->
<div class="modal fade" id="modal-reply-comments-edit" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id="">Reply Edit</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <!-- form type="hidden"-->
                <form>
                    <input type="hidden" id="reply_issue_id">
                    <input type="hidden" id="reply_facility_id">
                    <div class="form-group">
                        <label for="reply-detail-edit" class="text-bold">Reply Details</label>
{{--                        <textarea id="reply-detail-edit" class="form-control"></textarea>--}}
                        <div class="form-control tags-input" id="reply-detail-edit" contenteditable="true" style="min-height: 80px; height: auto;"></div>
                        <input type="hidden" value="" id="parent-id">
                    </div>

                </form>
                <!-- /form -->

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-reply-comments-edit">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- reply edit Modal -->