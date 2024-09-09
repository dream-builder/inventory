<?php

namespace App\Listeners;

use App\Last_login;
use Illuminate\Auth\Events\Login;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mockery\Exception;
use Auth;
use App\Http\Controllers\Cookies;

class LogSuccessfulLogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Login  $event
     * @return void
     */
    public function handle(Login $event)
    {
        //add value to last_login table
        try{
           // $last_login = new Last_login;

            //$last_login->user_id = Auth::id(); //Loggedin USer

           // $last_login->save();
            //return redirect('insert')->with('status',"Insert successfully");

            //set login user email and password to cookie
            $cooke= new Cookies();
            if(isset($_POST['remember']) && $_POST['remember']==true) {
                $cooke->setCookie(auth()->user()->email, $_POST['password']);
            }

            //Session::put('user_id', auth()->user()->user_id);


        }
        catch(Exception $e){
            //return redirect('insert')->with('failed',"operation failed");
        }
    }
}
