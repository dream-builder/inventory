@extends('index')

@section('content')
    <section class="content-header">
        <h1>Performance</h1>
    </section>

    <div class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">15 Heights performance</h3>
                    </div>
                    <div class="box-body">
                        <div class="chart">
                            <canvas id="barChart" style="height: 450px; width: 787px;"></canvas>
                        </div>
                    </div>
                </div>


                <div class="box box-success">
                    <div class="box-header"><h3 class="box-title">Performance Data</h3></div>
                    <div class="box-body">

                        <table class="table table-hover datatable ">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th>Activity</th>
                                <th>Issue</th>
                                <th>Resolved</th>
                                <th>Ongoing</th>
                                <th>Overdue</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($performance as $p)
                            <tr>
                                <td>{{$p->user_name}}</td>
                                <td>{{$p->activity}}</td>
                                <td>{{$p->issue}}</td>
                                <td>{{$p->resolved}}</td>
                                <td>{{$p->ongoing}}</td>
                                <td>{{$p->overdue}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>


                <?php
                    $limit =0;
                    $users = array();
                    $issue = array();
                    $overdue = array();
                    $resolved = array();
                    $ongoing = array();
                    foreach ($performance as $p){
                        array_push($users,"'".$p->user_name."'");
                        array_push($issue,"'".$p->issue."'");
                        array_push($overdue,"'".$p->overdue."'");
                        array_push($resolved,"'".$p->resolved."'");
                        array_push($ongoing,"'".$p->ongoing."'");

                        $limit ++;
                        if($limit>14){
                            break;
                        }
                    }

                    $users = implode(",",$users);
                    $issue = implode(",",$issue);
                    $overdue = implode(",",$overdue);
                    $resolved = implode(",",$resolved);
                    $ongoing = implode(",",$ongoing);
                ?>
                <script>
                    $(document).ready(function () {

                        var areaChartData = {
                            labels  : [<?php echo $users;?>],
                            datasets: [
                                {
                                    label               : 'Issue',
                                    fillColor           : 'rgb(109,150,234)',
                                    strokeColor         : 'rgb(110,152,222)',
                                    pointColor          : 'rgb(102,138,198)',
                                    pointStrokeColor    : '#809bc4',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgb(109,123,215)',
                                    data                : [<?php echo $issue;?>]
                                },
                                {
                                    label               : 'Resolved',
                                    fillColor           : 'rgb(84,217,123)',
                                    strokeColor         : 'rgb(114,221,82)',
                                    pointColor          : '#4eba3b',
                                    pointStrokeColor    : 'rgb(60,188,62)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgb(60,188,88)',
                                    data                : [<?php echo $resolved;?>]
                                },
                                {
                                    label               : 'Ongoing',
                                    fillColor           : 'rgb(219,148,61)',
                                    strokeColor         : 'rgb(188,145,60)',
                                    pointColor          : '#ba873b',
                                    pointStrokeColor    : 'rgb(188,130,60)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgb(188,126,60)',
                                    data                : [<?php echo $ongoing;?>]
                                },
                                {
                                    label               : 'Overdue',
                                    fillColor           : 'rgb(248,45,20)',
                                    strokeColor         : 'rgb(188,86,60)',
                                    pointColor          : '#ba4e3b',
                                    pointStrokeColor    : 'rgb(188,75,60)',
                                    pointHighlightFill  : '#fff',
                                    pointHighlightStroke: 'rgb(188,86,60)',
                                    data                : [<?php echo $overdue;?>]
                                }
                            ]
                        }

                        //-------------
                        //- BAR CHART -
                        //-------------
                        var barChartCanvas = $('#barChart').get(0).getContext('2d')
                        var barChart = new Chart(barChartCanvas)
                        var barChartData = areaChartData
                        //barChartData.datasets[1].fillColor = '#00a65a'
                        //barChartData.datasets[1].strokeColor = '#00a65a'
                        //barChartData.datasets[1].pointColor = '#00a65a'
                        var barChartOptions = {
                            //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
                            scaleBeginAtZero: true,
                            //Boolean - Whether grid lines are shown across the chart
                            scaleShowGridLines: true,
                            //String - Colour of the grid lines
                            scaleGridLineColor: 'rgba(0,0,0,.05)',
                            //Number - Width of the grid lines
                            scaleGridLineWidth: 1,
                            //Boolean - Whether to show horizontal lines (except X axis)
                            scaleShowHorizontalLines: true,
                            //Boolean - Whether to show vertical lines (except Y axis)
                            scaleShowVerticalLines: true,
                            //Boolean - If there is a stroke on each bar
                            barShowStroke: true,
                            //Number - Pixel width of the bar stroke
                            barStrokeWidth: 2,
                            //Number - Spacing between each of the X value sets
                            barValueSpacing: 5,
                            //Number - Spacing between data sets within X values
                            barDatasetSpacing: 1,
                            //String - A legend template
                            legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
                            //Boolean - whether to make the chart responsive
                            responsive: true,
                            maintainAspectRatio: true
                        }

                        barChartOptions.datasetFill = false
                        barChart.Bar(barChartData, barChartOptions)
                    });
                </script>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/COntent-->

@endsection
@section('script')




@endsection