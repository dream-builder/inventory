<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add new question</h4>
        </div>
        <div class="modal-body">

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Section</label>
                    <input type="text" disabled class="form-control"
                        value="{{ @$_GET['section_text'] }}{{ @$data['question']->section_name }}" />
                    <input type="hidden" class="form-control" id="section-id"
                        value="{{ @$_GET['section_id'] }}{{ @$data['question']->section_id }}" />
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Question</label>
                    <input type="text" class="form-control" id="question" placeholder="New Question"
                        value="{{ @$_GET['question_text'] }}{{ @$data['question']->question_text }}">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Question Type</label>
                    <select class="form-control" id="q-type">
                        <option value="single">Single</option>
                    </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Question Serial</label>
                    <input type="number" class="form-control" id="q-serial"
                        value="{{ @$_GET['serial'] }}{{ @$data['question']->serial }}">
                </div>
            </div>

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="box-header with-border">
                            <h3 class="box-title">Answer/Options</h3>
                        </div>
                    </div>

                    <div class="box-body">

                        <table class="table">
                            <tr>
                                <th>Ans/Option</th>
                                <th>Point</th>
                                <th>Serial</th>
                            </tr>

                            <tr>
                                <th><input type="text" class="form-control" value="Yes" id="q-op-y"></th>
                                <th><input type="text" class="form-control" value="5" id="q-op-y-v"></th>
                                <th><input type="number" min="1" class="form-control" value="1"
                                        id="q-op-y-s"></th>
                            </tr>

                            <tr>
                                <th><input type="text" class="form-control" value="No" id="q-op-n"></th>
                                <th><input type="text" class="form-control" value="0" id="q-op-n-v"></th>
                                <th><input type="number" class="form-control" value="2" id="q-op-n-s"></th>
                            </tr>
                        </table>

                    </div>

                </div>
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="q-save-new">Save</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#q-save-new").click(function() {

            var data = {
                'action': 'new', //new = add new; edit = update existing;
                'section': $("#section-id").val(),
                'question': $("#question").val(),
                'type': $("#q-type").val(),
                'serial': $("#q-serial").val(),
                'options': {
                    'op1': {
                        'ans': $("#q-op-y").val(),
                        'point': $("#q-op-y-v").val(),
                        'serial': $("#q-op-y-s").val()
                    },
                    'op2': {
                        'ans': $("#q-op-n").val(),
                        'point': $("#q-op-n-v").val(),
                        'serial': $("#q-op-n-s").val()
                    }
                }

            };


            $.ajax({
                data: data,
                type: "GET",
                url: site_url + "/question/add_update_question",
                cache: false,
                success: function(data) {
                    if (data == 'success') {
                        sweetAlert("Question successfully saved.", '', 'success');
                        load_question_by_section($("#que").val());
                        $("#q-modal").modal('hide');
                    }
                }
            });

        });

    });
</script>
