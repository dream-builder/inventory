<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LogSuccessfulLogout
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
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        if(isset($_COOKIE['email'])) {
            unset($_COOKIE['email']);
            setcookie("email", "", time() - 3600, '/');
        }
        if(isset($_COOKIE['pass'])) {
            unset($_COOKIE['pass']);
            setcookie("pass", "", time() - 3600, '/');
        }
    }
}
