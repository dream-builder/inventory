<?php
#Made By Shahed
#Date June 13, 2024

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
use Illuminate\Support\Facades\Input;
use Mockery\Exception;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        return view('section/section_add');
    }

    public function section_list() {
        
        $sql = "Select * from section";
        $result = DB::select($sql);

        return view('section/section_list_ajax',['section_list'=>$result]);
    }

    public function add_section(){

        //$section_data= $this->isJson($_POST['data']);

        $section_data = json_decode($_POST['data'],true);

        //var_dump($section_data);

       
         try {
             $section  = new Section;
 
             $section->section_name = $section_data['section_name'];
             $section->details = $section_data['details'];
             $section->serial = $section_data['serial'];
             
             //$facility->facilityid = $result[0]->max+1;
             $section->save();
 
             return "success";
 
         }catch (Exception $e){
 
         }

         
    }

    public function del() {
        
        $section_data = json_decode($_POST['data'],true);

        try{
        $sql = "delete from section where section_id = " . $section_data['section_id'];
        $del=DB::statement($sql);

        return true;
        }
        catch(Exception $e){

        }
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function edit(){

        $section_data = json_decode($_POST['data'],true);

        $sql = "Select * from section where section_id = " . $section_data['section_id'];
        $result = DB::select($sql);

        

        return view('section/section_edit',['edit_data'=>$result[0]]);

    }

    public function update() {
        $section_data = json_decode($_POST['data'],true);

        //var_dump ($section_data);
       // return;

        try{
            Section::where('section_id', $section_data['section_id'])
            ->update([
                'section_name' => $section_data['section_name'],
                'details' => $section_data['details'],
                'serial' =>  $section_data['serial']==""?0:$section_data['serial']
             ]);

             return 'success';
        }
        catch(Exception $e){

        }

       
        
        
    }

}