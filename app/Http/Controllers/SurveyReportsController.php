<?php


namespace App\Http\Controllers;
use App\QuestionsOptionsMapping;
use App\Section;
use DB;
use Auth;
use Illuminate\Support\Facades\Input;

class SurveyReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){

        //Get the list of Facilities that has completed the survey
        $survey_list = $this->assign_survey_list();



        if(isset($_GET['facilityid']) && !empty($_GET['facilityid'])){
            $facility_info = $this ->get_facility_info($_GET['facilityid']);
            $survey_result= $this->survey_result($_GET['facilityid']);

            return view('survey_report/survey_result_view', ['survey_result' => $survey_result, 'facility_info' => $facility_info ]);
        }


        return view('survey_report/dashboard_view', ['survey_list' => $survey_list ]);

    }

    private function survey_result($facility_id){

//        $sql = "select ass.assessment, sum(qom.value) as achieved_score, ass.id, ass.total_score from questions_options_mapping qom
//                    left join assessment_section_mapping asm on asm.section_id = qom.section_id
//                    left join assessment ass on ass.id =  asm.assessment_id
//                    where facility_id =$facility_id
//                    group by ass.assessment,ass.id;";


        $sql ="select assessment_name as assessment, sum(achieved_score) as achieved_score, sum (total_score) as total_score from (
                  select asmt.assessment_name, sum(qom.value) as achieved_score, ass.total_score
                  from questions_options_mapping qom
                           left join assessment_section_mapping asm on asm.section_id = qom.section_id
                           left join assessment ass on ass.id = asm.assessment_id
                           left join assessment_master asmt on asmt.groups = ass.groups
                  where facility_id = $facility_id
                  group by asmt.assessment_name, ass.total_score, asmt.groups
                 
              ) s

group by assessment_name";


        $result = DB::select($sql);

        return $result;

    }

    private function get_facility_info($facility_id){

        $sql = 'select fr.facilityid,ft.description, fr.facility_name, d.division, z."ZillaNameEng" as zilla_name, up."UpazilaNameEng" as upazila_name, u."UnionNameEng" as union_name  from facility_registry fr
                    left join "Zilla" z on z."ZillaId"::integer = fr.zillaid::integer
                    left join "Division" d on d.id::integer = z."DivId"::integer
                    left join "Upazila" up on up."ZillaId"::integer = fr.zillaid::integer and up."UpazilaId"::integer = fr.upazilaid::integer
                    left join "Unions" u on u."ZillaId"::integer = fr.zillaid::integer and u."UpazilaId"::integer = fr.upazilaid::integer and u."UnionId"::integer = fr.unionid::integer
                    left join facility_type ft on ft.type = fr.facility_type_id
                where facilityid = '.$facility_id;

        $result = DB::select($sql);

        return $result;
    }






    private function assign_survey_list (){

        $sql = 'select fr.facilityid, fr.facility_name, fr.zillaid, fr.upazilaid, fr.unionid, z."ZillaNameEng" as zilla_name, u."UpazilaNameEng" as upazila_name, un."UnionNameEng" as union_name from
                (select distinct facilityid::integer from assignment) ass
                left join facility_registry fr on fr.facilityid::integer = ass.facilityid::integer
                
                left join "Zilla" z on z."ZillaId"::integer = fr.zillaid::integer
                left join "Upazila" u on u."ZillaId"::integer = fr.zillaid::integer and u."UpazilaId"::integer = fr.upazilaid::integer
                left join "Unions" un on un."ZillaId"::integer = fr.zillaid::integer and un."UpazilaId"::integer = fr.upazilaid::integer and un."UnionId"::integer = fr.unionid::integer order by fr.facility_name';

        $result = DB::select($sql);


        return $result;
    }


    private function getLatestData($facility_id=0){
        //$facility_id = Input::has('facility_id') ? Input::get('facility_id', '###') : $facility_id;
        $latest_submission = array();
        $last_time = QuestionsOptionsMapping::select('created_at')->where('facility_id','=',$facility_id)->orderBy('created_at','desc')->first();
        if(!is_null($last_time)){
            $latest_submission = QuestionsOptionsMapping::select('feedback_option_id','value','feedback_text')->where('facility_id','=',$facility_id)->where('created_at','=',$last_time->created_at)->get();
        }
        return json_encode(array('date_of_submission'=>$last_time,'data'=>$latest_submission));
    }

}