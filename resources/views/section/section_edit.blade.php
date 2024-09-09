<div class="modal fade" id="modal-edit-section" tabindex="-1" role="dialog" aria-labelledby="">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-aqua">
                <div class="modal-title pull-left" id="">Edit Section</div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <div class="fields-group">
                    <input type="hidden" value="{{ $edit_data->section_id }}" id="id-edit">
                    <div class="form-group row ">
                        <label for="section_name" class="control-label col-sm-2 inline-label">Section
                            Name</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                <input type="text" id="section_name-edit" name="section_name"
                                    value="{{ $edit_data->section_name }}" class="form-control"
                                    placeholder="Section Name" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="details" class="control-label col-sm-2 inline-label">Details</label>
                        <div class="col-sm-8">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                <input type="text" id="details-edit" name="details" value="{{ $edit_data->details }}"
                                    class="form-control" placeholder="Details" required autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="details" class="control-label col-sm-2 inline-label">Serial</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-arrows-v"></i></span>
                                <input type="number" min="1" id="serial-edit" name="serial"
                                    value="{{ $edit_data->serial }}">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-sm" id="update-section">Update</button>
            </div>
        </div>
    </div>
</div>
