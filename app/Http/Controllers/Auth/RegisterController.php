<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/register/list';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $rule = array();

        if($data['user_type'] == 'ADMIN'){
            $rule = array(
            'phone' => 'required|max:11|min:11|regex:/(01)[0-9]{9}/',
            'user_type' => 'required|string|max:20',
            'name' => 'required|string|max:255',
            'user_id' => 'required|string|max:20|unique:users',
            'password' => 'required|string|min:1|confirmed');
        }else if ($data['user_type'] == 'UFPO'){
            $rule = array(
                'zilla_id' => 'required|numeric|digits_between:2,3',
                'upazilla_id' => 'required|numeric|digits_between:2,3',
                'phone' => 'required|max:11|min:11|regex:/(01)[0-9]{9}/',
                'user_type' => 'required|string|max:20',
                'name' => 'required|string|max:255',
                'user_id' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:1|confirmed');
        }else if ($data['user_type'] == 'FWV-SACMO'){
            $rule = array(
                'zilla_id' => 'required|numeric|digits_between:2,3',
                'upazilla_id' => 'required|numeric|digits_between:2,3',
                'union_id' => 'required|numeric|digits_between:2,3',
                'phone' => 'required|max:11|min:11|regex:/(01)[0-9]{9}/',
                'user_type' => 'required|string|max:20',
                'name' => 'required|string|max:255',
                'user_id' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:1|confirmed');
        }else{
            $rule = array(
                'zilla_id' => 'required|numeric|digits_between:2,3',
                'upazilla_id' => 'required|numeric|digits_between:2,3',
                'union_id' => 'required|numeric|digits_between:2,3',
                'phone' => 'required|max:11|min:11|regex:/(01)[0-9]{9}/',
                'user_type' => 'required|string|max:20',
                'name' => 'required|string|max:255',
                'user_id' => 'required|string|max:20|unique:users',
                'password' => 'required|string|min:1|confirmed');
        }
        return Validator::make($data, $rule);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
//        dd($data);
        return User::create([
            'zilla_id' => $data['zilla_id'],
            'upazilla_id' => $data['upazilla_id'],
            'union_id' => $data['union_id'],
            'user_id' => $data['user_id'],
            'user_type' => $data['user_type'],
            'phone' => $data['phone'],
            'name' => $data['name'],
            'password' => bcrypt($data['password']),
        ]);
    }

    protected function register_list(Request $request)
    {
        if ($request->ajax() && $request->has('rows')) {
            $per_page = $request->input('rows','10');
            $sort = Input::has('sidx') ? Input::get('sidx', 'user_id') : 'user_id';
            $sord = $request->input('sord','asc');
            $filters = Input::has('filters') ? Input::get('filters', []) : [];
            $op = array("eq" =>"=", "ne"=>"!", "lt"=>"<", "le"=>"<=", "gt"=>">", "ge"=>">=","cn"=>"LIKE");
            $query = User::select("user_id","name","phone","union_id","upazilla_id","zilla_id")->orderBy($sort,$sord);
            if(Input::has('filters')){
                $filters = json_decode($filters);
                foreach ($filters->rules as $filter){
                    if($filter->op == 'cn'){
                        $query->where($filter->field,$op[$filter->op],"%".$filter->data."%");
                    }else{
                        $query->where($filter->field,$op[$filter->op],$filter->data);
                    }
                }
            }
            $users = $query->paginate($per_page);
            $data = array(
                'page' => $users->currentPage(),
                'rows' => $users->items(),
                'records' => $users->total(),
                'total' => $users->lastPage()
            );
            return response()->json($data);
        }
        return view('user_list');
    }
}
