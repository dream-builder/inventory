<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Activity Tracking</title>

    <style>
        body{
            font-family:Arial, Helvetica, sans-serif;
            font-size:15px;
            line-height:25px;
        }

        .pending{
            display:inline-block;
            padding:3px 8px;
            border-radius:3px ;
            background-color:#F90;
            color:#FFF;
        }
        .title{
            font-size:18px;
        }
        .body-text{
            margin-top:15px;
            border-top:solid 1px #DDD;
            padding-top:10px;
        }

        .status{
            margin-top:10px;
        }

    </style>
</head>

<body>

<div class="title">{{$data->facility_name_eng}}</div>
<div class="go"><b>Zilla:</b> {{$data->zilla_name_eng}} &nbsp;&nbsp;&nbsp;&nbsp; <b>Upazila:</b> {{$data->upazila_name_eng}} &nbsp;&nbsp;&nbsp;&nbsp; <b>Union:</b> {{$data->union_name_eng}} </div>
<div class="creator"><b>Creator:</b> {{$data->name}} &nbsp;&nbsp;&nbsp;&nbsp; <b>Category:</b> {{$data->category}}</div>
@if($data->category == 'issue')
    <div class="date"><b>Start Date:</b> {{$data->create_date}} &nbsp;&nbsp;&nbsp;&nbsp; <b>Tentative Completion Date: </b> {{$data->completion_date}} &nbsp;&nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;&nbsp; <b>Priority:</b> {{$data->priority}} &nbsp;&nbsp;&nbsp;&nbsp;</div>

    <div class="status"><span class="pending">{{$data->status}}</span></div>
@endif
<div class="body-text">{{$data->details}}</div>
<div> Click <a href="{{asset("issueDetails/id=")}}{{$data->id}}">here</a> for more information.</div>
</body>
</html>


