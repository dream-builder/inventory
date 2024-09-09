<?php


namespace App\Http\Controllers;
use DB;


class Notification extends Controller
{


    public static function  my_pending_task($user_id){

        $sql = "SELECT count(*) from issues i where i.user_id ='".$user_id."'";

        $issue = DB::select($sql);

        return $issue[0]->count;

    }


    public function my_pending_task_list($user_id){
        $sql = "SELECT i.id id, i.title, i.details details, to_char(i.create_date,'DD-MM-YYYY') create_date, to_char(i.completion_date,'DD-MM-YYYY') due_date,
                            i.assign_to assign_to, fr.facility_name facility_name, u.name assign_to, uc.name creator, status,i.category category,
                            fr.zillaid zilla_id, fr.upazilaid upazila_id, fr.unionid union_id, z.\"ZillaNameEng\" zilla_name, up.\"UpazilaNameEng\" upazila_name, un.\"UnionNameEng\" union_name
                            
                            FROM issues i
                            inner join facility_registry fr on fr.facilityid = i.facility_id
                            left join users u on u.user_id = i.assign_to
                            left join users uc on uc.user_id = i.user_id
                            left join \"Zilla\" z on z.\"ZillaId\" =  fr.zillaid
                            left join \"Upazila\" up on up.\"ZillaId\" =  fr.zillaid and up.\"UpazilaId\" = fr.upazilaid
                            left join \"Unions\" un on un.\"ZillaId\" =  fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid 
                            
                            where i.user_id ='".$user_id."' and i.category='issue'" ;

        $issue = DB::select($sql);

        return $issue;
    }
}