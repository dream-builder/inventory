<?php


namespace App\Http\Controllers;


class SocialController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index(){

        return view('social/richtext_view');
        //return view('social/social_view');


    }
}