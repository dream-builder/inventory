@extends('index')

@section('content')
    <section class="content-header">
    </section>

    <section class="content">

        @if(isset($comments[0]))
            <!-- issue Details header -->
            <div  class="row">
               <div class="col-md-12" style="margin-bottom: 10px;padding-top: 20px;padding-bottom: 10px;margin-top: -60px;background-color: #80A5DF;color: #FFF;">

                   <h3 style="color: #000;">{{$comments[0]->facility_name}}</h3>
                    <div style="color: #000">
                        <span class="text-bold">Facility ID (Code): </span> {{$comments[0]->facility_id}} &nbsp;&nbsp;
                        <span class="text-bold">Zilla: </span> {{$comments[0]->zillaname}} &nbsp;&nbsp;
                        <span class="text-bold">Upazila: </span> {{$comments[0]->upazilaname}}&nbsp;&nbsp;
                        <span class="text-bold">Union: </span> {{$comments[0]->unionname}}&nbsp;&nbsp;
                        <input type="hidden" id="facility_dropdown" value="{{$comments[0]->facility_id}}">
                    </div>

               </div>
                <div class="col-md-12" style="margin-bottom: 10px;"><button class="btn btn-danger" type="button" id="comments-to-add-btn"><span class="fa fa-plus"></span> &nbsp;Comment / Issue</button></div>
            </div>
            <!-- issue Details header -->


            <!-- Detail and list -->
            <div class="row">
                <!-- Issue detail -->
                <div class="col-md-7">
                    <div class="box box-success">
                    <div class="box-header with-border" style="background-color:#00a65a91;color: #FFF">
                        <h3 class="box-title">Detail</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body" id="issue-detail-reply"  >
                        @include('issue.issue_detail_reply_ajax_view')
                    </div>
                    <!-- /.box-body -->


                </div>
                </div>

                <!-- More related issue in this facility -->

                <div id="Issue_detatils" class="col-md-5">
                    <div id="comment-panel">
                            <!-- search result -->
                            <div class="box box-primary">
                                <div class="box-header with-border" >
                                    <h3 class="box-title">Other Issue of {{ucfirst($comments[0]->facility_name)}} </h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body" style="max-height: 550px; overflow-y: scroll">
                                    <form>
                                        <table class="table table-hover">


                                            @if(isset($other_issues) && sizeof($other_issues)>0)
                                                @foreach($other_issues as $issue)

                                                    <tr class='clickable-row' style="cursor: pointer" data-href="{{url('/issueDetails/id=')}}{{$issue->id}}">
                                                        {{--<td><input  id="issue_id" value="{{$issue->id}}"></td>--}}
                                                        @if ($issue->category == 'issue')

                                                            @if ($issue->status == 'resolved')
                                                                <td><i class="label label-success"><i class="fa fa-check"></i></i></td>

                                                            @elseif ($issue->status == 'postpone')
                                                                <td><i class="label label-danger"><i class="fa fa-close"></i></i></td>

                                                            @else
                                                                <td><i class="label label-warning"><i class="fa fa-exclamation-triangle"></i></i></td>

                                                            @endif
                                                        @else
                                                        <td><i class="label label-warning"><i class="fa fa-comments"></i></i></td>
                                                        @endif
                                                        <td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}" style="color: #000;font-size: 16px;padding-top: 6px;display: inline-block;">{{$issue->details}}</a></td>
                                                        {{--<td>{{$issue->details}}</td>--}}
                                                    </tr>
                                                @endforeach
                                            @endif


                                        </table>
                                    </form>


                                </div>
                            </div>

                    </div>
                </div>

                <!-- /More related issue in this facility -->
                <!-- Issue list -->
            </div>
            <!-- /Detail and list -->
        @endif
            <!-- Edit modal will load here-->
            <div id="issue-edit-modal"></div>

            @include('modals.create_issue_modal_view')
            @include('modals.reply_modal')
            @include('modals.status_change_modal')
            @include('modals.reply_edit')


    </section>

    <style>
        .facility_tr{
            cursor:pointer;
        }

    </style>

@endsection
@section('script')
    <script>

    </script>
@endsection