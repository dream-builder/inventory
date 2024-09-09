@extends('index')

@section('content')

    <section class="content">
	
		<h3>Dashboard</h3>
	
		<div class="row">
			<!--region-->
			<div class="col-md-3">

				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Dhaka</h3>
						<div class="pull-right" id="small-loader" style="display:none"><img src="image/loading.gif" width="32px" ></div>
					</div>
					<!-- /.box-header -->

				</div>
				<!-- /.box -->


				<!-- issue -->

				<div class="info-box bg-yellow">

					<span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Issue</span>

						<div class="row">
							<div class="col-md-6">

								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> {{$data['issue']}}</span>
							</div>

							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> {{$data['issue_resolved']}}</span>
							</div>
						</div>

						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
								<!--70% Increase in 30 Days -->
							  </span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->


				<!--/issue -->

				<!-- Comment -->

				<div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-commenting"></i></span>

					<div class="info-box-content">
						<span class="info-box-text">Comment</span>

						<div class="row">
							<div class="col-md-6">

								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> {{$data['comment']}}</span>
							</div>

							<div class="col-md-6">
								<!--<span class="info-box-number"><i class="fa fa-check-circle-o"></i> 41</span>-->
							</div>
						</div>

						<div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						</div>
						<span class="progress-description">
								<!--70% Increase in 30 Days -->
							  </span>
					</div>
					<!-- /.info-box-content -->
				</div>
				<!-- /.info-box -->


				<!--/Commment -->


			</div>
			<!--//region-->

			<!--region-->
			<div class="col-md-3">
				<!-- search section -->
				<div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Faridpur</h3>
					  <div class="pull-right" id="small-loader" style="display:none"><img src="image/loading.gif" width="32px" ></div>
					</div>
					<!-- /.box-header -->
					
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->

				<!-- issue -->
				
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Issue</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
        
				
				<!--/issue -->
				
				<!-- Comment -->
				
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-commenting"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Comment</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
        
				
				<!--/Commment -->
				
				
				
			</div>
			<!--//region-->


			
			<!--region-->
			<div class="col-md-3">
				<!-- search section -->
				<div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Cox's Bazar</h3>
					  <div class="pull-right" id="small-loader" style="display:none"><img src="image/loading.gif" width="32px" ></div>
					</div>
					<!-- /.box-header -->
					
				  </div>
				  <!-- /.box -->
				
				
				<!-- issue -->
				
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Issue</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
        
				
				<!--/issue -->
				
				<!-- Comment -->
				
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-commenting"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Comment</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
        
				
				<!--/Commment -->
				
				
			</div>
			<!--//region-->
			
			<!--region-->
			<div class="col-md-3">
				<!-- search section -->
				<div class="box box-info">
					<div class="box-header with-border">
					  <h3 class="box-title">Noakhali</h3>
					  <div class="pull-right" id="small-loader" style="display:none"><img src="image/loading.gif" width="32px" ></div>
					</div>
					<!-- /.box-header -->
					
				  </div>
				  <!-- /.box -->
				
				<!-- issue -->
				
					<div class="info-box bg-yellow">
						<span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Issue</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				<!--/issue -->

				<!-- Comment -->
				
					<div class="info-box bg-aqua">
						<span class="info-box-icon"><i class="fa fa-commenting"></i></span>

						<div class="info-box-content">
						  <span class="info-box-text">Comment</span>
						  
						  <div class="row">
							<div class="col-md-6">
								
								<span class="info-box-number"><i class="fa fa-hand-paper-o"></i> </span>
							</div>
							
							<div class="col-md-6">
								<span class="info-box-number"><i class="fa fa-check-circle-o"></i> </span>
							</div>
						  </div>

						  <div class="progress">
							<div class="progress-bar" style="width: 70%"></div>
						  </div>
							  <span class="progress-description">

							  </span>
						</div>
						<!-- /.info-box-content -->
					</div>
					<!-- /.info-box -->
				<!--/Commment -->
			</div>
			<!--//region-->
		</div>
		
		
		<!-- Last Login -->
		
		<div class="row">
		
			<div class="col-md-12">
			
				<div class="box box-success">
					<div class="box-header"><h4>Last Login Information</h4></div>
					
					<div class="box-body">

						<table class="table table-hover">
							
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Total Login</th>
								</tr>
							</thead>
							<tbody>
								@if(sizeof($data['last_login_info']))
									@foreach($data['last_login_info'] as $data)
									<tr>
										<td>{{$data->user_name}}</td>
										<td>{{$data->zilla}}</td>
										<td>{{$data->lastlogin}}</td>
									</tr>
									@endforeach
								@endif
							</tbody>
							
						</table>
						
					</div>
				
				
				</div>
			
			</div>
		
		</div>
		

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