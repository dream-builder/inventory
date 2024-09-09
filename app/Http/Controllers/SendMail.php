<?php


namespace App\Http\Controllers;
use Mail;
use DB;


class SendMail
{
//This function will send email when any change made
    public function send($issueId){

        $get = DB::table('issues')
            ->join('facility_registry', 'facility_registry.facilityid', '=', 'issues.facility_id')
            ->select('*')
            ->where('issues.id','=',$issueId)
            ->get();


        // $get = Issues::select('*')->join('facility_registry','facility_registry.facilityid','=','issues.facility_id')->where(issues.id,'=',3)->get();


        return view('mail',['data'=>$get]);


        //send mail
        $data = array('name'=>"Facility Assessment");
        $emails = ['shahed.chaklader@savethechildren.org'];


        Mail::send('mail', $data, function($message) use ($emails){
            $message->to($emails)->subject
            ('Facility Assessment');
            $message->from('mohammad.shahed.chaklader@gmail.com','Facility Assessment');
        });

        //echo "Basic Email Sent. Check your inbox.";
    }
}