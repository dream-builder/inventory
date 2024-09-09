@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{------------------------------------}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <span>
                            <a href="{{ url("reports/year_wise_category")}}" class="btn btn-sm btn-primary grid-refresh"><i
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
            'url':'{{URL("reports/year_wise_category")}}',
            colModel: [
                { name: "zilla_name_eng", label: "Zilla",align: "center", width: 50,searchoptions: { searchOperators: true,sopt: ['cn']}},
                { name: "upazila_name_eng", label: "Upazila",align: "center", width: 50},
                { name: "union_name_eng", label: "Union",align: "center", width: 50},
                { name: "facility_id", label: "Facility Id",align: "center", width: 20 },
                { name: "facility_name", label: "Facility Name",align: "center", width: 100 },
                { name: "", label: "2015",align: "center", width: 50,search:false },
                { name: "", label: "2018",align: "center", width: 50,search:false },
                { name: "created_at", label: "Assessment Time",align: "center", width: 50,search:false },
                { name: "score", label: "Score", width: 20,search:false},
//                { name: "category", label: "Category", width: 20,search:false},
//                { name: "upazilla_id", label: "Upazila", width: 60, align: "center",search:false },
//                { name: "zilla_id", label: "Zila", width: 100, align: "center",search:false}
            ],
            pager: true,
            iconSet: "fontAwesome",
            viewrecords: true,
            rownumbers: true,
            altRows: true,
            scrollerbar:true,
            height:'400',
            forceFit:true,
            autowidth:true,
            shrinkToFit: true,
            altclass: "myAltRowClass",
            rowList: [5, 10, 20, "10000:All" ],
            caption: "List of all Section",

        });
    $grid.jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true, defaultSearch: "cn" });
    </script>
@endsection