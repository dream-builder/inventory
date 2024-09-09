<?php

namespace App\Http\Controllers;

use App\Options;
use App\Question;
use App\Section;
use App\Zilla;
use App\Union;
use App\Upazila;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class QuestionController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(){

        $sql = "Select * from section ";
        $result = DB::select($sql);

        return view('question/question', ['section'=>$result]);
    }

    
    private function get_que_opt_by_section_id($sid){
        $sql = " SELECT json_build_object(";
        $sql .= " 'qid', q.question_id, ";
        $sql .=" 'question', q.question_text, ";
        $sql .=" 'serial', q.question_serial, ";
        $sql .=" 'options', COALESCE(o.ans, '[]'::json) ";
        $sql .=" ) AS question FROM questions q ";
        $sql .=" LEFT JOIN (";
        $sql .=" SELECT question_id, json_agg(option_text) AS ans ";
        $sql .=" FROM options ";
        $sql .=" GROUP BY question_id ";
        $sql .=" ) o ON q.question_id = o.question_id ";
        $sql .=" where q.section_id = " ;
        $sql .= $sid;
        $sql .=" order by q.question_serial asc " ;

        //echo $sql;
        return DB::select($sql);
    }
    
    
    private function get_que_opt_by_id($qid){
      
        $sql = "select * from questions q left join section s on s.section_id = q.section_id  where question_id=" . $qid;
        $resultq = DB::select($sql);

        $sql = "select * from options where question_id=" . $qid;
        $resulto = DB::select($sql);

        $data['question'] = $resultq[0];
        $data['options'] = $resulto;

        
        //var_dump($data);
        return $data;
    }

    public function load_by_section(){
       
        $result = $this->get_que_opt_by_section_id($_GET['qid']);

        return view('question/question_list', ['questions'=>$result]);

    }

    public function add_edit(){

        $data['question'] = '';
        $data['options'] = '';

        //When action is Edit it will load previous question and options for edit. othewise it will load blank field for new question and option  
        //var_dump($_GET);
        if(isset($_GET['action']) && $_GET['action']=='edit'){
            $data = $this->get_que_opt_by_id($_GET['qid']);
            
        }

        return view('question/add_edit_question', ['data' => $data]);
    }

    public function add_update_question(){

        
        //$sql = "BEGIN;"; 
        

        //CREATE NEW QUESTION
        $sql = "insert into questions (question_text, question_serial, question_type, section_id) values(";
        $sql .= "'"  . $_GET['question'] . "',";
        $sql .= "'"  . $_GET['serial'] . "',";
        $sql .= "'"  . $_GET['type'] . "',";
        $sql .= "'"  . $_GET['section'] . "'";
        $sql .= ") returning question_id;";
        //$sql .= "COMMIT;";

        $result = DB::select($sql);

        $qid_new = $result[0]->question_id;

  
        //print_r($_GET['options']);

        if(isset($_GET['options']) && is_array($_GET['options'])){

            foreach($_GET['options'] as $option){
              
                $data['option_text'] = $option['ans'];
                $data['option_value'] = $option['point'];
                $data['question_id'] = $qid_new;
                $data['serial'] = $option['serial'];

                DB::table('options')->insert($data);


            }

        }

        return "success";

    }


    //Remove Question and options
    public function delete_question(){

        DB::table('questions')->where('question_id', '=', $_GET['qid'])->delete();
        DB::table('options')->where('question_id', '=', $_GET['qid'])->delete();
        
    }

    public function update_serial(){
       $js = json_decode($_GET['update']);

       if(isset ($js) && is_array($js)){

        foreach($js as $obj){
            Question::where('question_id',$obj->qid)->update(['question_serial'=>$obj->serial]);
        }

       }
       

    }

}
