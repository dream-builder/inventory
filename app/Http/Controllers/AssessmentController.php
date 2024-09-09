<?php


namespace App\Http\Controllers;

use DB;
use Auth;
class AssessmentController extends Controller
{
    public function assessment_status(){
        $sql = "SELECT facility_name, facilityid  FROM facility_registry order by facility_name asc";
        $result = DB::select($sql);

        $sql = "SELECT *  FROM assessment order by assessment asc";
        $section = DB::select($sql);

        $sql = "SELECT *  FROM users order by name asc";
        $assessor = DB::select($sql);

        return view('assessment/assessment_status_view', ['facility'=>$result,'section'=>$section, 'assessor'=>$assessor]);

        return view('');
    }

    public function assessment_status_list(){

        $sql = "select ass.id, u.user_id, u.name, ass.sectionid, s.assessment, fr.facilityid, fr.facility_name,  ass.status, 
                            ass.assessment_start_date, ass.assessment_end_date from assignment ass
                            left join users u on u.user_id::integer = ass.userid
                            left join assessment s on s.id = ass.sectionid
                            
                            left join facility_registry fr on fr.facilityid::integer = ass.facilityid
                            
                            order by ass.created_at desc
                            ";

        $result = DB::select($sql);

        //var_dump($result);

        return view('assessment/assign_ajax_view', ['assignment'=>$result]);
    }


}