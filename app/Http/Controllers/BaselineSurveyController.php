<?php


namespace App\Http\Controllers;

use DB;
use Auth;
class BaselineSurveyController extends Controller
{


    public function index () {

        $sql = "SELECT facility_name, facilityid  FROM facility_registry order by facility_name asc";
        $result = DB::select($sql);

        $sql = "SELECT *  FROM assessment order by assessment asc";
        $section = DB::select($sql);

        $sql = "SELECT *  FROM users order by name asc";
        $assessor = DB::select($sql);

     

        return view('baseline_survey/index', ['facility'=>$result,'section'=>$section, 'assessor'=>$assessor]);
        
        
    }

    public function baseline_survey_list(){
       
        $sql = "select ass.id, u.user_id, u.name, ass.sectionid,survey_num, s.assessment, fr.facilityid, fr.facility_name,  ass.status from assignment ass
                            left join users u on u.user_id::integer = ass.userid
                            left join assessment s on s.id = ass.sectionid
                            left join facility_registry fr on fr.facilityid::integer = ass.facilityid where ass.survey_num=0";

        $result = DB::select($sql);

        //var_dump($result);

        //var_dump($result);

       
        return view('baseline_survey/baseline_survey_list_ajax', ['assignment'=>$result]);
    }


    public function register(){

        // if the duplicate parameter is set to true, then multiple assignement of any facility will registered 
        if(!isset($_GET['duplicate'])){
            //Check assessor/survey if already assigned
            $sql ="select count(*) from assignment where survey_num=0 and facilityid = " .$_GET['facility'] ." and sectionid = ". $_GET['section'] ." and status != 'finished'";
            $result = DB::select($sql);

            //allready assigned to other
            if($result[0]->count>0){
                return 'Already assigned';
            }

        }
       
        //var_dump($result);
        try{
            $sql = "insert into assignment (userid, facilityid, sectionid, status, survey_num) values(";
            $sql .= $_GET['assessor'].",";
            $sql .= $_GET['facility'].",";
            $sql .= $_GET['section'].",";
            $sql .= "'active',";
            $sql .= 0;
            $sql .= ")";

            $result = DB::statement($sql);
            
        }catch(Exception $e){
            return 'Some problem Occured. ';
        }
      
        return 'success';

    }




    public function assessment_status(){
        $sql = "SELECT facility_name, facilityid  FROM facility_registry order by facility_name asc";
        $result = DB::select($sql);

        $sql = "SELECT *  FROM assessment order by assessment asc";
        $section = DB::select($sql);

        $sql = "SELECT *  FROM users order by name asc";
        $assessor = DB::select($sql);

        return view('assessment/assessment_status_view', ['facility'=>$result,'section'=>$section, 'assessor'=>$assessor]);

       
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