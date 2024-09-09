@extends('index')
@section('content')

	<section class="content-header" style="margin-bottom: 25px" >
		<h1 style="display: inline-block">
			<a href="{{url('/')}}" style="color: #0A4F21"><i class="fa fa-dashboard"></i> Survey Reports</a>
		</h1>
	</section>

	<section>
			<div class="col-md-7">
				<div class="box box-primary">
					<div class="box-header">
						<div class="box-title">Survey List</div>
					</div>
					<div class="box-body">

						<table class="table table-hover">
							<thead>
								<tr>
									<th>Hospital Name</th>
									<th>Zilla</th>
									<th>Upazila</th>
								</tr>
							</thead>

							@if(isset($survey_list) && is_array($survey_list))
								<tbody>
									@foreach($survey_list as $survey)
										<tr>
											<td><a href="?facilityid={{$survey->facilityid}}" target="_blank">{{$survey->facility_name}}</a></td>
											<td>{{ ucfirst( strtolower($survey->zilla_name))}}</td>
											<td>{{ucfirst( strtolower($survey->upazila_name))}}</td>
										</tr>
									@endforeach
								</tbody>
							@endif

						</table>
					</div>
				</div>
			</div>

	</section>

@endsection
@section('script')
    <script>


    </script>
@endsection