@extends('index')

@section('content')

    <section class="content">
	
		<div class="row">
			<div class="col-md-6"><h3>All {{ucfirst($_GET['type'])}}</h3></div>

		</div>
		
		
		<div class="row">
		
			<!--region-->
			<div class="col-md-12" >
				<!-- search section -->
				<div class="box box-warning" style="display: none">
					<div class="box-header with-border">
					  <h3 class="box-title">Search</h3>
					  <div class="pull-right" id="small-loader" style="display:none"><img src="{{ asset('public/image/loading.gif')}}" width="32px" ></div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<form role = "form">

							<div class="col-md-3">
								<!-- Division -->
								<div class="form-group" >
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
							</div>

							<div class="col-md-3">
								<!-- District -->
								<div class="form-group" id="zilla_group" style="display:none">
									<label for="zilla_dropdown">Zilla</label>
									<select class="form-control" id="zilla_dropdown">
									</select>
								</div>
							</div>

							<div class="col-md-3">
								<!-- Upazilla -->
								<div class="form-group" id="upazila_group" style="display:none">
									<label for="upazila_dropdown">Upazila</label>
									<select class="form-control" id="upazila_dropdown">

									</select>
								</div>
							</div>

						<button type="submit" class="btn btn-primary" id="get_comments">Search</button>

						</form>
					</div>
					<!-- /.box-body -->
				  </div>
				  <!-- /.box -->
				<!-- search section -->
	
			</div>
			<!--//region-->

	
			<div class="col-md-12">

				<div class="box box-success">
					<div class="box-header"></div>
					
					<div class="box-body">
						<table class="table table-hover datatable">
                        	<thead>
                            	<tr>
									<th>Issue Date</th>
									<th>Ref. No.</th>
                                	<th>{{ucfirst($_GET['type'])}}</th>
									<th>Facility</th>
									<th>Assign</th>
									<th>Creator</th>
									<th>ZIlla</th>
									<th>Upazila</th>
									<th>Union</th>

                                    <th>Status</th>
                                </tr>
                            </thead>
                            
                            <tbody>

							@if(sizeof($data['issues'])>0)
								@foreach($data['issues'] as $issue)

                            	<tr class='clickable-row' style="cursor: pointer" data-href="{{url('/issueDetails/id=')}}{{$issue->id}}">
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{date('d-m-Y', strtotime($issue->create_date))}}</a> </td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->id}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->details}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->facility_name}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->assign_to}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->name}}</a></td>

									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->zilla_name}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->upazil_name}}</a></td>
									<td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->union_name}}</a></td>

                                    <td>
										@if($issue->status == 'ongoing')
											<small class="badge badge-warning" style="font-weight: normal">Pending</small>
										@elseif($issue->status == 'resolved')
											<small class="badge badge-success" style="font-weight: normal">Resolved</small>
										@elseif($issue->status == 'postpone')
											<small class="badge badge-danger" style="font-weight: normal">Postpone</small>
										@else
											<small class="badge" style="font-weight: normal">{{$issue->status}}</small>
										@endif

									</td>
                                </tr>
								@endforeach
							@endif
                            </tbody>
                            
                        </table>
						
					</div>
				
				
				</div>
			
			</div>
			
		</div><!--/row -->

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