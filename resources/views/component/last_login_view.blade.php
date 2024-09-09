<!-- Last Login -->
<div class="row">

    <div class="col-md-12">

        <div class="box box-success">
            <div class="box-header"><h4>Last Login Information</h4></div>

            <div class="box-body">

                <table class="table table-hover datatable">

                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Total Login</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(sizeof($last_login))
                        @foreach($last_login as $data)
                            <tr>
                                <td>{{$data->user_name}}</td>
                                <td>{{$data->zilla}}</td>
                                <td>{{$data->lastlogin}}</td>
                            </tr>
                        @endforeach
                    @endif


                    </tbody>

                </table>

            </div>


        </div>

    </div>

</div>
<!-- /Last Login -->