@extends('index')
@section('content')
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <section>
        <div class="content">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-industry"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Registered Factories</span>
                            <span class="info-box-number">BGMEA 90</span>
                            <span class="info-box-number">BKMEA 90</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-file-text-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text" title="Initial Suvrey (Baseline)">Initial Suvrey (Baseline)</span>
                            <span class="info-box-number">BGMEA 41 </span>
                            <span class="info-box-number">BKMEA 41 </span>
                        </div>

                    </div>

                </div>


                <div class="clearfix visible-sm-block"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-check-circle-o"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Survey Complted</span>
                            <span class="info-box-number">BGMEA 50</span>
                            <span class="info-box-number">BKMEA 50</span>
                        </div>

                    </div>

                </div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Survey On going</span>
                            <span class="info-box-number">BGMEA 30</span>
                            <span class="info-box-number">BKMEA 30</span>
                        </div>

                    </div>

                </div>



            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Survey Status</h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                        class="fa fa-times"></i></button>
                            </div>

                        </div>
                        <div class="box-body">
                            <img src="{{ env('APP_URL') }}public/image/map-survey.jpg" height="600px">
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </section>
@endsection
@section('script')
    <script></script>
@endsection
