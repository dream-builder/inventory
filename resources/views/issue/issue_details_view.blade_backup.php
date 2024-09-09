@extends('index')

@section('content')
    <section class="content-header">


    </section>

    <section class="content">
        <!-- issue Details Modal -->
        <div  class="row">

            <div class="col-md-12" style="margin-bottom: 30px;padding-top: 30px;padding-bottom: 30px;margin-top: -60px;background-color: #80A5DF;color: #FFF;"><h3>{{$comments[0]->facility_name}}</h3></div>
            <!-- mid column -->
            <div id="Issue_detatils" class="col-md-6">
                <div class="row" id="comment-panel" style="display: none">
                    <div class="col-md-12"><button class="btn btn-danger" type="button" id="comments-to-add-btn"><span class="fa fa-plus"></span> Comment / Issue</button></div>
                    <!-- Comment comumn -->
                    <div class="col-md-12" id="comment-body"></div>
                </div>



                <div class="row" id="comment-panel1">
                    <!-- Comment comumn -->
                    <div class="col-md-12">
                        <!-- search result -->
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">Comments / Tasks</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" id="comment-body1">
                                <!-- comment -->

                                @foreach($comments as $row)


                                    <div class="direct-chat-msg" >
                                        <div class="direct-chat-info clearfix">

                                            <span class="direct-chat-name pull-left">{{$row->name}}</span>
                                            <span class="direct-chat-timestamp pull-right">{{$row->created_at}}


                                            </span>

                                            <span class="direct-chat-name pull-left"><i class="fa fa-user"></i> {{$row->name}}</span> &nbsp;
                                            <span class="direct-chat-timestamp" style="color:#000;"><i class="fa fa-calendar"></i> {{$row->created_at}}</span>


                                        </div>



                                        @if ($row->status == 'resolved')
                                            <img class="direct-chat-img" title="Issue Resolved" src="{{asset('public/image/issue-completed.png')}}">

                                        @elseif ($row->status == 'postpone')
                                            <img class="direct-chat-img" title="Issue Postpone" src="{{asset('public/image/issue-postpone.png')}}">

                                        @else ($row->status == '')
                                            <img class="direct-chat-img" title="Issue" src="{{asset('public/image/issue.png')}}">
                                            {{--<button class="btn btn-success btn-xs issue-status" data-issueid="{{$row->id}}" data-issuestatus="{{$row->status}}" type="button">
                                                <span class="fa fa-flag-checkered"></span></button>--}}
                                        @endif

                                        <div class="direct-chat-text">{{$row->details}}  {{--+ '' +	{{$row->reply}}--}}
                                            {{--@if ($row->resolved != "" && $row->resolved != null)
                                                <div style="background-color: #dddddd"></span>{{$row->resolved}}</div>
                                            @endif--}}
                                        </div>

                                        <div class="direct-chat-btn">
                                            @if ($row->resolved != "" && $row->resolved != null)
                                                <hr><div style="padding: 5px; margin-bottom: 3px; background-color: #dddddd; border-bottom: solid 1px #ccc;"></span>{{$row->resolved}}</div>
                                            @endif
                                        </div>



                                        <div class="direct-chat-btn">

                                            <button class="btn btn-xs reply-issue" data-parentid={{$row->id}} data-facility_id={{$row->facility_id}}><span class="fa fa-reply"></span></button>
                                            <!--<button class="btn btn-success btn-xs issue-status" data-issueid="{{$row->id}}" data-issuestatus="{{$row->status}}" type="button">-->

                                                <!--<span class="fa fa-flag-checkered"></span></button> -->

                                            @foreach($row->child as $child)
                                                {{--{{var_dump ($child)}}--}}

                                                <hr><div style="padding: 5px; margin-bottom: 3px; background-color: #FFF;">
                                                    <small style="color:#999"><strong>Reply from:</strong> <i class="fa fa-user-circle"></i> {{$child->name}} &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i> {{$child->created_at}}</small>
                                                    <p style="margin-top: 7px;">{{$child->details}}</p>

                                                @if ($row->status == 'resolved')

                                                    <hr><div style="padding: 5px; margin-bottom: 3px; background-color: #dddddd; border-bottom: solid 1px #ccc;">{{$child->details}}
                                                        <br><small><i class="fa fa-user-circle"></i> {{$child->name}} &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i> {{$child->created_at}}</small>
                                                    </div>

                                                @elseif ($row->status == 'postpone')

                                                    <hr><div style="padding: 5px; margin-bottom: 3px; background-color: #dddddd; border-bottom: solid 1px #ccc;">{{$child->details}}
                                                        <br><small><i class="fa fa-user-circle"></i> {{$child->name}} &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i> {{$child->created_at}}</small>
                                                    </div>
                                                @else

                                                <hr><div style="padding: 5px; margin-bottom: 3px; background-color: #dddddd; border-bottom: solid 1px #ccc;">{{$child->details}}
                                                    <br><small><i class="fa fa-user-circle"></i> {{$child->name}} &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-calendar"></i> {{$child->created_at}}</small>

                                                </div>

                                                    &nbsp;{{--<button title='Edit' class="btn btn-pencil btn-xs reply-edit" data-reply_issue_id={{$child->id}} data-reply_facility_id={{$child->facility_id}}
                                                    data-issuedetails={{$child->details}} type="button">
                                                    <span class="fa fa-flag-checkered"></span></button>--}}

                                                    @if ($child->user_id==Auth::id())

                                                        <button title='Edit' class="btn btn-pencil btn-xs reply-edit" data-reply_issue_id={{$child->id}} data-reply_facility_id={{$child->facility_id}}
                                                                data-issuedetails={{$child->details}} type="button">
                                                            <span class="fa fa-flag-checkered"></span></button>

                                                    @else
                                                    @endif

                                                @endif
                                            @endforeach
                                        </div>
                                    </div>

                                    @endforeach
                                    </table>
                                    <!--/comments -->
                            </div>
                            <!-- /.box-body -->


                        </div>
                    </div>
                </div>
            </div>
            <!-- /mid comumn -->

            <!-- More related issue in this facility -->

            <div id="Issue_detatils" class="col-md-6">
                <div class="row" id="comment-panel">
                    <!-- Comment comumn -->
                    <div class="col-md-12">
                        <!-- search result -->
                        <div class="box box-warning">
                            <div class="box-header with-border">
                                <h3 class="box-title">More Issue / Comment</h3>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body" style="max-height: 550px; overflow-y: scroll">
                                <form>
                                <table class="table table-hover">


                                    @if(isset($other_issues) && sizeof($other_issues)>0)
                                        @foreach($other_issues as $issue)

                                    <tr class='clickable-row' style="cursor: pointer" data-href="{{url('/issueDetails/id=')}}{{$issue->id}}">
                                        {{--<td><input  id="issue_id" value="{{$issue->id}}"></td>--}}
                                        <td><a href="{{url('/issueDetails/id=')}}{{$issue->id}}">{{$issue->details}}</a></td>
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
            </div>

            <!-- /More related issue in this facility -->




        </div>
        <!-- issue Details Modal -->


        <!-- issue Modal -->
        <!-- Modal -->
        <div class="modal fade" id="modal-issue" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <div class="modal-title pull-left" id="">Create New Issue</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <!-- form -->
                        <form>
                            <!--<div class="form-group">
                                <label for="" class="text-bold">Title</label>
                                <input type="text" class="form-control" id="issue-title" placeholder="">
                            </div>-->

                            <div class="form-group">
                                <label for="" class="text-bold">Category</label>
                                <select class="form-control" id="issue-category">
                                    <option selected="selected" value="comment">Comment</option>
                                    <option value="issue">Issue</option>

                                </select>
                            </div>

                            <div id="issue-period" style="display:none;">
                                <div class="form-group">
                                    <label for="" class="text-bold">Issue Create Date (M-D-Y)</label>
                                    <input type="text" class="form-control" id="issue-create-date" placeholder="">
                                </div>

                                <div class="form-group">
                                    <label for="" class="text-bold">Issue Completion Date (M-D-Y)</label>
                                    <input type="email" class="form-control" id="issue-completion-date" placeholder="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-bold" style="display: block">Tag Others</label>
                                <textarea class="form-control" id="tags"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-bold">Priority</label>
                                <select class="form-control" id="issue-priority">
                                    <option selected="selected">Normal</option>
                                    <option>Low</option>
                                    <option>High</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for=""  class="text-bold">Description</label>
                                <textarea class="form-control" id="issue-detail"></textarea>
                            </div>



                        </form>
                        <!-- /form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btn-sm" id="create-issue">Create</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /issue Modal -->


        <!-- issue status change Modal -->
        <!-- Modal -->
        <div class="modal fade" id="modal-issue-status" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <div class="modal-title pull-left" id="">Issue</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <!-- form -->
                        <form>

                            <div class="form-group">
                                <label for="" class="text-bold">Status</label>
                                <select class="form-control" id="issue-status">
                                    <option value="ongoing">Pending</option>
                                    <option value="postpone">Postpone</option>
                                    <option value="resolved">Resolved</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="issue-update-detail" class="text-bold">Details</label>
                                <textarea id="issue-update-detail" class="form-control"></textarea>

                            </div>



                        </form>
                        <!-- /form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="change-status">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /issue status change Modal -->

        <!-- reply edit Modal -->
        <!-- Modal -->
        <div class="modal fade" id="modal-reply-comments-edit" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <div class="modal-title pull-left" id="">Reply Edit</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <!-- form type="hidden"-->
                        <form>
                            <input  type="hidden" id="reply_issue_id">
                            <input type="hidden" id="reply_facility_id">
                            <div class="form-group">
                                <label for="reply-detail-edit" class="text-bold">Reply Details</label>
                                <textarea id="reply-detail-edit" class="form-control"></textarea>

                            </div>



                        </form>
                        <!-- /form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="btn-reply-comments-edit">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- reply edit Modal -->

        <!-- Reply -->
        <div class="modal fade" id="modal-reply" tabindex="-1" role="dialog" aria-labelledby="">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-aqua">
                        <div class="modal-title pull-left" id=""><i class="fa fa-reply"></i> Reply</div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    </div>
                    <div class="modal-body">
                        <!-- form  type="hidden" -->
                        <form>
                            <input  type="hidden" id="reply_parent_id">
                            <input  type="hidden" id="reply_facility_id">
                            <div class="form-group">
                                <textarea id="issue-reply-txt" class="form-control"></textarea>
                            </div>



                        </form>
                        <!-- /form -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn-sm" id="reply-btn">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /reply -->

        </div><!--/row -->
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
