@extends('index')
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                {{-- -------------------------------- --}}
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"></h3>
                        <div class="pull-right">
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="#" class="btn btn-sm btn-facebook"><i
                                        class="fa fa-undo"></i>&nbsp;&nbsp;Reset</a>
                            </div>
                            <div class="btn-group pull-right" style="margin-right: 10px">
                                <a href="{{ url('/section/create') }}" class="btn btn-sm btn-success">
                                    <i class="fa fa-save"></i>&nbsp;&nbsp;New
                                </a>
                            </div>
                        </div>
                        <span><a href="{{ url('section') }}" class="btn btn-sm btn-primary grid-refresh"><i
                                    class="fa fa-refresh"></i> Refresh</a></span>
                    </div>
                    <!-- /.box-header -->
                    <div id="outerDiv" style="margin:5px;">
                        <table id="grid_section"></table>
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
            'url': '{{ URL('section') }}',
            colModel: [
                //                { name: "section_id", label: "Section Id", width: 80, align: "center",height:50,search:false},
                {
                    name: "section_name",
                    label: "Section Name",
                    width: 100,
                    search: false
                },
                {
                    name: "details",
                    label: "Details",
                    width: 75,
                    search: false
                },
                //                { name: "union_id", label: "Union", width: 70, align: "center",search:false },
                //                { name: "upazilla_id", label: "Upazila", width: 60, align: "center",search:false },
                //                { name: "zilla_id", label: "Zila", width: 100, align: "center",search:false}
            ],
            pager: true,
            iconSet: "fontAwesome",
            //            autoencode: true,
            viewrecords: true,
            rownumbers: true,
            altRows: true,
            scrollerbar: true,
            height: '400',
            forceFit: true,
            autowidth: true,
            shrinkToFit: true,
            altclass: "myAltRowClass",
            rowList: [5, 10, 20, "10000:All"],
            caption: "List of all Section",

        });
        $grid.jqGrid('filterToolbar', {
            stringResult: true,
            searchOnEnter: true,
            defaultSearch: "cn"
        });
    </script>
@endsection
