<?php


namespace App\Http\Controllers;
use DB;
use Auth;

class AssignHsopitalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }

    public function index(){

        $sql = "SELECT facility_name, facilityid  FROM facility_registry order by facility_name asc";
        $result = DB::select($sql);

        $sql = "SELECT *  FROM assessment order by assessment asc";
        $section = DB::select($sql);

        $sql = "SELECT *  FROM users order by name asc";
        $assessor = DB::select($sql);

        return view('hospital/assign_view', ['facility'=>$result,'section'=>$section, 'assessor'=>$assessor]);
    }

    public function assign_list(){
        $sql = "select ass.id, u.user_id, u.name, ass.sectionid, ass.survey_num, s.section_name, fr.facilityid, fr.facility_name, ass.status from assignment ass
                left join users u on u.user_id::integer = ass.userid
                left join section s on s.section_id = ass.sectionid
                left join facility_registry fr on fr.facilityid::integer = ass.facilityid;";

        $sql = "select ass.id, u.user_id, u.name, ass.sectionid,survey_num, s.assessment, fr.facilityid, fr.facility_name,  ass.status from assignment ass
                            left join users u on u.user_id::integer = ass.userid
                            left join assessment s on s.id = ass.sectionid
                            left join facility_registry fr on fr.facilityid::integer = ass.facilityid";

        $result = DB::select($sql);

        //var_dump($result);

        return view('hospital/assign_ajax_view', ['assignment'=>$result]);
    }

    public function register_assignment(){

        // if the duplicate parameter is set to true, then multiple assignement of any facility will registered 
        if(!isset($_GET['duplicate'])){
            //Check assessor/survey if already assigned
            $sql ="select count(*) from assignment where facilityid = " .$_GET['facility'] ." and sectionid = ". $_GET['section'] ." and status != 'finished'";
            $result = DB::select($sql);

            //allready assigned to other
            if($result[0]->count>0){
                return 'Already assigned';
            }

        }

        //generate survey number
        $sql = "select (max (survey_num)::integer + 1) as survey_num from assignment where facilityid = " .$_GET['facility'] ." and sectionid = ". $_GET['section'];
        $result = DB::select($sql);
        
        //var_dump($result);

       

        $sql = "insert into assignment (userid, facilityid, sectionid, status, survey_num) values(";
        $sql .= $_GET['assessor'].",";
        $sql .= $_GET['facility'].",";
        $sql .= $_GET['section'].",";
        $sql .= "'active',";
        $sql .= $result[0]-> survey_num==NULL ? 1 : $result[0]->survey_num;
        $sql .= ")";

        //

        $result = DB::statement($sql);

        return $this->assign_list();

    }

    public function remove_assignment(){
        $sql = "delete from assignment where id = " . $_GET['id'];

        $result = DB::statement($sql);

        return $this->assign_list();

    }
}
