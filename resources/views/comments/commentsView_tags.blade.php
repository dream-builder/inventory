@extends('index')

@section('content')
	
    <section class="content-header">


    </section>
	<div id="tags">
		<ul>
		</ul>
	</div>
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
								<option value="10">Barisal [10]</option>
								<option value="20">Chittagong [20]</option>
								<option value="30">Dhaka [30]</option>
								<option value="40">Khulna [40]</option>
								<option value="70">Mymensingh [70]</option>
								<option value="50">Rajshahi [50]</option>
								<option value="55">Rangpur [55]</option>
								<option value="60">Sylhet [60]</option>
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
							<div class="col-md-12">
								<h4><i class="fa fa-building"></i> <span id="facility-name"></span></h4>
							</div>
							<div class="col-md-12">
{{--								Facility ID (Code): 5610171    Zilla: MANIKGANJ [56]    Upazila: DAULATPUR [10]   Union: BACHAMARA [17]--}}
								<!--<i class="fa fa-cubes"></i> <span id="facility-category"></span>-->
							</div>
						</div>
					</div>
				</div>
				<!-- //facility detail -->

				<div class="row" id="comment-panel" style="display: none">
					<div class="col-md-12" style="margin-bottom: 15px;"><button class="btn btn-danger" type="button" id="comments-to-add-btn"><span class="fa fa-plus"></span> Comment / Issue</button></div>
					<!-- Comment comumn -->
					<div class="col-md-12" id="comment-body"></div>
				</div>				
			</div>
			<!-- /mid comumn -->
			
		</div>

		@include('modals.create_issue_modal_view')
		@include('modals.status_change_modal')
		@include('modals.reply_edit')


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
								<!--textarea id="issue-detail-edit" class="form-control"></textarea -->
								<div id="issue-detail-edit" style="height: 250px; width: 100%;" class="form-control" contenteditable="true"></div>

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
		@include('modals.reply_modal')
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

		<!-- Edit modal will load here-->
		<div id="issue-edit-modal"></div>

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