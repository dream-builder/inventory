@extends('index')

@section('content')
    <section class="content-header">
	

    </section>

    <div class="content">
    <div class="row">
		<div class="col-md-9"><h3>HATI PARA UH&FWC</h3></div>
		<div class="col-md-3">
			<button class="btn btn-small btn-danger pull-right" id="new-issue" title="Create Issue"><i class="fa fa-plus"></i></button> 
			<a class="btn btn-small btn-info pull-right" href="issue" title="List of Issues" style="margin-right: 5px;"><i class="fa fa-list"></i></a>
		</div>
	
	</div>
	
	
	<div class="box box-default">
			
		<div class="box-body">
			
			<div class="row">
				<div class="col-md-2"><span class="fa fa-map"></span> Zilla: Dhaka</div>
				<div class="col-md-2"><span class="fa fa-map"></span> Upazila: Manikganj</div>
				<div class="col-md-2"><span class="fa fa-map"></span> Union: Manikganj Sadar</div>
				<div class="col-md-2"><span class="fa fa-map-marker"></span> Location: 90.039,23.748</div>
				<div class="col-md-2"><span class="fa fa-institution DGFP"></span> DGFP</div>
			</div>
		</div>
	
	</div>
	
	
	
		<style>
			.bg-violet{
				background-color:#4e2859;
				color:#FFF;
			}
		</style>
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Human Resource Status</h3>
			</div>
			
			<div class="box-body">
			
				<div class="row">
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>Medical Officer</p>
						</div>
						<div class="icon">
						  <i class="fa fa-user-md"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>FWV: Regular</p>
						</div>
						<div class="icon">
						  <i class="fa fa-user-md"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>SACMO</p>
						</div>
						<div class="icon">
						  <i class="fa fa-user-md"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>AYA</p>
						</div>
						<div class="icon">
						  <i class="fa fa-female"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>Night Guard/MLSS</p>
						</div>
						<div class="icon">
						  <i class="fa fa-user"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					<div class="col-md-2">
						<!-- inner box -->
					  <div class="small-box bg-violet">
						<div class="inner">
						  <h3>2</h3>

						  <p>Night Guard/MLSS</p>
						</div>
						<div class="icon">
						  <i class="fa fa-user"></i>
						</div>
					  </div>
						<!--//inner box -->

					</div><!-- col-md-3 -->
					
					
					
					
					
				</div><!-- //row -->
			</div>
			
		</div> <!--/ box -->
		
		
		<div class="row widgetcard">
		
			<div class="col-md-3">

				<div class="info-box">
					<span class="info-box-icon bg-aqua"><i class="fa fa-home"></i></span>

					<div class="info-box-content">
					  <span class="info-box-text">FWV resides in Quarte</span>
					  <span class="info-box-number">NO</span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->
			</div>
			
			<div class="col-md-3">

					<div class="info-box">
						<span class="info-box-icon bg-blue"><i class="fa fa-home"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">SACMO resides in Quarter</span>
						  <span class="info-box-number">NO</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
			</div>
			
			<div class="col-md-3">

					<div class="info-box">
						<span class="info-box-icon bg-yellow"><i class="fa fa-hotel"></i></span>

						<div class="info-box-content">
							<span class="info-box-text">Normal Delivery <span class="pull-right badge bg-green">Yes</span></span>
							<span class="info-box-text">Delivery Conducted by<span class="pull-right badge bg-aqua">FWV</span></span>
							<span class="info-box-text">Delivery Reported in 2014 <span class="pull-right badge bg-blue">46</span></span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
			</div>
			
			
			<div class="col-md-3">

					<div class="info-box">
						<span class="info-box-icon bg-orange"><i class="fa fa-graduation-cap"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Midwifery training of FWV</span>
						  <span class="info-box-number">Yes</span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
			</div>
		
		</div>
		<!-- widget card -->
		
		
		
		<div class="row">
			<div class="col-md-4">
			  <!-- Widget: user widget style 1 -->
			  <div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua">
				
				<div class="widget-user-image">
					<img class="img-circle" src="http://localhost/Facility_Assessment/public/image/utility.gif">
				</div>
				
				  <h3 class="widget-user-username">General</h3>
				  <h5 class="widget-user-desc">&nbsp;</h5>
				</div>
				<div class="box-footer no-padding">
				  <table class="table">
							<tr>
								<td>Approach Road <span class="pull-right badge bg-red">Not Good</span></td>
							</tr>
							<tr>
								<td>Electricity Supply <span class="pull-right badge bg-warning">Not Available</span></td>
							</tr>
							<tr>
								<td>Water Supply <span class="pull-right badge bg-warning">Not Available</span></td>
							</tr>
							<tr>
								<td>Date of Last Repair <span class="pull-right badge bg-aqua">2015</span></td>
							</tr>
						</table>
				</div>
			  </div>
			  <!-- /.widget-user -->
			</div><!-- col md 4 -->
			
			<div class="col-md-4">
			  <!-- Widget: user widget style 1 -->
			  <div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->

				<div class="widget-user-header bg-aqua">
				<div class="widget-user-image">
					<img class="img-circle" src="http://localhost/Facility_Assessment/public/image/facility.png">
					
				</div>
				  <h3 class="widget-user-username">Delivery Facilities</h3>
				  <h5 class="widget-user-desc">&nbsp;</h5>
				</div>
				<div class="box-footer no-padding">
				  <table class="table">
							<tr>
								<td>IUD/Delivery Room <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
							<tr>
								<td>Recovery Room <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
							<tr>
								<td>FWV Room <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
							<tr>
								<td>SACMO Room <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
							<tr>
								<td>Toilet 1 <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
							<tr>
								<td>Toilet 2 <span class="pull-right badge bg-green">No repair required</span></td>
							</tr>
						</table>
				</div>
			  </div>
			  <!-- /.widget-user -->
			</div><!-- col md 4 -->
			
			
			<div class="col-md-4">
			  <!-- Widget: user widget style 1 -->
			  <div class="box box-widget widget-user-2">
				<!-- Add the bg color to the header using any of the bg-* classes -->
				<div class="widget-user-header bg-aqua">
				<div class="widget-user-image">
					<img class="img-circle" src="http://localhost/Facility_Assessment/public/image/residence.png">
					
				</div>
				  <h3 class="widget-user-username">Residence</h3>
				  <h5 class="widget-user-desc">&nbsp;</h5>
				</div>
				<div class="box-footer no-padding">
				  <table class="table">
							<tr>
								<td>FWV <span class="pull-right badge bg-orange">Repair required</span></td>
							</tr>
							<tr>
								<td>SACMO <span class="pull-right badge bg-orange">Repair required</span></td>
							</tr>
							
						</table>
				</div>
			  </div>
			  <!-- /.widget-user -->
			</div><!-- col md 4 -->
		
		</div><!-- //row infrastructure -->
		
		
		<div class="box box-info">
			<div class="box-header">
				<h3 class="box-title">Infrastructure</h3>
			</div>
			
			<div class="box-body">
				<div class="row">
				
					
				
				
					<div class="col-md-4">
						<div class="bg-orange text-center">General</div>
						
						
						
					</div><!-- col-md-4 -->
				
				</div>
			</div>
		</div><!--/box -->

    	
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
			  <div class="form-group">
				<label for="" class="text-bold">Title</label>
				<input type="text" class="form-control" id="issue-title" placeholder="">
			  </div>
			  
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
			  </div>
			  
			  <div class="form-group">
				<label for="" class="text-bold">Tag Others</label>
				<input type="text" class="form-control" id="tags" placeholder="">
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
			<button type="button" class="btn btn-primary btn-sm" id="create-issue">Save</button>
		  </div>
		</div>
	  </div>
	</div>
	<!-- /issue Modal -->
		
		<script>
		
			$(document).ready(function(){
				
				$("#new-issue").click(function(){
					$('#modal-issue').modal('show')
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
				

				
				
			});
		</script>
	

@endsection
@section('script')
    <script>


    </script>
@endsection