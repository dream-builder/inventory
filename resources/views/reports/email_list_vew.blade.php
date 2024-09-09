@extends('index')

@section('content')
    <section class="content-header">
        <h1>Mail List</h1>
    </section>

    <div class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Mail list</h3>
                    </div>
                    <div class="box-body" style="overflow: scroll; max-height: 550px">
                      <table class="table table-hover datatable">
                            <thead>
                            <tr>
                                <th width="20%">Mail to</th>
                                <th width="20%">Sub</th>
{{--                                <th width="40%">Message</th>--}}
                                <th width="10%">Status</th>
                                <th width="10%">Date</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($email_list as $email)
                            <tr>
                                <td>{{$email->mail_to}}</td>
                                <td>{{$email->mail_subject}}</td>
{{--                                <td>{{$email->mail_body}}</td>--}}
                                <td>
                                    <?php if ($email->status == 'pending             '){ ?>
                                        <span class="label label-warning">Pending</span>
                                    <?php }else if($email->status == 'sent                ') { ?>
                                        <span class="label label-success">Send</span>
                                    <?php }  ?>
                                </td>
                                <td>{{$email->created_at}}</td>
                            </tr>
                            </tbody>
                            @endforeach
                        </table>

                    </div>
                </div>

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </div><!--/Content-->

@endsection
@section('script')
@endsection