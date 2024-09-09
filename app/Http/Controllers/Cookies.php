<?php


namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class Cookies extends Controller
{
    public function setCookie($email = null, $pass = null) {

        //$pass = crypt($pass,'s@lt@84ernoijwp983478kj202304i283');

        $day = 86400; // 1 day
        setcookie('email', $email, time() + $day*30, "/");
        setcookie('pass', $pass, time() + $day*30, "/");
    }

    public function getCookie() {
        return array(
            'email' => $_COOKIE['email'],
            'pass' => $_COOKIE['pass'],
        );
    }
}