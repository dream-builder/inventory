<section>

    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Section List</h3>
            </div>


            <div class="box-body">

                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Action</th>
                            <th>Title</th>
                            <th>Deatail</th>
                            <th>Serial</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if (isset($section_list) && is_array($section_list))
                            @foreach ($section_list as $section)
                                <tr>
                                    <td><i class="btn btn-sm fa fa-trash sec-del"
                                            data-id="{{ $section->section_id }}"></i>
                                        <i class="btn btn-sm fa fa-pencil sec-edit"
                                            data-id="{{ $section->section_id }}"></i>
                                    </td>
                                    <td>
                                        <div id="sec-name{{ $section->section_id }}"> {{ $section->section_name }}</div>
                                    </td>
                                    <td>
                                        <div id="sec-detail{{ $section->section_id }}">{{ $section->details }}</div>
                                    </td>
                                    <td>
                                        <div id="sec-serial{{ $section->section_id }}">{{ $section->serial }}</div>
                                    </td>

                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</section>
