<?php


namespace App\Http\Controllers;
use App\User;
use DB;
use Auth;
use Mockery\Exception;
class ProfileController extends Controller
{
    public function index(){

        $sql="SELECT u.user_id, u.name, u.designation, d.designation as designation_name, u.email, u.phone, u.user_type, u.is_active, u.address, u.zilla_id, 
                    u.upazilla_id, u.union_id, u.created_at, u.updated_at FROM USERS u 
            left join designation d on d.id=u.designation::integer WHERE user_id::int = ".Auth::user()->user_id;
        $user_info = DB::select($sql);

       // var_dump($user_info);

        //Select All Zilla
        $zilla_info = $this->zilla_by_id();
        $upazila_info = $this->upa_zilla_by_id($user_info[0]->zilla_id);
        $union_info = $this->union_by_id($user_info[0]->zilla_id,$user_info[0]->upazilla_id);

        //Issue count
        $sql ="select count(*) activity,

                       count (case when i.status = 'resolved' then 1 end) as resolved,
                       count (case when i.status = 'postpone' then 1 end) as postpone,
                       count (case when i.status = 'ongoing' and i.category ='issue' then 1 end) as ongoing,
                       count (case when i.completion_date < now() then 1 end) as overdue,
                       count (case when i.category ='comment' then 1 end) as comment,
                       count (case when i.category ='issue' then 1 end) as issue
                from issues i where user_id = '".Auth::user()->user_id."'";

        $activity = DB::select($sql);

        $designation = DB::select ("select * from designation order by designation asc");


        return view('profile/profile_view',['user_info'=>$user_info[0],'zilla'=>$zilla_info,'upazila'=>$upazila_info,'union'=>$union_info,'activity'=>$activity[0], 'designation'=>$designation]);
    }

    public function zilla_by_id($zillaid = null){

        if($zillaid != null){
            $sql="SELECT * FROM \"Zilla\"  WHERE \"ZillaId\"::int=".$zillaid ;

        }
        else{
            $sql="SELECT * FROM \"Zilla\"";
        }

        $sql .= " ORDER BY \"ZillaNameEng\"";

        $zilla_info = DB::select($sql);

        return $zilla_info;
    }

    public function upa_zilla_by_id($zillaid=null){

        if($zillaid != null){
            $sql="SELECT * FROM \"Upazila\" WHERE \"ZillaId\"::int=".$zillaid ;
        }
        else{
            $sql="SELECT * FROM \"Upazila\"";
        }

        $sql .= " ORDER BY \"UpazilaNameEng\"";

        $upazilla_info = DB::select($sql);

        return $upazilla_info;
    }

    public function union_by_id($zillaid=null, $upazilaid = null){

        if($zillaid != null && $upazilaid != null){
            $sql="SELECT * FROM \"Unions\" WHERE \"ZillaId\"='".$zillaid ."' AND \"UpazilaId\" ='".$upazilaid."'" ;
        }
        else{
            $sql="SELECT * FROM \"Unions\"";
        }

        $sql .= " ORDER BY \"UnionNameEng\"";

        $union_info = DB::select($sql);

        return $union_info;
    }


    public function profile_update(){
        try {
            User::where('user_id', Auth::user()->user_id)
                ->update([
                    'name' => $_GET['name'],
                    'phone' => $_GET['phone'],
                    'designation' => $_GET['designation'],
                    'address' => $_GET['address'],
                    'zilla_id' => $_GET['zilla_id'],
                    'upazilla_id' => $_GET['upazila_id'],
                    'union_id' => $_GET['union_id'],
                    'updated_at' => date('Y-m-d H:i:s')
                ]);

            return "Success";
        }catch (Exception $e){

        }

        return false;
    }


}