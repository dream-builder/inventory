<?php
#Made By Shahed
#Date May 24, 2021

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

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){}
    public function performance(){

        $sql ="select *, resolved+postpone+overdue as total from (select
                       u.user_id,
                       u.name user_name,
                       count(*) activity,
                       count (case when i.status = 'resolved' then 1 end) as resolved,
                       count (case when i.status = 'postpone' then 1 end) as postpone,
                       count (case when i.completion_date < now() and i.category ='issue' and i.status = 'ongoing' then 1 end) as overdue,
                       count (case when i.category ='comment' then 1 end) as comment,
                       count (case when i.category ='issue' then 1 end) as issue,
                       count (case when i.category ='issue' and i.status = 'ongoing' then 1 end) as ongoing
                       
                
                from issues i
                
                left join users u on u.user_id = i.user_id
                where i.user_id not in ('99999','261111')
                group by u.user_id, u.name) as p order by total desc";

        $data= DB::select($sql);

        return view('reports/performance_vew',['performance'=>$data]);
    }

    public function mail_list(){
        $sql ="select id, issue_id, creator_id, mail_to, cc, bcc, mail_subject, status, created_at from email order by  created_at desc";

        $data= DB::select($sql);

        return view('reports/email_list_vew',['email_list'=>$data]);
    }

    public function facilities(){

        $sql = $this->facility_query();

        //Region filter
        if(isset($_GET['region'])){
            $sql .= " where fr.zillaid in (select zilla from region where region_name = '".$_GET['region']."' )";
        }
        elseif(isset($_GET['zilla'])) {
            $sql .= " where fr.zillaid = '". $_GET['zilla'] . "'";
        }
//        else
//            $sql .= " where fr.zillaid::integer > 1 ";

        if(isset($_GET['type'])){
            $sql .=   " and fr.facility_type_id = ".$_GET['type'];
        }

        $sql .= "  group by  fr.facilityid, fr.facility_name,fr.facility_owner, ft.description, ft.short_code, fr.zillaid, fr.upazilaid,fr.facility_type_id,zilla_name,upazila_name,union_name,fr.unionid,fr.lat, fr.lon,";
        $sql .= "vf.facility_id,vf.id";
        $sql .= "  order by facility_name asc";
       // echo $sql;
        $data= DB::select($sql);

        //Facility Type
        $sql = "SELECT * FROM facility_type order by short_code";


        //Cusotom fields
        $sql = "SELECT column_name FROM information_schema.columns WHERE table_name = 'facility_registry' order by column_name asc;" ;
        $custom_fields= DB::select($sql);




        $facility_type= DB::select($sql);

        return view('reports/facilities_view',['facilities'=>$data,'facility_type'=>$facility_type, 'custom_fileds' => $custom_fields]);
    }

    public function facilities_ajax(){

        $sql ="select fr.facilityid, fr.facility_name, ft.description as facility_type, 
                       ft.short_code as short_code, fr.facility_owner, fr.zillaid, fr.upazilaid, fr.unionid, fr.facility_type_id, fr.lat, fr.lon,
                       z.\"ZillaNameEng\" as zilla_name, u.\"UpazilaNameEng\" as upazila_name, un.\"UnionNameEng\" as union_name,
                       count(case when i.category = 'issue' then 1 end) as issues,
                       count(case when i.category = 'issue' and i.status = 'resolved' then 1 end) as resolved,
                       count(case when i.category = 'issue' and i.status = 'ongoing' then 1 end) as ongoing,
                       count(case when i.category = 'issue' and i.status = 'postpone' then 1 end) as postpone,
                       case when vf.id is not null then 'verified' end as verify
                       
                       from facility_registry fr
                left join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                left join \"Upazila\" u on u.\"ZillaId\" = fr.zillaid and u.\"UpazilaId\" = fr.upazilaid
                left join  \"Unions\" un on un.\"ZillaId\" = fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid
                left join facility_type ft on ft.type = fr.facility_type_id 
                left join issues i on i.facility_id = fr.facilityid
                left join verify_facility vf on vf.facility_id = fr.facilityid
                
                
                ";
        //--where fr.zillaid in ('03','12','13','22','29','30','36','50','51','54','56','61','72','75','86','90','91')

        if(isset($_GET['facility_type']) && $_GET['facility_type']!=0){
            $sql .=   " where fr.facility_type_id = ".$_GET['facility_type'];
        }
        else{
            $sql .=   " where fr.facility_type_id != 0 ";
        }

        if(isset($_GET['div'])&& $_GET['div']!=0){
            $sql .=   " and z.\"DivId\" = '".$_GET['div']."'";
        }

        if(isset($_GET['zilla']) && $_GET['zilla']!=0){
            $sql .=   " and fr.zillaid = '".$_GET['zilla']."'";
        }

        if(isset($_GET['upazila']) && $_GET['upazila']!=0){
            $sql .=   " and fr.upazilaid::integer = '".$_GET['upazila'] ."'";
        }

//        fr.facilityid, fr.facility_name, as facility_type, ,, fr.unionid,
//                       z.\"ZillaNameEng\" as zilla_name, u.\"UpazilaNameEng\" as upazila_name, un.\"UnionNameEng\" as union_name,
//                       count(case when i.category = 'issue' then 1 end) as issues
        $sql .= "  group by  fr.facilityid,fr.facility_name,fr.unionid,fr.lat, fr.lon,  ft.description, ft.short_code, fr.zillaid, fr.upazilaid,fr.facility_type_id,zilla_name,upazila_name,union_name,";
        $sql .= " vf.facility_id,vf.id ";
        $sql .= "  order by issues desc";

        //echo $sql;

        $data= DB::select($sql);

      //  var_dump($data);
        //Facility Type
        //$sql = "SELECT * FROM facility_type order by short_code";
        //$facility_type= DB::select($sql);

        return view('reports/facilities_ajax_view',['facilities'=>$data]);

    }

    private function facility_query(){
        return $sql ="select fr.facilityid, fr.facility_name, ft.description as facility_type, ft.short_code as short_code, fr.facility_owner, 
                    fr.zillaid, fr.upazilaid, fr.unionid, fr.lat, fr.lon, fr.facility_owner, fr.facility_address, fr.facility_mobile,facility_reg_no,
                       z.\"ZillaNameEng\" as zilla_name, u.\"UpazilaNameEng\" as upazila_name, un.\"UnionNameEng\" as union_name,
                       count(case when i.category = 'issue' then 1 end) as issues,
                       count(case when i.category = 'issue' and i.status = 'resolved' then 1 end) as resolved,
                       count(case when i.category = 'issue' and i.status = 'ongoing' then 1 end) as ongoing,
                       count(case when i.category = 'issue' and i.status = 'postpone' then 1 end) as postpone,
                       case when vf.id is not null then 'verified' end as verify
                       
                       from facility_registry fr
                left join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                left join \"Upazila\" u on u.\"ZillaId\" = fr.zillaid and u.\"UpazilaId\" = fr.upazilaid
                left join  \"Unions\" un on un.\"ZillaId\" = fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid
                left join facility_type ft on ft.type = fr.facility_type_id
                left join verify_facility vf on vf.facility_id = fr.facilityid 
                left join issues i on i.facility_id = fr.facilityid";
    }

    public function verify_facility(){
        //var_dump($_GET['user_id']);
      //  var_dump($_GET['facility_id']);

        $data= DB::select('select count(*) from verify_facility where facility_id = ' . $_GET['facility_id']);

        if($data[0]->count <1){
            $sql = "insert into  verify_facility (user_id, facility_id)  ";
            $sql .= " values('" . $_GET['user_id'] ."',";
            $sql .= " '" . $_GET['facility_id'] ."');";

            $result = DB::statement($sql);

            //Update is mamoni
            if($result){
                $sql = "UPDATE facility_registry set ismamoni =1 Where facilityid = " . $_GET['facility_id'] .";";
                $result = DB::statement($sql);
            }
            var_dump($result);
        }

        //return false;

    }
}
