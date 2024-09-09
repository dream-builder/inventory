@extends('index')

@section('content')
    <section class="content-header">
        <h1>Organization Profile</h1>
    </section>

    <div class="content">

        <div class="row">
            <div class="col-md-4">

                <!-- About Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Contact Information</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" style="overflow: hidden">

                        <p class="text-muted">Organization</p>
                        <h3>{{ $profile->facility_name }} </h3>
                        <hr>

                        <p class="text-muted">Member of</p>
                        <strong>{{ $profile->facility_owner }} </strong>
                        <hr>

                        <p class="text-muted">Address</p>
                        <strong>{{ $profile->facility_address }} </strong>
                        <hr>

                        <p class="text-muted">Contact Person</p>
                        <strong>{{ $profile->contact_person }} </strong>
                        <hr>

                        <p class="text-muted">Phone/Mobile</p>
                        <strong>{{ $profile->facility_mobile }} </strong>
                        <hr>

                        <p class="text-muted">Email</p>
                        <strong><a href="mailto:{{ $profile->facility_email }}">{{ $profile->facility_email }} </strong>
                        <hr>




                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/Content-->
@endsection
@section('script')
@endsection
