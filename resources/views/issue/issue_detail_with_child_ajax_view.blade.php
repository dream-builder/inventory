<!-- comment -->
<div class="email-receiver-hidded">
    <div id="notification-receivers">
        <label for="" class="text-bold">Notification receiver(s)</label>
        <div style="border:solid 1px #DDD; padding: 5px; margin-bottom: 21px;">
            @if (isset($email_receivers) && is_array($email_receivers))
                @foreach ($email_receivers as $em)
                    <small class="label bg-green" title="{{$em->email}}">{{$em->name}}</small>
                @endforeach
            @endif
        </div>
    </div>
</div>

@foreach($comments as $row)
    <?php
        if($row->category == 'issue') {
           $border_color = '#BF43AC';
        }
        else{
            $border_color = '#435CBF';
        }

        ?>


   <div class="direct-chat-msg" style="background-color: #FFF;padding: 15px; box-shadow: 0px 0px 2px #827d7d;border-radius: 2px;border-top: solid 2px {{$border_color}};" >
      <div class="direct-chat-info clearfix" style="margin-bottom: 15px;">
         <span class="direct-chat-name pull-left" title="Creator"><i class="fa fa-user"></i> {{$row->name}}</span> &nbsp;
         <span class="direct-chat-timestamp" title="Create Date" style="color:#000;"> <i class="fa fa-calendar"></i> {{$row->created_at}}</span> &nbsp;
         <span title="Issue ID"><span class="fa fa-tags" ></span> {{$row->id}}</span> &nbsp;
         <span title="Assign To"><span class="fa fa-arrow-right" ></span> {{$row->assign_personnel}} [{{$row->assign_to}}]</span> &nbsp;

         <!-- issue Status -->
         @if ($row->status == 'resolved')
            <span title="Status" class="label label-success">Resolved</span>

         @elseif ($row->status == 'postpone')
            <span title="Status" class="label label-danger">Postpone</span>

         @elseif ($row->status == 'ongoing')
            <span title="Status" class="label label-warning">Ongoing</span>
      @endif
      <!-- /issue Status -->


      </div>
      @if ($row->category == 'issue')

         <div class="" style="border: none;font-weight: bold;font-size: 17px;">{{$row->title}} </div>
         <div class="direct-chat-text bg-white" style="border: none;font-weight: bold;font-size: 17px;"><?php echo $row->details;?></div>
         <div class="attachment">
            <?php

                if($row->attachment != "")
                {
                   $attachment =  explode(",",$row->attachment);

                   foreach ($attachment as $att){
                        //Attachment is not empty
                       if($att != ""){

                           //if Attachment is Image
                           if(strpos($att,".jpg")>0 || strpos($att,".jpeg" ) || strpos($att,".png") || strpos($att,".gif")){
                               load_image($att);
                           }

                       }
                   }

                }



             ?>

         </div>

         <div class="direct-chat-btn">
            @if ($row->resolved != "" && $row->resolved != null)
               <div style="padding: 5px; margin-bottom: 3px; border-bottom: solid 1px #ccc;">
                  <small>
                     <!-- issue Status -->
                     @if ($row->status == 'resolved')
                        <span title="Status" class="label label-success">Resolved</span>

                     @elseif ($row->status == 'postpone')
                        <span title="Status" class="label label-danger">Postpone</span>

                     @elseif ($row->status == 'ongoing')
                        <span title="Status" class="label label-warning">Ongoing</span>
                     @endif
                  <!-- /issue Status --> &nbsp;&nbsp;&nbsp;
                     <i class="fa fa-check-square"></i> <b>{{$row->status_changed_by}}</b> &nbsp;&nbsp;&nbsp;
                     <i class="fa fa-calendar"></i>  &nbsp;{{$row->created_at}}</small>
                  <br><div style="padding: 10px 5px; margin-bottom: 3px; background-color: #FFFFFF; "></span>{{$row->resolved}}</div></div>
            @endif
         </div>

      @else

         <img class="direct-chat-img" title="Comments" src="{{asset('public/image/comment.png')}}">
         <div class="direct-chat-text bg-white" style="border: none;font-weight: bold;font-size: 17px;"><?php echo $row->details;?></div>

      @endif

      <div class="direct-chat-btn">

                                <span style="cursor: pointer; border: solid 1px #DDD; border-radius: 3px; padding: 3px 5px;" class="reply-issue btn "
                                      data-parentid={{$row->id}} data-facility_id={{$row->facility_id}}><span class="fa fa-reply"></span> Reply</span>&nbsp;

         <!-- if status == resolved or postpone and category = issue then change status will not display -->

         @if ($row->status != 'resolved' && $row->status != 'postpone' && $row->category!='comment')
            <span title='Status' style="cursor: pointer; border: solid 1px #DDD; border-radius: 3px; padding: 3px 5px;" class="issue-status cursor-pointer btn"
                  data-issueid={{$row->id}} data-issuestatus={{$row->status}} data-facility_id={{$row->facility_id}} data-issuestatusdetails={{$row->resolved}}
                          type="button"><span class="fa fa-flag-checkered"></span> Change Status</span>
         @endif

         @if ($row->user_id == Auth::id() && $row->status=='ongoing')
            <span title='Edit' style="cursor: pointer; border: solid 1px #DDD; border-radius: 3px; padding: 3px 5px;" class="issue-edit1 issue-edit-new cursor-pointer issueDetails btn" data-issueid={{$row->id}}
                    data-userid={{$row->user_id}}  data-facility_id={{$row->facility_id}} data-issuedetails={{$row->details}}  type="button">
                                        <span class="fa fa-pencil"></span> Edit</span>
         @endif

         {{--                                {{var_dump($row->child)}}--}}
         <br><br>
         <!--if the issue has any child it will show here-->
         @foreach($row->child as $child)
            <div style="padding: 5px; margin-bottom: 10px; border-top: solid 1px #ddd;">
               <small class="text-bold">
                  <i class="text-bold">Reply From:</i><i class="fa fa-user-circle"></i> &nbsp;{{$child->name}} &nbsp;&nbsp;
                  <i class="fa fa-calendar"></i> &nbsp;{{$child->created_at}} &nbsp;&nbsp;
                  <i class="fa fa-tags" title="Refrence ID" ></i> &nbsp;{{$child->id}}

               </small>
               <br>
               <div style="background: #FFFFFF;padding: 5px 5px;margin-left: -5px;"><?php echo $child->details;?></div>

               <!-- Edit reply -->
               @if ($child->user_id == Auth::id() && $row->status=='ongoing')
                  <div>
                                                    <span title="Edit" class="btn reply-edit"
                                                          style="cursor: pointer; border: solid 1px #DDD; border-radius: 3px; padding: 3px 5px;"
                                                          data-reply_issue_id="{{$child->id}}" data-reply_facility_id="{{$child->facility_id}}"
                                                          data-issuedetails="{{$child->details}}"
                                                          data-parent-id="{{$row->id}}"><span class="fa fa-pencil"></span> Edit</span>
                  </div>
               @endif
            </div>
         @endforeach
      </div>
   </div>
@endforeach
<!--/comments -->

<?php function load_image($path){ ?>
        <div class="direct-chat-btn bg-white" style="width: 100px; height: auto; display:inline-block">
            <a href="{{url('/')}}/uploads/<?php echo $path;?>"><img src="{{url('/')}}/uploads/<?php echo $path;?>" style="width: 100%; height: auto; border: solid 1px #DDD;
padding: 5px;"></a>
        </div>
<?php } ?>