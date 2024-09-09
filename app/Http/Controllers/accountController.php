<?php


namespace App\Http\Controllers;

use App\Facility;
use App\Issues;
use App\Zilla;
use App\Union;

use App\Upazila;
use App\Section;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Auth;
use App\User;
use Illuminate\Support\Facades\Hash;


class accountController extends Controller
{

    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(){}

    public function reset_pass(Request $request){

        if($request->ajax()){
            $userid = Auth::User()->user_id;
            $pass = $_GET['pass'];
            $oldpass =$_GET['oldpass'];
            echo  $this->password_update($userid, $pass,$oldpass);
        }
        //else
           //return view('account/reset_pass');


    }

    private function password_update($userid, $pass,$oldpass){

        //Check old password and User ID
        if (!Auth::attempt(array('user_id' => $userid, 'password' => $oldpass))){

            return "Old Password did not match" . $oldpass." ".$userid; //'{ "status":401, "msg":"Old Password did not match" }';

        }

        $obj_user = User::find($userid);
        $obj_user->password = Hash::make($pass);
        $obj_user->save();


        //Login with new password
        Auth::attempt(array('user_id' => $userid, 'password' => $pass));

        return "Password update successful";
    }

    public function add_user(){
        return view('users/component_user');
    }

    public function update_user(){

    }

}