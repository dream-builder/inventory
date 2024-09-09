<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Issues;
use App\Last_login;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use DB;
use Auth;
use App\Http\Controllers\Cookies;
use Illuminate\Http\Response;
use App\Http\Controllers\Notification;
use Illuminate\Support\Facades\Lang;

class DashboardController extends Controller
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

    private function chek_last_profile_update(){
        $sql = "select updated_at::date from users where user_id::integer =".Auth::user()->user_id;
        $result = DB::select($sql);
        if($result[0]->updated_at <='2022-01-01 0:0:0'){
            return false;
        }

        return true;
        //var_dump($result);
    }

    private function last_login(){

        //check login today
        $today = date('Y-m-d');
        $user_id = Auth::user()->user_id;
        $sql ="select * from last_login where user_id = '".$user_id."' and created_at::date between '".$today."' and '".$today."'; ";
        $result = DB::select($sql);

        if(sizeof($result)>0){
            $sql = "UPDATE last_login set created_at = '".date('Y-m-d H:i:s')."' where user_id='".$user_id."' and created_at::date='".$today."'";
           //echo $sql;
            DB::select($sql);
        }
        else{
            $last_login = new Last_login;
            $last_login->user_id = Auth::id(); //Loggedin USer
            $last_login->save();
        }

    }

    public function index() {


       
        $mysurvey = $this->assigned_survey(Auth::user()->user_id);

      
      
        return view('dashboard/factory_dashboard');

    }

    public function my_assignment(){
        $mysurvey = $this->assigned_survey(Auth::user()->user_id);
        return view('dashboard/dashboard_view', ['survey_list' => $mysurvey]);
    }

    public function assigned_survey($userid=null){

        $sql = "select ass.id, u.user_id, u.name, ass.sectionid, ass.survey_num, s.assessment, fr.facilityid, fr.facility_name, ass.status from assignment ass
                            left join users u on u.user_id::integer = ass.userid
                            left join assessment s on s.id = ass.sectionid
                            left join facility_registry fr on fr.facilityid::integer = ass.facilityid";


        $sql .=" where ass.userid = ".$userid;

        $result = DB::select($sql);

        //var_dump($result);

        return $result;
    }


}