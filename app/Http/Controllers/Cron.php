<?php


namespace App\Http\Controllers;
use App\EmailQueue;
use App\Issues;
use Illuminate\Support\Facades\DB;
use Mail;
use Mockery\Exception;
use Auth;

class MailManager extends Controller
{

    public function __construct()
    {
        Auth::attempt(['email' => 'mail@system.com', 'password' => '123456']);
        $this->middleware('auth');
    }

    private function check_email_address($email){
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;

        return true;
    }

    public function send_pending_mail(){

            //This function will send mail from mail table and update status to sent
            //.env file has variable MAIL_ACTIVE

            //MAIL_ACTIVE = true, mail will send
            //MAIL_ACTIVE = false, mail will not sent

            if ( $_ENV['MAIL_ACTIVE'] == 'false')
                return false;

            //Getting record form mail table
            $pending_emails = DB::select("
                SELECT email.id as email_id, * from email
                left join issues e on e.id = email.issue_id
                left join facility_registry fr on fr.facilityid = e.facility_id
                left join users u on u.user_id = email.creator_id::text
                where email.status = 'pending'    
            ");

            //var_dump($pending_emails);


            foreach ($pending_emails as $pendingMail){

               // var_dump($pendingMail);

                //return;

                //Preparing Mail receiver list
                $email_list = array();

                //If email is valid then add to sender list
                if($this->check_email_address($pendingMail->mail_to))
                    array_push($email_list,$pendingMail->mail_to);

                //Get email address form tags. tags are csv
                $mail_tags = explode(",",$pendingMail->tags);

                //var_dump($mail_tags);
                if(is_array($mail_tags) && sizeof($mail_tags)>0){



                    foreach ($mail_tags as $mail_tag)
                    {
                        //If email is valid then add to sender list
                        if($this->check_email_address($mail_tag))
                            array_push($email_list,$mail_tag);
                    }

                }


                //Default Mail Receiver
                array_push($email_list,"shahed.chaklader@savethechildren.org");
                  array_push($email_list,"jamil.zaman@savethechildren.org");
//                array_push($email_list,"mamun-ur.rashid@savethechildren.org");
//                array_push($email_list,"murad.khan@savethechildren.org");
//                array_push($email_list,"feroj.mojahid@savethechildren.org");
//                array_push($email_list,"shakil.khan@savethechildren.org");
//                array_push($email_list,"mdnazrul.islam@savethechildren.org");
//                array_push($email_list,"mamun-ur.rashid@savethechildren.org");
//                array_push($email_list,"shumona.shafinaz@savethechildren.org");
//                array_push($email_list,"ucshibalayashimantik@gmail.com");

                //Make the array unique if there is any duplicate
                $email_list= array_unique($email_list);

               // var_dump($email_list);
               // return view('mail',['data'=>$pendingMail]);

                //Send mail to the receiver
                Mail::send('mail', ['data'=>$pendingMail], function($message) use ($email_list){
                    $message->to($email_list)->subject
                    ('Activity Tracking');
                    $message->from('mamoninotification.bangladesh@savethechildren.org','Activity Tracking System');
                });

                //Update sent mail status
                try {
                    //echo $pendingMail->id;
                    EmailQueue::where('id', $pendingMail->email_id)
                        ->update([
                            'status' => 'sent'
                        ]);
                } catch (Exception $e){
                    var_dump($e);
                }




            }
    }


}