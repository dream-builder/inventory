<?php

namespace App\Http\Controllers;
use DB;
use Auth;

class FacilityController extends Controller
{
    public function index(){

       $facilityid = null;

       if(isset($_GET['id'])){
           $facilityid = $_GET['id'];
       }

       $facility = DB::select($this->facility_detail($facilityid));

       if(sizeof($facility)<1){
           return view('issue/issue_not_found');
       }

       $issue_status = DB::select($this->issue_status($facilityid));
       $issue = DB::select($this->issue_sql($facilityid));


        return view('facility/facility_detail_view', ['data'=>$issue, 'facility'=>$facility[0], 'issue_status'=> $issue_status[0]]);
    }

    private function issue_sql($facilityid){
        return $sql = "SELECT i.id id, i.title, i.details details, to_char(i.create_date,'DD-MM-YYYY') create_date, to_char(i.completion_date,'DD-MM-YYYY') due_date,
                            i.assign_to assign_to, fr.facility_name facility_name, u.name assign_to, uc.name creator, status,i.category category,
                            fr.zillaid zilla_id, fr.upazilaid upazila_id, fr.unionid union_id, z.\"ZillaNameEng\" zilla_name, up.\"UpazilaNameEng\" upazila_name, un.\"UnionNameEng\" union_name
                            
                            FROM issues i
                            inner join facility_registry fr on fr.facilityid = i.facility_id
                            left join users u on u.user_id = i.assign_to
                            left join users uc on uc.user_id = i.user_id
                            left join \"Zilla\" z on z.\"ZillaId\" =  fr.zillaid
                            left join \"Upazila\" up on up.\"ZillaId\" =  fr.zillaid and up.\"UpazilaId\" = fr.upazilaid
                            left join \"Unions\" un on un.\"ZillaId\" =  fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid
                            
                            where i.facility_id = '".$facilityid."' and i.category='issue'";
    }

    private function facility_detail($id){
       return $sql =  "select fr.facilityid, fr.facility_name, fr.facility_type, z.\"ZillaNameEng\" as zilla,
                           up.\"UpazilaNameEng\" as upazila, un.\"UnionNameEng\" as union 
                           from facility_registry fr
                    
                           left join \"Zilla\" z on z.\"ZillaId\" =  fr.zillaid
                           left join \"Upazila\" up on up.\"ZillaId\" =  fr.zillaid and up.\"UpazilaId\" = fr.upazilaid
                           left join \"Unions\" un on un.\"ZillaId\" =  fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid
                            
                           where fr.facilityid = '".$id."'";
    }

    private function issue_status($facilityid){
        return $sql = "select
                           count(case when i.category ='issue' then 1 end) as issue,
                           count(case when i.category ='issue' and i.status ='resolved' then 1 end) as resolved,
                           count(case when i.category ='issue' and i.status ='ongoing' then 1 end) as ongoing,
                           count(case when i.category ='issue' and i.status ='postpone' then 1 end) as postpone
                        from issues i
                        where i.facility_id ='".$facilityid."'";
    }
}