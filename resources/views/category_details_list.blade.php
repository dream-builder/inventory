@extends('index')
@section('content')
    <section class="content">
        <style>
            .ion{
                font-size: 60px;
            }
            .inner{
                padding-bottom: 0!important;
                padding-left: 10px!important;
                padding-top: 0!important;
            }
            .icon{
                top: -30px!important;
            }
        </style>
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3 class="up-count">53</h3>

                                <p><span class="up-percent"></span>% Upgrade</p>
                            </div>
                            <div class="icon">
                                <i class="ion" style="color: white">&#x25B2;</i>
                            </div>
                            <a href="#" class="small-box-footer">Upgraded Category </a>
                        </div>
                    </div>

                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 class="down-count">65</h3>

                                <p><span class="down-percent"></span>% Downgrade</p>
                            </div>
                            <div class="icon">
                                <i class="ion" style="color: white">&#x25BC;</i>
                            </div>
                            <a href="#" class="small-box-footer">Downgraded Category </a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner" >
                                <h3 class="equal-count">150</h3>
                                <p> <span class="equal-percent"></span>% No Changed</p>
                            </div>
                            <div class="icon">
                                <i class="ion" style="color: white">&#8651;</i>
                            </div>
                            <a href="#" class="small-box-footer">Unchanged Category </a>
                        </div>
                    </div>         <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3 class="not-com-count">150</h3>
                                <p> <span class="not-com-percent"></span>% Not Complete</p>
                            </div>
                            <div class="icon">
                                <i class="ion" style="color: white;font-style: normal;">&#9874;</i>
                            </div>
                            <a href="#" class="small-box-footer">Assessment Not Complete </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                {{------------------------------------}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <span>
                            <a href="{{ url("reports/category_details")}}" class="btn btn-sm btn-primary grid-refresh"><i
                                        class="fa fa-refresh"></i> Refresh</a>
                        </span>
                    </div>
                    <!-- /.box-header -->
                    <div id="outerDiv" style="margin:5px;">
                        <table id="grid_section"></table>
                    </div>
                    <div class="box-body table-responsive no-padding">
                    </div>

                    <div id="aaaa" style="margin:5px;">
                        <table id="list"></table>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>
    $grid = $("#grid_section");
        $grid.jqGrid({
            datatype: 'json',
            'url':'{{URL("reports/category_details")}}',
            colModel: [
                { name: "zilla_name_eng", label: "Zilla",align: "center", width: 40,searchoptions: { searchOperators: true,sopt: ['cn']}},
                { name: "upazila_name_eng", label: "Upazila",align: "center", width: 40},
                { name: "union_name_eng", label: "Union",align: "center", width: 40},
//                { name: "facility_id", label: "Facility Id",align: "center", width: 20,search:false },
                { name: "facility_name", label: "Facility Name",align: "center", width: 100 },
//                { name: "first_created_at", label: "First Assessment Time",align: "center", width: 50,search:false },
                { name: "category_first", label: "Baseline(2015-2016) Category",align: "center", width: 40,search:false,sortable: false,formatter: category_base},
                { name: "category_last", label: "Last(2018) Category",align: "center", width: 40,search:false,sortable: false,formatter: category_last},
//                { name: "last_created_at", label: "Last Assessment Time",align: "center", width: 50,search:false },
                { name: "change", label: "Change",align: "center", width: 20,sortable: false,search:false,formatter: change},
                { name: "first", label: "Baseline(2015-2016) Score", align: "center",width: 40,search:false},
                { name: "last", label: "Last(2018) Score",align: "center", width: 40,search:false},
            ],
            pager: true,
            iconSet: "fontAwesome",
            viewrecords: true,
            rownumbers: true,
            altRows: true,
            scrollerbar:true,
            height:'660',
            forceFit:true,
            cmTemplate: { title: false },
            autowidth:true,
            shrinkToFit: true,
            altclass: "myAltRowClass",
            title: false,
            rowNum: 'All',
            rowList: [5, 10, 30, 50, 100, "10000:All" ],
            caption: "List of all Section"
            ,
            loadComplete: function(data) {
                console.log(data);
                $('.equal-count').text(data['equal']);
                $('.up-count').text(data['up']);
                $('.down-count').text(data['down']);
                $('.not-com-count').text(data['not_complited']);
                $('.equal-percent').text(((data['equal']/data['records'])*100).toFixed(0));
                $('.up-percent').text(((data['up']/data['records'])*100).toFixed(0));
                $('.down-percent').text(((data['down']/data['records'])*100).toFixed(0));
                $('.not-com-percent').text(((data['not_complited']/data['records'])*100).toFixed(0));
            },

        });
    function change(cellValue, options, rowdata, action){
        if(rowdata['change'] == '+'){
            return "<img height='20' width='20' src='{{url("/image/up.png")}}'>";

        }else if(rowdata['change'] == '-'){
            return "<img height='20' width='20' src='{{url("/image/down.png")}}'>";

        }else if(rowdata['change'] == '='){
            return "<img height='20' width='20' src='{{url("/image/equal.png")}}'>";

        }else{
            return ""
        }

    }
    function category_base(cellValue, options, rowdata, action){
        if(rowdata['category_first'] == 'A'){
            return "<b><i style='color: green;font-size: 20px;font-family: Times New Roman;'> A</i> </b>";

        }else if(rowdata['category_first'] == 'B'){
            return "<b><i style='color: orange;font-size: 20px;font-family: Times New Roman;'> B</i> </b>";

        }else if(rowdata['category_first'] == 'C'){
            return "<b><i style='color: red;font-size: 20px;font-family: Times New Roman;'> C</i> </b>";

        }else{
            return ""
        }

    }
    function category_last(cellValue, options, rowdata, action){
        if(rowdata['category_last'] == 'A'){
            return "<b><i style='color: green;font-size: 20px;font-family: Times New Roman;'> A</i> </b>";

        }else if(rowdata['category_last'] == 'B'){
            return "<b><i style='color: orange;font-size: 20px;font-family: Times New Roman;'> B</i> </b>";

        }else if(rowdata['category_last'] == 'C'){
            return "<b><i style='color: red;font-size: 20px;font-family: Times New Roman;'> C</i> </b>";

        }else{
            return ""
        }

    }
    $grid.jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true, defaultSearch: "cn" });
    </script>
@endsection