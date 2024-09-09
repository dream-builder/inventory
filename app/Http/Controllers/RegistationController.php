<?php


namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;
use DB;

class RegistationController  extends Controller
{
    public function index() {

        //return Zilla::all();
        //return view('account/create_account_view');
        return view('account/create_account_inner_view');
    }

    public function create_account()
    {

        //Create Account
        $max_user_id= DB::select("select max(cast(user_id as bigint))+1 as user_id from users");
        //dump($max_user_id[0]);
        //echo $max_user_id;
        //die();

        if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['password'])) {

            try {
                $obj_user = new User;
                $obj_user->user_id = $max_user_id[0]->user_id;
                //$obj_user->user_id ="100000";
                $obj_user->user_type = "REPORT-VIEW";
                $obj_user->is_active = "0";
                $obj_user->name = $_GET['name'];
                $obj_user->email = $_GET['email'];
                $obj_user->password = Hash::make($_GET['password']);
                $obj_user->save();
                return "1";
                //return view('auth/login');
            } catch (Exception $e) {
                return $e;
            }
        }
        return "Somethings went wrong";
    }
    //Is already Account
    public function is_account_exists()
    {

        //Create Account
        //$is_account= DB::select("select email from users where email=$_GET['password'])");

        //dump($max_user_id[0]);
        //echo $max_user_id;
        //die();

        //if (isset($_GET['email'])) {

            try {
                //$is_account= User::select('*')->where('email','=',$_GET['email'])->get();
                //dump($_GET['email']);
                //die();
                $is_account= DB::select("select email from users where email='".$_GET['email']."'");

                //$is_account= DB::select("select email from users where email="'.$email.'"');
                //$is_account= DB::select("select email from users where email='mfazlur.rahman111@savethechildren.org'");
                //dump($is_account[0]->email);
                if (isset($is_account[0]->email)) {
                    //dump("1");
                    return 1;
                }
                else
                {
                    //dump("2");
                    return 2;
                }


                //die();
            } catch (Exception $e) {
                return $e;
            }
        //}
       // return "Somethings went wrong";
    }

}