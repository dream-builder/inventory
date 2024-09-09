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
    public function index(Request $request)
    {
//        if ($request->ajax() && $request->has('rows')) {
//            $per_page = $request->input('rows','10');
//            $sort = Input::has('sidx') ? Input::get('sidx', 'section_id') : 'section_id';
//            $sord = $request->input('sord','asc');
//            $filters = Input::has('filters') ? Input::get('filters', []) : [];
//            $op = array("eq" =>"=", "ne"=>"!", "lt"=>"<", "le"=>"<=", "gt"=>">", "ge"=>">=","cn"=>"LIKE");
//            $query = Section::orderBy($sort,$sord);
//            if(Input::has('filters')){
//                $filters = json_decode($filters);
//                foreach ($filters->rules as $filter){
//                    if($filter->op == 'cn'){
//                        $query->where($filter->field,$op[$filter->op],"%".$filter->data."%");
//                    }else{
//                        $query->where($filter->field,$op[$filter->op],$filter->data);
//                    }
//                }
//            }
//            $users = $query->paginate($per_page);
//            $data = array(
//                'page' => $users->currentPage(),
//                'rows' => $users->items(),
//                'records' => $users->total(),
//                'total' => $users->lastPage()
//            );
//            return response()->json($data);
//        }
        return view('question_list');
    }

    public function create(Request $data)
    {
        $sections = Section::with('questions', 'questions.options', 'questions.options.child_options')->orderBy('serial','asc')->get();
        return view('question_add', ['sections' => $sections]);
    }

    public function store(Request $request)
    {
        if ($request->ajax() || 1) {
            DB::beginTransaction();
            try {
                $sections = $request->data;
//                print_r($sections);
                foreach ($sections as $section) {
                    if (array_key_exists('questions', $section)) {
                        foreach ($section['questions'] as $question) {
                            $questionObj = Question::find($question['question_id']);
                            if (is_null($questionObj)) {
                                $questionObj = new Question;
                            }
//                            print_r($question['question_type']);
                            //dd($questionObj);
                            $questionObj->section_id = $section['section_id'];
                            $questionObj->question_text = $question['question_text'];
                            $questionObj->question_type = $question['question_type'];
                            //$questionObj->question_serial = 5;
                            if (!is_numeric($questionObj->section_id)) {
                                throw new Exception("Section Id missing !!");
                            }
                            if (!$questionObj->save()) {
                                DB::rollback();
                                return response()->json(['outcome' => 'error',
                                    'msg' => 'Not Saved successfully',
                                    'error' => 'error'
                                ]);
                            }
                            foreach ($question['options'] as $ops) {
//                                print_r($ops);
                                $option = Options::find($ops['option_id']);
                                if (is_null($option)) {
                                    $option = new Options;
                                }
                                $option->question_id = $questionObj->question_id;
                                $option->option_text = $ops['option_text'];
                                $option->option_value = $ops['option_value'];
                                if(array_key_exists('child_option_type', $ops)){
                                    $option->child_option_type = $ops['child_option_type'];
                                }
                                if (!$option->save()) {
                                    DB::rollback();
                                    return response()->json(['outcome' => 'error',
                                        'msg' => 'Not Saved successfully',
                                        'error' => 'error'
                                    ]);
                                }
                                if (array_key_exists('child_options', $ops)) {
                                    foreach ($ops['child_options'] as $ch_ops) {
                                        $ch_option = Options::find($ch_ops['child_option_id']);
                                        if (is_null($ch_option)) {
                                            $ch_option = new Options;
                                        }
                                        //$ch_option = new Options;
                                        $ch_option->question_id = $questionObj->question_id;
                                        $ch_option->option_text = $ch_ops['child_option_text'];
                                        $ch_option->option_value = $ch_ops['child_option_value'];
                                        $ch_option->parent_id = $option->option_id;
                                        if (!$ch_option->save()) {
                                            DB::rollback();
                                            return response()->json(['outcome' => 'error',
                                                'msg' => 'Not Saved successfully',
                                                'error' => 'error'
                                            ]);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            } catch (Exception $e) {
                DB::rollback();
                $exceptions_error = array($e->getMessage());
                return response()->json(['outcome' => 'failed',
                    'msg' => 'Exception Raised',
                    'error' => $exceptions_error
                ]);
            }
            DB::commit();
            return response()->json(['outcome' => 'success',
                'msg' => 'Saved successfully',
                'id' => "ss",
                'mode' => "mod"
            ]);
        }
    }
}
