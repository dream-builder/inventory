<?php

namespace App\Http\Controllers;

use App\User;
use App\UserResetToken;
use Illuminate\Support\Facades\Hash;
use Mail;
use Mockery\Exception;
use DB;
use Illuminate\Http\Request;


class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(){

        return view('password/forgot_password_view');

    }

//    public function reset_pass(Request $request){
//
//        if($request->ajax()){
//            $userid = Auth::User()->user_id;
//            $pass = $_GET['pass'];
//            $oldpass =$_GET['oldpass'];
//            echo  $this->password_update($userid, $pass,$oldpass);
//        }
//    }

    public function send_password_reset_request(){


        //Check existing email address
        $get_issue = DB::select ("select * from users where email = '".$_GET['email']."'");

        //var_dump($get_issue);

        //Found data
        if(sizeof($get_issue)<1){
            echo "Sorry! Email address not matched.";
        }
        else{
            //send emdil for reset password
            //Send mail to the receiver
            $email_list = array();
            array_push($email_list,$_GET['email']);


            Mail::send('passwd_reset_mail', ['data'=>$get_issue[0]], function($message) use ($email_list){
                $message->to($email_list)->subject
                ('Password Request From Activity Tracking System');
                $message->from('mamoninotification.bangladesh@savethechildren.org','Password reset - ATS');
            });

            //Add reset token to DB

            try {
                $reset_token = new UserResetToken;
                $reset_token->user_id = $get_issue[0]->user_id;
                $reset_token->token = base64_encode($get_issue[0]->email);
                $reset_token->save();

                return "Please chek your email. A password reset link hah been sent.";

            }
            catch (Exception $e){
                var_dump($e);
            }
        }
    }

    public function reset_pass(){

        //Check token
        $token = DB::select ("select * from user_reset_token where token = '".$_GET['token']."'");

        if(sizeof($token)<1){
            echo "<h1>Sorry! Requested token is expired or not found.</h1>";
        }
        else{
            return view('password/reset_pass_view',['data'=>$token[0],'token'=>$_GET['token']]);
        }
       // var_dump($token);

    }

    public function reset_password_change(){

        //Update password
       if(isset($_GET['user_id']) && isset($_GET['pass'])){

           try{
               $obj_user = User::find($_GET['user_id']);
               $obj_user->password = Hash::make($_GET['pass']);
               $obj_user->save();

               //Update token, delete record from user_reset_token
               DB::delete("delete from user_reset_token where user_id = '". $_GET['user_id']."'");


               //Success mail notification

               //Get user form id
               $useres = DB::select ("select * from users where user_id= '".$_GET['user_id']."'");

               if(sizeof($useres)>0) {
                    // Preparing email
                   $email_list = array();
                   array_push($email_list, $useres[0]->email);

                    //sent email
                   Mail::send('mail/password_change_success', ['data' => $useres[0]], function ($message) use ($email_list) {
                       $message->to($email_list)->subject
                       ('Password Request Success - ATS');
                       $message->from('mamoninotification.bangladesh@savethechildren.org', 'Password reset - ATS');
                   });
               }

           }catch (Exception $e){
               return $e;
           }
           return "Password update successful";
       }

       return "There is an error in user id or password. Please try later";



    }


}