<?php

namespace App\Http\Controllers;

use App\Facility;
use App\Options;
use App\Question;
use App\QuestionsOptionsMapping;
use App\Section;
use App\Zilla;
use App\User;
use App\Union;
use App\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request  as Input;
use Mockery\Exception;

class SurveyController extends Controller
{

    public function index(Request $request) {
        try {
            $str = (Input::get('url64', ''));
            if ($str != '') {
                $str = base64_decode($str);
                $json_str = json_decode($str, true);
                $view = "";
                $device = $json_str['device'];
                $facility_id = $json_str['facility_id'];
                $user_id = $json_str['user_id'];
                $token = $json_str['token'];
                $user = User::find($user_id);
                if($user != null){
                    Auth::login($user, true);
                }
                if ($device !='ANDROID' || $token != Auth::user()->token || $facility_id != Auth::user()->facility_id){
                    return redirect('/go404');
                }
                $view = "survey_for_android";
            } else {
                $facility_id = Input::get('facility_id', 0);
                $view = "survey";
                $geo = array();
            }

            //Find section for specific assessment
            $output=array();

            $assessment_sections = DB::select('select asm.section_id from assessment_section_mapping asm
    left join assignment a on a.sectionid = asm.assessment_id where a.id = ' . $_GET['asmnt']);

            if( sizeof($assessment_sections)<1) {
                return view('layouts/g0404');
            }

            foreach ($assessment_sections as $row) {
                array_push($output,$row->section_id);
                //$output.= "'".$row->section_id."',";
            }

            $sections = Section::with('questions', 'questions.options', 'questions.options.child_options', 'questions.options.child_options.child_options')->orderBy('serial', 'asc')->whereIn('section_id',$output)->get();

            //Assessment at a glance, hospital, assessor and others
            $assignment="";
            if(isset($_GET['asmnt'])){
                $sql = "select u.user_id, u.name, ass.sectionid,ass.status,ass.assessment_start_date, ass.survey_num, s.assessment, fr.facilityid, fr.facility_name from assignment ass
                            left join users u on u.user_id::integer = ass.userid
                            left join assessment s on s.id = ass.sectionid
                            left join facility_registry fr on fr.facilityid::integer = ass.facilityid
                where ass.id = ".$_GET['asmnt'];

                $assignment = DB::select($sql);

                $update_sql = "update assignment set status = 'on-going', assessment_start_date = '".date('Y-m-d H:i:s')."'" ;
                $update_sql .= " where id = " .$_GET['asmnt'];
                $assignment_status_update = DB::select($update_sql);
            }

            //var_dump($sections);

            //Pre answer of questions
            $sql = "select feedback_option_id from questions_options_mapping where facility_id in (select facilityid from assignment where id = " . $_GET['asmnt'] .") ";
            $sql .= " and survey_num = " . $_GET['survey_num'];
            //echo $sql;
    
            //return;


            $result = DB::select($sql);

            $ans = array();

            if(count($result)>0){
                foreach ($result as $r){
                    array_push($ans,$r->feedback_option_id);
                }
            }

            //survey note
            $sql = "select note from assessment_note where facility_id = (select facilityid from assignment where id = " . $_GET['asmnt'] . ") ";
            $sql .= " and assessment_id = " . $_GET['asmnt'];

            //echo $sql;
            $result = DB::select($sql);
            $note= (count($result)>0)?$result[0]->note:'';

            if(isset($_GET['d']) && $_GET['d']='show' ){
                return view('survey/survey_view', ['sections' => $sections, 'geo' => '', 'data' => $this->getLatestData($facility_id), 'assignment'=>$assignment, 'answers' => $ans, 'asmnt_note'=>$note]);

            }

            
            return view($view, ['sections' => $sections, 'geo' => '', 'data' => $this->getLatestData($facility_id), 'assignment'=>$assignment, 'answers' => $ans, 'asmnt_note'=>$note]);

        }catch (Exception $e){
            return redirect('/go404');
        }
    }
    public function getLatestData($facility_id=0){
        $facility_id = Input::has('facility_id') ? Input::get('facility_id', '###') : $facility_id;
        $latest_submission = array();
        $last_time = QuestionsOptionsMapping::select('created_at')->where('facility_id','=',$facility_id)->orderBy('created_at','desc')->first();
        if(!is_null($last_time)){
            $latest_submission = QuestionsOptionsMapping::select('feedback_option_id','value','feedback_text')->where('facility_id','=',$facility_id)->where('created_at','=',$last_time->created_at)->get();
        }
        return json_encode(array('date_of_submission'=>$last_time,'data'=>$latest_submission));
    }

//    public function getPreviousData(){
//        $facility_id = Input::has('facility_id') ? Input::get('facility_id', '###') : '###';
//        $previous_submission = array();
//        $previous_time = QuestionsOptionsMapping::where('facility_id','=',$facility_id)->orderBy('created_at', 'desc')->skip(1)->take(1)->first();
//        if(!is_null($previous_time)){
//            $previous_submission = QuestionsOptionsMapping::select('feedback_option_id','value','feedback_text')->where('facility_id','=',$facility_id)->where('created_at','=',$previous_time->created_at)->get();
//        }
//        return json_encode(array('date_of_submission'=>$previous_time,'data'=>$previous_submission));
//    }
    public function calculatePoint($id, $all){

        foreach($all as $single)
            if($single->option_id == $id)
                return $single->option_value;
    }

    public function store(Request $request){
        if ($request->ajax()) {
            $facility_id = $request->data['facility_id'];
            if(!ctype_digit($facility_id)){
                return response()->json([
                    'outcome' => 'failed',
                    'msg' => 'Invalid Facility',
                    'errorMsg' => "Invalid Facility"
                ]);
            }
            DB::beginTransaction();
            try {
                $feedbacks = $request->data;
                $obj = new QuestionsOptionsMapping;
                $all_options = Options::all();
                $dataSet = [];
                $feedback_question_ids = [];
                $created_time = date("Y-m-d H:i:s");
                if(array_key_exists('feedback', $feedbacks)){
                    foreach ($feedbacks['feedback'] as $key => $feedback){
                        $section_id = explode("_",$key)[0];
                        $question_id = explode("_",$key)[1];
                        array_push($feedback_question_ids,$question_id);
                        $feedback_text = "";
                        if (strpos($key, 'value') !== false) {
                            $feedback_option_id = (int)explode("_",$key)[2];
                            $feedback_text = $feedbacks['feedback'][$key];
                        }else{
                            $feedback_option_id = (int)$feedbacks['feedback'][$key];
                        }

                        array_push($dataSet,[
                            'facility_id'  => $facility_id,
                            'feedback_of_question_id' => (int)$question_id,
                            'feedback_option_id' => $feedback_option_id,
                            'section_id' => (int)$section_id,
                            'feedback_text' => $feedback_text,
                            'value'       => $this->calculatePoint((int)$feedbacks['feedback'][$key],$all_options),
                            'created_at'       => $created_time,
                            'created_by' => Auth::user()->user_id
                        ]);
                    }
                }
                $not_feedbacked_ids = Question::select('question_id','section_id')->whereNotIn('question_id',$feedback_question_ids)->get();
                foreach ($not_feedbacked_ids as $id){
                    array_push($dataSet,[
                        'facility_id'  => $facility_id,
                        'feedback_of_question_id' => $id->question_id,
                        'feedback_option_id' => 77777,
                        'feedback_text' => "",
                        'section_id' => $id->section_id,
                        'value'       => null,
                        'created_at'       => $created_time,
                        'created_by' => Auth::user()->user_id
                    ]);
                }
                $obj->insert($dataSet);
            } catch (Exception $e){
                DB::rollback();
                return response()->json([
                    'outcome' => 'failed',
                    'msg' => 'Exception Raised',
                    'errorMsg' => 'Save Not Successfully',
                ]);
            }

            DB::commit();
            return response()->json([
                'outcome' => 'success',
                'msg' => 'Saved successfully',
                'id' => "ss",
                'mode' => "mod",
                'data' =>json_decode($this->getLatestData($facility_id)),
            ]);
        }
    }

    public function save_survey(){
        //var_dump($_GET);
        $facility_id = $_GET['facility_id'];
        $creatd_by = $_GET['assessor_id'];
        $feedback = $_GET['feedback'];
        $survey_num = $_GET['survey_num'];


        //Update note
        $this->insert_survey_note($facility_id,$creatd_by,$_GET['assessment_id'],$_GET['note']);


        if(is_array($feedback)){

            foreach($feedback as $key=>$val){

                $section = substr($key,0,strpos($key,'_'));

                $que_section = substr($key,strpos($key,'_')+1);
                $question = substr($que_section , 0, strpos($que_section,"_"));

                //echo "section: ", $section , " Que: ", $question ,"<br>";

                //check if already exists
                $que_opt_mapping_id = $this->check_survey_exists($facility_id, $section, $question, $creatd_by, $survey_num );
                if( $que_opt_mapping_id){
                    //survey is exist, update previous value
                    $this->survey_update($que_opt_mapping_id,$facility_id, $section, $question, $creatd_by,$val,$survey_num );
                }else{
                    //Survey result is not exists insert new result
                    $this->survey_insert($facility_id, $section, $question, $creatd_by,$val,$survey_num);
                }


            }

        }



    }

    private function check_survey_exists($facility_id =null, $section=null, $question=null, $created_by=null, $survey_num=null ){

        if($facility_id ==null || $section==null || $question==null || $creatd_by=null){
            return false;
        }

        $sql = "select questions_options_mapping_id from questions_options_mapping where ";
        $sql .= "facility_id= '" . $facility_id ."' and ";
        $sql .= "section_id = " . $section ." and ";
        $sql .= "feedback_of_question_id = " . $question ." and ";
        $sql .= "created_by = " . $created_by ." and ";
        $sql .= "survey_num = " . $survey_num;
        //echo $sql;

        $result = DB::select($sql);
        //var_dump(count($result));

        if (count($result)>0 ){
            return  $result[0]->questions_options_mapping_id;
        }

        return false;

    }

    private function survey_update($que_opt_mapping_id=null, $facility_id =null, $section=null, $question=null, $created_by=null,$val=null, $survey_num=numm ){

        if($que_opt_mapping_id == null || $facility_id ==null || $section==null || $question==null || $creatd_by=null){
            return false;
        }

        $sql = "UPDATE questions_options_mapping  set ";

        $sql .= " facility_id= '" . $facility_id ."',";
        $sql .= " section_id = " . $section .",";
        $sql .= " feedback_option_id = " . $val .",";
        $sql .= " value = " . $option_val = DB::select("select option_value from options where option_id = " . $val )[0]->option_value .",";
        $sql .= " feedback_of_question_id = " . $question .",";
        $sql .= " survey_num =". $survey_num . "";
        $sql .=" where ";
        $sql .= " questions_options_mapping_id= '" . $que_opt_mapping_id ."' and survey_num=" . $survey_num. " and " ;
        $sql .= " created_by = " . $created_by ."";

        //echo $sql;

        $result = DB::statement($sql);

        //var_dump($result);
    }

    private function survey_insert($facility_id =null, $section=null, $question=null, $created_by=null, $val=null, $survey_num ){

        if($facility_id ==null || $section==null || $question==null || $creatd_by=null){
            return false;
        }

        $option_val = DB::select("select option_value from options where option_id = " . $val )[0]->option_value;
        var_dump("select option_value from options where option_id = " . $val);

        $sql = "insert into questions_options_mapping (facility_id,section_id,feedback_of_question_id,created_by,feedback_option_id, value, survey_num) values (";
        $sql .= "'" . $facility_id ."',";
        $sql .= $section .",";
        $sql .= $question .", ";
        $sql .= $created_by .",";
        $sql .= $val . ",";
        $sql .= $option_val .",";
        $sql .= $survey_num .")";

        //echo $sql;

        $result = DB::statement($sql);

        //var_dump($result);
    }


    private function insert_survey_note($facility_id, $assessor_id, $assessment_id, $note){

        //check previous
        $sql = "select count(*) from assessment_note where ";
        $sql .= " facility_id = " .$facility_id;
        $sql .= " and assessor_id = " .$assessor_id;
        $sql .= " and assessment_id = " .$assessment_id;

        if(DB::select($sql)[0]->count > 0){



            $sql = "UPDATE assessment_note  set ";
            $sql .= " note= '" . $note ."',";
            $sql .= " updated_at= '" . date("Y-m-d H:i:s") ."' where";

            $sql .= " facility_id = " .$facility_id;
            $sql .= " and assessor_id = " .$assessor_id;
            $sql .= " and assessment_id = " .$assessment_id;

            DB::statement($sql);

        }else{
            $sql = "insert into assessment_note(facility_id,assessor_id,assessment_id,note) values (";
            $sql .= "'" . $facility_id ."',";
            $sql .= "'" . $assessor_id ."',";
            $sql .= "'" . $assessment_id ."',";
            $sql .= "'" . $note ."')";
            DB::statement($sql);
        }
    }

    public function update_survey_status(){
        $update_sql = "update assignment set status = 'finished', assessment_end_date = '".date('Y-m-d H:i:s')."'" ;
        $update_sql .= " where id = " .$_GET['id'];
        $assignment_status_update = DB::statement($update_sql);
    }



}
