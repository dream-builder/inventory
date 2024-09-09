@extends('index')

@section('content')
	<section class="content-header">
		<h1>
			{{$title}}

		</h1>

	</section>

    <section class="content">


		<div class="row">

			<div class="col-md-12">
				<div class="box box-warning " >
					<div class="box-header with-border">
						<h3 class="box-title">Search</h3>
						<div class="pull-right" id="small-loader" ></div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="col-md-4">
							<div class="form-group">
								<label for="from-date">From Date</label>
								<input type="text" class="form-control  " id="from-date" placeholder="Start Date" >
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="to-date">To Date</label>
								<input type="text" class="form-control" id="to-date" placeholder="End Date" >
							</div>
						</div>

						<div class="col-md-2">
							<div class="form-group">
								<label for="find-last-login">&nbsp;</label>
								<button type="button" id="find-last-login" class="form-control btn btn-primary"><i class="fa fa-binoculars"></i> Find</button>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<!--region-->
			<div class="col-md-12">

				<table class="table table-hover datatable">
					<thead>
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Designation</th>
						<th>Total Login</th>
					</tr>
					</thead>
					<tbody id="search-result">
					</tbody>
				</table>

			</div>
			<!--//region-->

		</div>



		<script>
			$(document).ready(function (){

				//$("#from-date").datepicker().datepicker("setDate", new Date());

				 // var now = new Date();
				 // now.setDate(now.getDate()+7);
				// $("#to-date").datepicker().datepicker("setDate", now);

				// $("#from-date").datepicker({
				// 	dateFormat: 'yy-mm-dd',
				// });
				//
				// $("#to-date").datepicker({
				// 	dateFormat: 'yy-mm-dd',
				// });


				$("#find-last-login").click(function (){

					$.ajax({
						type: "GET",
						url: site_url + "/user/logindetail",
						data: {"from_date":$("#from-date").val(), "to_date":$("#to-date").val()},
						cache: false,
						success: function(data){

							$("#search-result").html(data);


						}
					});
				});


			})
		</script>

    </section>

@endsection
@section('script')
    <script>
    </script>
@endsection