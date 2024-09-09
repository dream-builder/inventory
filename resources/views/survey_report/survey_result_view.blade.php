@extends('index')
@section('content')

	<style>
		.score-area{
			position: relative;
			text-align: center;

			margin-bottom: 30px;
		}

		.score-area .score-biscuit{
			width: 350px;
			height: auto;
			padding: 30px;
			background-color: #0EA3C4;
			display: inline-block;
			margin-right: 10px;
		}


	</style>

	<section class="content-header" style="margin-bottom: 25px" >
		<h1 style="display: inline-block">
			<a href="{{url('/')}}" style="color: #0A4F21"><i class="fa fa-dashboard"></i> Survey Reports</a>
		</h1>
	</section>

	<section>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-7">
					<div class="box box-primary">

						<div class="box-body">
							<div class="text-center text-primary">
								<h2>{{$facility_info[0]->facility_name}}</h2>
								<h4 style="margin-top: 0px">{{ ucwords(strtolower($facility_info[0]->upazila_name))}}</h4>
								<h4 style="margin-top: 0px">{{ ucfirst(strtolower($facility_info[0]->zilla_name))}}</h4>
								<h4 style="margin-top: 0px">Type of Facility: {{$facility_info[0]->description}}</h4>
							</div>
							<br><br>

							<div class="at-a-glance">

							</div>

							<table class="table table-hover" style="border:solid; border-width: 1px; border-color: #B9B5B5;">
								<thead>
								<tr>
									<th>Area</th>
									<th  class="text-center">Achieved Score</th>
									<th  class="text-center">Total Score</th>
									<th  class="text-center">Percentage</th>
								</tr>
								</thead>

								@if(isset($survey_result) && is_array($survey_result))

									<tbody>
									<?php $total_achieved_score = $total_score = $total_percent =0;?>
									@foreach($survey_result as $survey)

										<?php

										$percent= (int) 100 * (int) $survey->achieved_score / (int) $survey->total_score;

										$total_achieved_score += (int) $survey->achieved_score;
										$total_score += (int) $survey->total_score;
										$total_percent += (int) $percent;


										?>

										<tr>
											<td>{{$survey->assessment}}</td>
											<td class="text-center">{{$survey->achieved_score}}</td>
											<td class="text-center">{{$survey->total_score}}</td>
											<td class="text-center">{{(int) $percent}}%</td>
										</tr>



									@endforeach
									</tbody>

									<tfoot>
									<tr>
										<th>Total</th>
										<th  class="text-center">{{$total_achieved_score}}</th>
										<th  class="text-center">{{$total_score}}</th>
										<th  class="text-center">{{(int) (100 *  $total_achieved_score/  $total_score)}}%</th>

										<?php $total_percent = (int) (100 *  $total_achieved_score/  $total_score); ?>

									</tr>
									</tfoot>
								@endif
							</table>

							<div class="score-area hide" style="font-size: 18px;" >

								<table class="table" style="width: 50%">
									<tr>
										<td class="text-right">Total Score:</td>
										<td>{{$total_achieved_score}}</td>
									</tr>
									<tr>
										<td class="text-right" >Percentage:</td>
										<td>{{(int) (100 *  $total_achieved_score/  $total_score)}}</td>
									</tr>
									<tr>
										<td class="text-right">Facility Level:</td>
										<td>
											<?php
											if($total_percent >= 90 ){
												$level = "Level-3";
												$star = 5;
											}
											elseif($total_percent >= 80 && $total_percent <= 89){
												$level = "Level-2";
												$star = 4;
											}
											elseif($total_percent >= 70 && $total_percent <= 79){
												$level = "Level-2";
												$star = 3;
											}
											elseif($total_percent >= 60 && $total_percent <= 69){
												$level = "Level-1";
												$star = 2;
											}
											elseif($total_percent < 60){
												$level = "Level-1";
												$star = 1;
											}

											echo $level;

											?>

										</td>
									</tr>
									<tr>
										<td class="text-right">Facility Star:</td>
										<td >@for($i = 1; $i<= $star; $i++) <i class="fa fa-star text-yellow"></i> @endfor</td>
									</tr>
								</table>



							</div>
						</div>
					</div>


					<!-- The MNH Service Accreditation Scoring  -->

					<div class="box box-info">

						<div class="box-header">
							<div class="box-title">The MNH Service Accreditation Score</div>
						</div>

						<div class="box-body">
							<table class="table">

								<thead>
								<tr>
									<th>Scoring During Visit</th>
									<th>Star Rating after Assessment</th>
								</tr>
								</thead>

								<tbody>
								<tr>
									<td>90%</td>
									<td>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
									</td>
								</tr>
								<tr>
									<td>80%-89%</td>
									<td>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>

									</td>
								</tr>
								<tr>
									<td>70%-79%</td>
									<td>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>

									</td>
								</tr>
								<tr>
									<td>60%-69%</td>
									<td>
										<i class="fa fa-star text-yellow"></i>
										<i class="fa fa-star text-yellow"></i>

									</td>
								</tr>

								<tr>
									<td>Below 60%</td>
									<td>
										<i class="fa fa-star text-yellow"></i>


									</td>
								</tr>

								</tbody>


							</table>

						</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			$(document).ready(function (){

				$(".at-a-glance").html($('.score-area table'));

			});
		</script>
	</section>

@endsection
@section('script')
	<script>

	</script>
@endsection