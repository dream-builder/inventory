<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class detailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    public function index() {
		

        return view('detailView');
    }
	
	
	
	
    
}
