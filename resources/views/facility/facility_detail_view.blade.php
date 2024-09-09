@extends('index')

@section('content')
    <section class="content-header">
    </section>

    <section class="content">
        <!-- issue Details header -->

        <div class="col-md-12" style="margin-top: -15px;margin-bottom: 30px;border-bottom: solid 2px #000;">
            <div class="row">
                <div style="color: #fff;display: inline-block;background-color: #4D4D4D;padding: 10px 25px; font-size: 16px;">Facility</div>
            </div>

        </div>


        <!-- Facility detail  -->
        <div class="row">

            <div class="col-md-3">
{{--            {{var_dump($issue_status)}}--}}
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive" style="width: 100%; border-width: 1px;" src="{{ asset("/public/image/facility_demo.jpg")}}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{$facility->facility_name}}</h3>

                        <p class="text-muted text-center text-bold">( {{$facility->facility_type}} )</p>

                        <p class="text-muted text-center">Zilla: {{$facility->zilla}}  Upazila: {{$facility->upazila}}  Union: {{$facility->union}}</p>

                        <ul class="list-group list-group-unbordered filter" data-filter="">
                            <li class="list-group-item filter" style="cursor: pointer;"  >
                                <b>Issue Created</b> <span class="pull-right">{{$issue_status->issue}}</span>
                            </li>
                            <li class="list-group-item filter" data-filter="resolved">
                                <b>Resolved</b> <span class="pull-right">{{$issue_status->resolved}}</span>
                            </li>
                            <li class="list-group-item filter" data-filter="ongoin">
                                <b>Ongoing</b> <span class="pull-right">{{$issue_status->ongoing}}</span>
                            </li>
                            <li class="list-group-item filter" data-filter="postpone">
                                <b>Postpone</b> <span class="pull-right">{{$issue_status->postpone}}</span>
                            </li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Intervention</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
{{--                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>--}}

{{--                        <p class="text-muted">--}}
{{--                            B.S. in Computer Science from the University of Tennessee at Knoxville--}}
{{--                        </p>--}}

{{--                        <hr>--}}

{{--                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>--}}

{{--                        <p class="text-muted">Malibu, California</p>--}}

{{--                        <hr>--}}

{{--                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>--}}

                        <p>
                            <span class="label label-danger">EmONC</span>
                            <span class="label label-success">KMC</span>
                            <span class="label label-info">SCANU</span>
                            <span class="label label-warning">eMIS</span>
                            <span class="label label-primary">QI</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Issue</a></li>
{{--                        <li><a href="#timeline" data-toggle="tab">Timeline</a></li>--}}

                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <table class="table table-hover datatable">
                                <thead>
                                <tr>

                                    <th>Ref. No.</th>
                                    <th>Issue Date</th>
                                    <th>Due Date</th>
                                    <th>Naratives</th>
                                    <th>Assign to</th>
                                    <th>Creator</th>
                                    <th>status</th>
                                </tr>
                                </thead>

                                <tbody>

                                @if(sizeof($data)>0)
                                    <?php $i=1;?>
                                    @foreach($data as $issue)

                                        <tr class='clickable-row' style="cursor: pointer" data-href="{{url('/issueDetails/id=')}}{{$issue->id}}">

                                            <td>{{$issue->id}}</td>
                                            <td>{{$issue->create_date}}</td>
                                            <td>{{$issue->due_date}}</td>

                                            @if($issue->title != 'Title')
                                                <td data-toggle="tooltip" data-placement="bottom" title="{{$issue->details}}">{{$issue->title}}</td>
                                            @else
                                                <td>{{$issue->details}}</td>
                                            @endif

                                            <td>{{$issue->assign_to}}</td>
                                            <td>{{$issue->creator}}</td>
                                            <td>
                                                @if($issue->category !== 'comment')
                                                    @if($issue->status == 'ongoing')
                                                        <span class="label label-warning" style="font-weight: normal">Ongoing</span>
                                                    @elseif($issue->status == 'resolved')
                                                        <span class="label label-success" style="font-weight: normal">Resolved</span>
                                                    @elseif($issue->status == 'postpone')
                                                        <span class="label label-danger" style="font-weight: normal">Postpone</span>
                                                    @else
                                                        <span class="label" style="font-weight: normal">{{$issue->status}}</span>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>

                            </table>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->



        </div>

    </section>


@endsection
@section('script')
    <script>

    </script>
@endsection

