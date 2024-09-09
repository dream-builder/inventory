<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Section;
use App\Zilla;
use App\Union;
use App\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use DB;

class SectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('section/section_add');

    }

    public function section_list() {
        
        //$sql = "Select * from section";
        //$result = DB::select($sql);

        //return view('section/section_list_ajax');
    }
   }