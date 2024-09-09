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

    private function check_email_address($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
            return false;

        return true;
    }

    public function send_pending_mail()
    {

        //This function will send mail from mail table and update status to sent
        //.env file has variable MAIL_ACTIVE

        //MAIL_ACTIVE = true, mail will send
        //MAIL_ACTIVE = false, mail will not sent

        //if ( $_ENV['MAIL_ACTIVE'] == 'false')
        // return false;


        $mail_query = "SELECT
                                   e.id,
                                   email.id as email_id,
                                   email.mail_to,
                                   email.cc,
                                   email.bcc,
                                   email.tags as email_tag,
                                   email.mail_subject,
                                   email.mail_body details,
                                   email.template,
                                   e.status issue_status,
                                   fr.facility_name_eng, e.id issue_id, z.\"ZillaNameEng\" zilla_name_eng,
                                   fr.upazila_name_eng upazila_name_eng,
                                   u.\"UnionNameEng\" union_name_eng,
                                   usr.name,
                                   e.category category,
                                   e.created_at create_date,
                                   e.completion_date completion_date,
                                   e.priority
                            from email
                                left join issues e on e.id = email.issue_id
                                left join facility_registry fr on fr.facilityid = e.facility_id
                                left join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                                left join \"Upazila\" uz on uz.\"ZillaId\" = fr.zillaid and uz.\"UpazilaId\" = fr.upazilaid
                                left join \"Unions\" u on u.\"ZillaId\" = fr.zillaid and u.\"UpazilaId\" = fr.upazilaid and u.\"UnionId\" = fr.unionid
                                left join users usr on usr.user_id = email.creator_id::text
                            where email.status = 'pending'";

        //Getting record form mail table
        $pending_emails = DB::select($mail_query);

        var_dump($pending_emails);

        exit();
        foreach ($pending_emails as $pendingMail) {

            // var_dump($pendingMail);

            //return;

            //Preparing Mail receiver list
            $email_list = array();

            //If email is valid then add to sender list
            //Get email address from mail_to fields, this is a CSV field
            //Get email address form mail_to csv
            $mail_tags = explode(",", $pendingMail->mail_to);

            //var_dump($mail_tags);
            if (is_array($mail_tags) && sizeof($mail_tags) > 0) {

                foreach ($mail_tags as $mail_tag) {
                    //If email is valid then add to sender list
                    if ($this->check_email_address($mail_tag))
                        array_push($email_list, $mail_tag);
                }

            }


            //Get email address form tags. tags are csv
            $mail_tags = explode(",", $pendingMail->email_tag);

            //var_dump($mail_tags);
            if (is_array($mail_tags) && sizeof($mail_tags) > 0) {

                foreach ($mail_tags as $mail_tag) {
                    //If email is valid then add to sender list
                    if ($this->check_email_address($mail_tag))
                        array_push($email_list, $mail_tag);
                }

            }


            //Default Mail Receiver


            $receipent = $this->mail_receiver_group_by_id();

            // var_dump($receipent);

            if (sizeof($receipent) > 0) {
                foreach ($receipent as $rec) {
                    array_push($email_list, $rec->email);
                }
            }

            //Make the array unique if there is any duplicate
            $email_list = array_unique($email_list);

            //var_dump($email_list); return;
            // return view('mail',['data'=>$pendingMail]);

            // var_dump($pendingMail);
            //return view('mail/mail',['data'=>$pendingMail]);

            if ($pendingMail->template == 'new-issue-comment') {
                $template = 'mail/mail';
            }

            $subject = $pendingMail->mail_subject;

            //echo $subject;
            //return;
            //Send mail to the receiver
            Mail::send($template, ['data' => $pendingMail], function ($message) use ($subject, $email_list) {
                $message->to($email_list)->subject($subject);

                $message->from('mamoninotification.bangladesh@savethechildren.org', 'Activity Tracking System');
            });

            //Update sent mail status
            try {
                //echo $pendingMail->id;
                EmailQueue::where('id', $pendingMail->email_id)
                    ->update([
                        'status' => 'sent'
                    ]);
            } catch (Exception $e) {
                var_dump($e);
            }


        }
    }

    public function send_overdued_next_seven()
    {

        //This function will send mail from mail table and update status to sent
        //.env file has variable MAIL_ACTIVE

        //MAIL_ACTIVE = true, mail will send
        //MAIL_ACTIVE = false, mail will not sent

        // if ( $_ENV['MAIL_ACTIVE'] == 'false')
        //return false;

        //Getting issue which will be overdue in next 3 days
        $overdue_issue = DB::select("SELECT * FROM issues where category = 'issue' and  completion_date between  now() and now()+ '3 days'");

        var_dump($overdue_issue);

        //Add overdue issue to email table
        $comment = null;
        $email = new EmailQueue;
        $email->creator_id = Auth::id();
        //$email->issue_id = $last_inserted_issue_id;
        $email->mail_to = Auth::user()->email;
        $email->cc = '';
        $email->bcc = '';
        $email->mail_subject = '';
        $email->mail_body = $comment->details;
        $email->priority = $comment->priority;
        $email->tags = $comment->tags;
        $email->category = $comment->category;
        $email->status = 'pending';

        $email->save();

    }

    public function send_test_mail()
    {
        $data = array('name' => "Shahed");

        Mail::send(['text' => 'sendtestmail'], $data, function ($message) {
            $message->to('shahed.chaklader@savethechildren.org', 'ATS Test mail')->subject
            ('ATS Basic test mail');
            $message->from('mamoninotification.bangladesh@savethechildren.org', 'ATS');
        });
        echo "Basic Email Sent. Check your inbox.";
    }

    public function mail_receiver_group_by_id($id = 999)
    {
        $sql = "select distinct u.email from mail_group mg
                left join users u on u.user_id = mg.mail_user_id::text
                where mg.region_id = " . $id . " order by email asc";

        return DB::select($sql);
    }


    public static function email_receivers($facility_id)
    {

        //Get Facility Information by ID
        $sql = "select * from facility_registry where facilityid = '" . $facility_id . "'";

        $result = DB::select($sql);

        if (sizeof($result) > 0) {

            $zillaid = $result[0]->zillaid;
            $upazilaid = $result[0]->upazilaid;
            $unionid = $result[0]->unionid;
            $facility_type = $result[0]->facility_type_id;


            //Select Union level mail receivers
            if ($facility_type == 2 || $facility_type == 4 || $facility_type == 3 || $facility_type == 1) {

                $sql = "select u.email, u.name, u.user_id from region_mail_group rmg
                        left join users u on u.user_id = rmg.user_id
                        where rmg.zillaid = '" . $zillaid . "' and rmg.upazilaid = '" . $upazilaid . "' and rmg.unionid = '" . $unionid . "'";

            }

            //Select Upazila level mail receivers
            if ($facility_type == 5) {

                $sql = "select u.email, u.name, u.user_id from region_mail_group rmg
                        left join users u on u.user_id = rmg.user_id
                        where rmg.zillaid = '" . $zillaid . "' and rmg.upazilaid = '" . $upazilaid . "' and rmg.unionid = '0'";

            }

            //Select Zilla level mail receivers
            if ($facility_type == 6 || $facility_type == 7 || $facility_type == 8 || $facility_type == 9 || $facility_type == 10 || $facility_type == 12) {

                $sql = "select u.email, u.name, u.user_id from region_mail_group rmg
                 left join users u on u.user_id = rmg.user_id
                where rmg.zillaid = '" . $zillaid . "' and rmg.upazilaid = '" . $upazilaid . "' and rmg.unionid = '0'";

            }

           // echo $sql;

            $result = DB::select($sql);

            return $result;

           // var_dump($result);

        }


    }
}