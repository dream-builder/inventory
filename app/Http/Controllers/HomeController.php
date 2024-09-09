<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class HomeController extends Controller
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
    public function index() {
//        $geo = array();
//        $sections = Section::with('questions', 'questions.options', 'questions.options.child_options','questions.options.child_options.child_options')->orderBy('serial','asc')->get();
//        return view('home',['sections' => $sections,'geo' => $geo]);
        return redirect('/dashboard');
        return view('home');
    }
    public function getPreviousData(){
        $facility_id = Input::has('facility_id') ? Input::get('facility_id', '###') : '###';
        $latest_submission = array();
        $last_time = QuestionsOptionsMapping::select('created_at')->where('facility_id','=',$facility_id)->orderBy('created_at','desc')->first();
        if(!is_null($last_time)){
            $latest_submission = QuestionsOptionsMapping::select('feedback_option_id','value')->where('facility_id','=',$facility_id)->where('created_at','=',$last_time->created_at)->get();
        }
        return json_encode(array('date_of_submission'=>$last_time,'data'=>$latest_submission));
    }
    public function get_geo_code()
    {
        $data = [];
        try {
            $ZillaId = Input::has('ZillaId') ? Input::get('ZillaId', '###') : '###';
            $UpaZilaId = Input::has('UpazilaId') ? Input::get('UpazilaId', '###') : '###';
            $UnionId = Input::has('UnionId') ? Input::get('UnionId', '###') : '###';
            if ($ZillaId == '###' && $UpaZilaId == '###' && $UnionId == '###') {
                $zillas = Zilla::select('ZillaId as id', 'ZillaNameEng as text')->get();
                return json_encode($zillas);
            } elseif ($ZillaId != '###' && $UpaZilaId == '###' && $UnionId == '###') {
                $upazillas = Upazila::select('UpazilaId as id', 'UpazilaNameEng as text')->where('ZillaId','=',$ZillaId)->get();
                return json_encode($upazillas);
            } elseif ($ZillaId != '###' && $UpaZilaId != '###' && $UnionId == '###') {
                $unions = Union::select('UnionId as id', 'UnionNameEng as text')->where('ZillaId','=',$ZillaId)->where('UpazilaId','=',$UpaZilaId)->get();
                return json_encode($unions);
            }elseif ($ZillaId != '###' && $UpaZilaId != '###' && $UnionId != '###') {
                $unions = Facility::select('facilityid as id', 'facility_name as text')->where('zillaid','=',$ZillaId)->where('upazilaid','=',$UpaZilaId)->where('unionid','=',$UnionId)->get();
                return json_encode($unions);
            } else {
                return json_encode($data);
            }
        } catch (Exception $e) {
            return json_encode($data);
        }
    }
    public function go404(){
        return view('layouts.g0404');
    }
}
