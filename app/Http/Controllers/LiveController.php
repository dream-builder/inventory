<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShahedController
 *
 * @author shahed.chaklader
 */
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;

class LiveController extends Controller {
    //put your code here
    public function __construct()
    {
		
		Auth::attempt(['user_id' => '260000', 'password' => 'sci']);
		//var_dump(auth()->user());
        //$this->middleware('auth');
    }

    public function index(Request $request){
		
        if ($request->ajax() && $request->has('rows')) {
            $per_page = $request->input('rows','1000');
            $sort = Input::has('sidx') ? Input::get('sidx', 'facilityid') : 'facilityid';
            $sord = $request->input('sord','asc');
            $filters = Input::has('filters') ? Input::get('filters', []) : [];
            $op = array("eq" =>"=", "ne"=>"!", "lt"=>"<", "le"=>"<=", "gt"=>">", "ge"=>">=","cn"=>"LIKE");
            $query = Facility::select('*')->join(DB::raw("(
                            with CTE as (select
                                 *
                                 ,ROW_NUMBER() over (partition by facility_id order by facility_id,created_at asc ) ascrnk
                                 ,ROW_NUMBER() over (partition by facility_id order by facility_id,created_at desc ) desrnk
                               from (SELECT
                                       facility_id,
                                       created_at,
                                       sum(value) AS max_value
                                     FROM questions_options_mapping
                                     GROUP BY facility_id, created_at) TestTable
                                      )
                                    select
                                    t1.facility_id,
                                    t1.max_value as first,
                                    t1.created_at as first_created_at,
                                    t2.max_value as last,
                                    t2.created_at as last_created_at
                                    from(
                                    select * from cte
                                    where ascrnk = 1
                                    ) t1
                                    left join (
                                    select * from cte
                                    where desrnk = 1
                                    ) t2 on t1.facility_id = t2.facility_id ) s"),
                's.facility_id','=','facility_registry.facilityid')->orderBy($sort,$sord);;
            if(Input::has('filters')){
                $filters = json_decode($filters);
                foreach ($filters->rules as $filter){
                    $query->where($filter->field,'ilike',"%".$filter->data."%");
                }
            }
            $object = $query->paginate($per_page);
            $equal = 0;
            $up = 0;
            $down = 0;
            $not_complited= 0;
            foreach ($object->items() as $item){
                if($item->first >199)
                    $item->category_first = 'A';
                elseif ($item->first >99 && $item->first < 199)
                    $item->category_first = 'B';
                else
                    $item->category_first = 'C';

                if($item->last >199)
                    $item->category_last = 'A';
                elseif ($item->last >99 && $item->last < 199)
                    $item->category_last = 'B';
                else
                    $item->category_last = 'C';


                if($item->category_first < $item->category_last){
                    $item->change = '-';
                    $down +=1;
                }elseif ($item->category_first > $item->category_last){
                    $item->change = '+';
                    $up +=1;
                }elseif ($item->category_first = $item->category_last){
                    $item->change = '=';
                    $equal += 1;
                }

                if($item->first_created_at == $item->last_created_at){
                    if($item->first_created_at == ""){
                        $item->last_created_at="";
                        $item->last="";
                        $item->category_last="";
                        $item->first_created_at="";
                        $item->first="";
                        $item->category_first="";
                        $item->change = '';
                        $equal -= 1;
                    }else{
                        if(strpos($item->first_created_at, '2015' )!== false){
                            $item->last_created_at="";
                            $item->last="";
                            $item->category_last="";
                            $item->change = '';
                            $equal -= 1;
                            $not_complited +=1;

                        }else{
                            $item->first_created_at="";
                            $item->first="";
                            $item->category_first="";
                            $item->change = '';
                            $equal -= 1;
                        }
                    }
                }

            }
            $data = array(
                'page' => $object->currentPage(),
                'rows' => $object->items(),
                'records' => $object->total(),
                'total' => $object->lastPage(),
                'equal' => $equal,
                'up' => $up,
                'down' => $down,
                'not_complited' => $not_complited,

            );
            return response()->json($data);
        }
        return view('category_details_list_dgfp');
		
    }

    public function category_compare(Request $request){

    }
}