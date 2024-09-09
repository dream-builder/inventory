<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Activity Tracking</title>

    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
        }

        .field-heading{
            font-weight:bold;
            color:#666;
            padding:3px;
        }
        .normal-txt{
            color:#000;
            font-weight:normal;
        }


    </style>
</head>

<body>

<div style="padding:5px 15px">
    <div style="padding:10px 0px;">{{$data->name}} <strong>Created an issue</strong></div>
    <span class="field-heading">Facility Name : <span class="normal-txt">{{$data->facility_name_eng}}</span></span>
    <span class="field-heading">Issue ID : <span class="normal-txt">{{$data->issue_id}}</span></span>
    <span class="field-heading">Zilla : <span class="normal-txt">{{$data->zilla_name_eng}}</span></span>
    <span class="field-heading">Upazila : <span class="normal-txt">{{$data->upazila_name_eng}}</span></span>
    <span class="field-heading">Union : <span class="normal-txt">{{$data->union_name_eng}}</span></span><br>
    <span class="field-heading">Creator / Reporter : <span class="normal-txt">{{$data->name}}</span></span>
    <span class="field-heading">Category : <span class="normal-txt">{{$data->category}}</span></span>
    <span class="field-heading">Start Date : <span class="normal-txt">{{$data->create_date}}</span></span>
    <span class="field-heading">Tentative Completion Date: <span class="normal-txt">{{$data->completion_date}}</span></span><br>
    <span class="field-heading">Priority : <span class="normal-txt">{{$data->priority}}</span></span>

    @if($data->issue_status == 'ongoing')
            <span class="field-heading">Status : <span class="normal-txt" style="display: inline-block; background-color:#fed22f; padding: 2px 5px;border-radius: 3px;">On going</span></span>
        @elseif($data->issue_status == 'postpone')
            <span class="field-heading">Status : <span class="normal-txt" style="display: inline-block; background-color:#F00; padding: 2px 5px;border-radius: 3px;">Postpone</span></span>
    @elseif($data->issue_status == 'resolved')
        <span class="field-heading">Status : <span class="normal-txt" style="display: inline-block; background-color:#2a9f2a; padding: 2px 5px; border-radius: 3px;">Resolved</span></span>
    @endif

    <div style="background-color:#FFF; padding:10px;; margin-top:5px; margin-bottom:25px;border:solid 1px #666;">
{{--        <b>Subject: </b>{{$data->mail_subject}}--}}

        <div style="min-height: 80px; height: auto;" >{{$data->details}}</div>
    <div>

    </div>

</div>
    <div style="padding-bottom:15px; ">
    Click <a href="{{asset("issueDetails/id=")}}{{$data->id}}">here</a> for more information.</div>
</div>
</body>
</html>