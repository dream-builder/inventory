@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{------------------------------------}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="pull-right">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="#" class="btn btn-sm btn-facebook"><i class="fa fa-undo"></i>&nbsp;&nbsp;Reset</a>
                            </div>
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="{{ route('register')}}" class="btn btn-sm btn-success">
                                    <i class="fa fa-save"></i>&nbsp;&nbsp;New
                                </a>
                            </div>
                        </div>
                        <span><a href="{{ Route("register/list")}}" class="btn btn-sm btn-primary grid-refresh"><i
                                        class="fa fa-refresh"></i> Refresh</a></span>
                    </div>
                    <!-- /.box-header -->
                    <div id="outerDiv" style="margin:5px;">
                        <table id="grid"></table>
                    </div>
                    <div class="box-body table-responsive no-padding">
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
@section('script')
    <script>

        $grid = $("#grid");
        $grid.jqGrid({
            datatype: 'json',
            'url':'{{Route("register/list")}}',
            colModel: [
                { name: "user_id", label: "User Id", width: 80, align: "center",height:50,searchoptions: {
                    searchOperators: true,
                    sopt: ['eq'],
                    }},
                { name: "name", label: "Name", width: 100,  align: "center",search:true },
                { name: "phone", label: "Mobile No", width: 75, align: "center" },
                { name: "union_id", label: "Union", width: 70, align: "center",search:false },
                { name: "upazilla_id", label: "Upazila", width: 60, align: "center",search:false },
                { name: "zilla_id", label: "Zila", width: 100, align: "center",search:false}
//                { name: "ship_via", label: "Shipped via", width: 105, align: "center" },
//                { name: "note", label: "Notes", width: 60,  sortable: false }
            ],
            pager: true,
            iconSet: "fontAwesome",
//            autoencode: true,
            viewrecords: true,
            rownumbers: true,
            altRows: true,
            scrollerbar:true,
            height:'660',
            forceFit:true,
            autowidth:true,
            shrinkToFit: true,
            altclass: "myAltRowClass",
            rowNum: '30',
            rowList: [5, 10, 30, 50, 100, "10000:All" ],
            caption: "List of all User",

        });
        $grid.jqGrid('filterToolbar', { stringResult: true, searchOnEnter: true, defaultSearch: "cn" });
    </script>
@endsection