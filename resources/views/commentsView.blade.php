@extends('index')

@section('content')
    <section class="content-header">


    </section>

    <section class="content">
		<div class="row">
			<div class="col-md-3">
			
			<!-- search section -->
				<div class="box box-warning">
					<div class="box-header with-border">
					  <h3 class="box-title">Search</h3>
					  <div class="pull-right" id="small-loader" style="display:none"><img src="{{asset('public/image/loading.gif')}}" width="32px" ></div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						
						<!-- Division -->
						<div class="form-group">
							<label for="div_dropdown">Division</label>
							<select class="form-control" id="div_dropdown">
								<option selected="selected"></option>
								<option value="10">Barisal</option>
								<option value="20">Chittagong</option>
								<option value="30">Dhaka</option>
								<option value="40">Khulna</option>
								<option value="70">Mymensingh</option>
								<option value="50">Rajshahi</option>
								<option value="55">Rangpur</option>
								<option value="60">Sylhet</option>
							</select>
						</div>

						<!-- District -->
						<div class="form-group" id="zilla_group" style="display:none">
							<label for="zilla_dropdown">Zilla</label>
							<select class="form-control" id="zilla_dropdown">
							</select>
						</div>

						<!-- Upazilla -->
						<div class="form-group" id="upazila_group" style="display:none">
							<label for="upazila_dropdown">Upazila</label>
							<select class="form-control" id="upazila_dropdown">
								
							</select>
						</div>

						<!--<button type="submit" class="btn btn-primary" id="get_comments">Search</button>-->
						
					
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
				<!-- search section -->

				<!-- Facility -->
				<div class="box box-success">
					<div class="box-body">
						<div class="form-group">
							<label for="zilla_dropdown">Facility </label>
							<select class="form-control" id="facility_dropdown">
							</select>
						</div>
					</div>
				</div>
			</div>
			
			<!-- mid comumn -->
			<div class="col-md-9">

				<!-- facility detail -->
				<div class="box box-success">

					<div class="box-body">
						<div class="row">
							<div class="col-md-6">
								<h4><i class="fa fa-bed"></i> <span id="facility-name"></span></h4>
							</div>
							<div class="col-md-6">
								<!--<i class="fa fa-cubes"></i> <span id="facility-category"></span>-->
							</div>
						</div>
					</div>
				</div>
				<!-- //facility detail -->

				<div class="row" id="comment-panel" style="display: none">
					<div class="col-md-12"><button class="btn btn-danger" type="button" id="comments-to-add-btn"><span class="fa fa-plus"></span> Comment / Issue</button></div>
					<!-- Comment comumn -->
					<div class="col-md-12" id="comment-body"></div>
				</div>				
			</div>
			<!-- /mid comumn -->
			
		</div>

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
							<!--<div class="form-group">
								<label for="" class="text-bold">Title</label>
								<input type="text" class="form-control" id="issue-title" placeholder="">
							</div>-->

							<div class="form-group">
								<label for="" class="text-bold">Category</label>
								<select class="form-control" id="issue-category">
									<option selected="selected" value="comment">Comment</option>
									<option value="issue">Issue</option>

								</select>
							</div>

							<div id="issue-period" style="display:none;">
								<div class="form-group">
									<label for="" class="text-bold">Issue Create Date (M-D-Y)</label>
									<input type="text" class="form-control" id="issue-create-date" placeholder="">
								</div>

								<div class="form-group">
									<label for="" class="text-bold">Issue Completion Date (M-D-Y)</label>
									<input type="email" class="form-control" id="issue-completion-date" placeholder="">
								</div>

								<div class="form-group">
									<label for="" class="text-bold">Assign To</label>
									<select class="form-control" id="assign-user">
									</select>

								</div>
							</div>

							<div class="form-group">
								<label for="" class="text-bold" style="display: block">Tag Others</label>
								<textarea class="form-control" id="tags"></textarea>
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
								<label for=""  class="text-bold">Description</label>
								<textarea class="form-control" id="issue-detail"></textarea>
							</div>



						</form>
						<!-- /form -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-danger btn-sm" id="create-issue">Create</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /issue Modal -->


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
									<option value="ongoing">Pending</option>
									<option value="postpone">Postpone</option>
									<option value="resolved">Resolved</option>
								</select>
							</div>

							<div class="form-group">
								<label for="issue-update-detail" class="text-bold">Details</label>
								<textarea id="issue-update-detail" class="form-control"></textarea>

							</div>





						</form>
						<!-- /form -->
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary btn-sm" id="change-status">Save</button>
					</div>
				</div>
			</div>
		</div>
		<!-- /issue status change Modal -->

		<!-- issue edit Modal -->
		<!-- Modal -->
		<div class="modal fade" id="modal-issue-edit" tabindex="-1" role="dialog" aria-labelledby="">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header bg-aqua">
						<div class="modal-title pull-left" id="">Issue Edit</div>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

					</div>
					<div class="modal-body">
						<!-- form type="hidden"-->
						<form>
							<input type="hidden" id="issue_id">
							<input  type="hidden" id="user_id">
							<input  type="hidden" id="facility_id">
							<div class="form-group">
								<label for="issue-detail-edit" class="text-bold">Issue Details</label>
								<textarea id="issue-detail-edit" class="form-control"></textarea>

							</div>



						</form>
						<!-- /form -->
					</div>


					<div class="modal-footer">
						<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary btn-sm" id="btn-issue-edit_details">Save</button>
					</div>
				</div>
			</div>
		</div>
		<!-- issue edit Modal -->

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
								<textarea id="reply-detail-edit" class="form-control"></textarea>

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
								<textarea id="issue-reply-txt" class="form-control"></textarea>
							</div>



						</form>
						<!-- /form -->
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

			$(document).ready(function(){

				$("#comments-to-add-btn").click(function(){
					$('#modal-issue').modal('show');
					$("#issue-create-date").datepicker().datepicker("setDate", new Date());

					var now = new Date();
					now.setDate(now.getDate()+7);
					$("#issue-completion-date").datepicker().datepicker("setDate", now);
				});





				$("#issue-category").change(function(){

					if($(this).val() == 'issue'){
						$("#issue-period").show('slow');
					}else{
						$("#issue-period").hide('slow');
					}

				});

				$("#create-issue").click(function(){


				});


			});
		</script>

		<script>
			var countries = new Bloodhound({
				datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
				queryTokenizer: Bloodhound.tokenizers.whitespace,
				prefetch: {
					url: 'public/js/countries.json',
					filter: function(list) {
						//console.log(list);
						return $.map(list, function(name) {
							return { name: name }; });
					}
				}
			});
			countries.initialize();

			$('#tags').tagsinput({
				typeaheadjs: {
					name: 'countries',
					displayKey: 'name',
					valueKey: 'name',
					source: countries.ttAdapter()
				}
			});
		</script>

    </section>
	
	<style>
		.facility_tr{
			cursor:pointer;
		}
	
	</style>
@endsection
@section('script')
    <script>


    </script>
@endsection