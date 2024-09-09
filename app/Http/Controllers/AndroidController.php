<?php


namespace App\Http\Controllers;
use App\Facility;
use App\Issues;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use DB;
use Auth;

class AndroidController extends Controller
{

    public function __construct()
    {

        Auth::attempt(['user_id' => '269753', 'password' => '12345678']);

        $this->middleware('auth');
        //var_dump(auth()->user());
        //$this->middleware('auth');
    }




    public function index() {
        if(isset($_GET['ajax'])) {
        //return Zilla::all();
        //$data= $this->load_dashboard();

        //Facility performace
        $facility_performance = $this->facility_performance();

        if(isset($_GET['region']) && $_GET['region'] !=""){
            $region_name = ucfirst($_GET['region']);

            $facilities = $this->get_facilities(array('region'=>$_GET['region']));

            // var_dump($facilities);

            return view('dashboard/dashboard_region_view_new',['data'=>$this->get_region_data($_GET['region']),'region_name'=>$region_name,'facilities'=>$facilities,'facility_performance'=>$facility_performance]);
        }

        if(isset($_GET['zilla']) && $_GET['zilla'] !=""){

            $region_name = DB::select("SELECT \"ZillaNameEng\" zillname FROM \"Zilla\" where \"ZillaId\"='".$_GET['zilla']."'");

            if(sizeof($region_name)>0)
                $region_name = ucfirst(strtolower($region_name[0]->zillname));
            else
                $region_name='';

            $facilities = $this->get_facilities(array('zilla'=>$_GET['zilla']));

            return view('dashboard/dashboard_region_view_new',['data'=>$this->get_region_data_by_zilla($_GET['zilla']),
                'region_name'=>$region_name, 'facilities'=>$facilities,'facility_performance'=>$facility_performance]);
        }

        //Last Login information
        $last_login = $this->last_login_info();

        $facilities = $this->get_facilities(null);

        //Get project related issue
        $project =$this->load_project_issue();
        //var_dump($project);


            return view('dashboard/dashboard_android_ajax_view',['data'=>$this->load_dashboard(),'last_login'=>$last_login,'facilities'=>$facilities,'project_activity'=>$project, 'facility_performance'=>$facility_performance]);
        }

        //Get all region information
        return view('dashboard/dashboard_android_view');

    }

    private function get_facilities($args){



        if($args == null)
        {
            //Get facility Information
            //$sql = "SELECT fr.facility_type, COUNT(*) FROM  facility_registry fr where zillaid in ('03','12','13','22','29','30','36','50','51','54','56','61','72','75','86','90','91') and facility_type is not null and facility_type !='99'  group by fr.facility_type order by facility_type";
            $sql = "SELECT fr.facility_type_id, ft.description,ft.short_code, COUNT(*) as total FROM  facility_registry fr
                        left join facility_type ft on ft.type = fr.facility_type_id

                        where zillaid in ('03','12','13','22','29','30','36','50','51','54','56','61','72','75','86','90','91')
                        and facility_type_id is not null and facility_type_id !='99'
                        
                        group by fr.facility_type_id, ft.description,ft.short_code order by total desc;";
        }

        if($args !=null){
            if(isset($args['region'])){
                $sql = "SELECT fr.facility_type, COUNT(*) FROM  facility_registry fr where zillaid in (select zilla from region where region_name = '".$args['region']."') and facility_type is not null and facility_type !='99' and facility_type !='others' group by fr.facility_type order by facility_type";
                $sql = "SELECT fr.facility_type_id, ft.description,ft.short_code, COUNT(*) as total FROM  facility_registry fr
                        left join facility_type ft on ft.type = fr.facility_type_id

                        where zillaid in (select zilla from region where region_name = '" .$args['region']."' )
                        and facility_type_id is not null and facility_type_id !='99'
                        
                        group by fr.facility_type_id, ft.description,ft.short_code order by total desc;";
            }

            if(isset($args['zilla'])){
                $sql = "SELECT fr.facility_type, COUNT(*) FROM  facility_registry fr where zillaid = '" . $args['zilla'] . "' and facility_type is not null and facility_type !='99' and facility_type !='others' group by fr.facility_type order by facility_type";
                $sql = "SELECT fr.facility_type_id, ft.description,ft.short_code, COUNT(*) as total FROM  facility_registry fr
                        left join facility_type ft on ft.type = fr.facility_type_id

                        where zillaid = '".$args['zilla']."'
                        
                        and facility_type_id is not null and facility_type_id !='99'
                        
                        group by fr.facility_type_id, ft.description,ft.short_code order by total desc;";
            }
        }

        return DB::select($sql);
    }

    private function load_dashboard(){
        try {

            $start_date = date("Y-m-d 00:00:00");
            $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));

            //$region_name = "'".strtolower($_GET['region'])."'";
            $region = DB::select("select act.\"region_name\" \"location_name\", count(act.title) as \"activity\",
                                count(case when act.category='issue' then 1 end) as \"issue\",
                                count(case when act.category='comment' then 1 end) as \"comment\",
                                count(case when act.status='resolved' and act.category='issue' then 1 end) as \"resolved\",
                                count(case when act.status='postpone' and act.category='issue' then 1 end) as \"postpone\",
                                count(case when now() > act.completion_date and act.category='issue' and act.status='ongoing' then 1 end) as \"expired\",
                                count(case when act.category='issue' and act.completion_date between now() and now()+ '7 days' and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired_seven_days\",
                                count(case when act.category='issue' and act.creation_date between '$start_date' and '$end_date' then 1 end) as \"issue_created_today\"
                                from
                                
                                (select *,i.created_at creation_date from issues i
                                                   inner join facility_registry fr on fr.facilityid = i.facility_id
                                                   --inner join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                                                   inner join \"region\" r on r.zilla = fr.zillaid
                                
                                 where fr.zillaid in (
                                     select zilla from region where region_name in (select distinct region_name from region order by region_name)
                                     )) act
                            group by act.region_name");

            //var_dump($region);
            return $region;

        }catch (Exception $e){
        }
    }

    private function load_project_issue(){
        try {

            $start_date = date("Y-m-d 00:00:00");
            $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));

            //$region_name = "'".strtolower($_GET['region'])."'";
            $sql ="select       --act.\"region_name\" \"location_name\", 
                                count(act.title) as \"activity\",
                                count(case when act.category='issue' then 1 end) as \"issue\",
                                count(case when act.category='comment' then 1 end) as \"comment\",
                                count(case when act.status='resolved' and act.category='issue' then 1 end) as \"resolved\",
                                count(case when act.status='postpone' and act.category='issue' then 1 end) as \"postpone\",
                                count(case when now() > act.completion_date and act.category='issue' and act.status='ongoing' then 1 end) as \"expired\",
                                count(case when act.category='issue' and act.completion_date between now() and now()+ '7 days' and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired_seven_days\",
                                count(case when act.category='issue' and act.creation_date between '$start_date' and '$end_date' then 1 end) as \"issue_created_today\"
                                from
                                (select *,i.created_at creation_date from issues i
                                                   inner join facility_registry fr on fr.facilityid = i.facility_id
                                                   --inner join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                                                   --inner join \"region\" r on r.zilla = fr.zillaid
                                 where i.facility_id = 99999
                                     ) act     
                            --group by act.region_name";
            //$sql = "SELECT COUNT(*) FROM issues where facility_id=99999";
            //echo $sql;
            $region = DB::select($sql);

            //var_dump($region);
            return $region;

        }catch (Exception $e){
        }
    }

    public function issue(){
        return view('dashboard/dashboard_issue');
    }

    private function get_region_data($region_name){
        $start_date = date("Y-m-d 00:00:00");
        $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));

        try {

            //$region_name = "'".strtolower($_GET['region'])."'";
            $region = DB::select("
        
                            select act.zillaid \"location\", act.\"ZillaNameEng\" \"location_name\", count(act.id) as \"activity\",
                                   count(case when act.category='issue' then 1 end) as \"issue\",
                                   count(case when act.category='comment' then 1 end) as \"comment\",
                                   count(case when act.status='resolved' then 1 end) as \"resolved\",  
                                   count(case when act.status='postpone' and act.category='issue' then 1 end) as \"postpone\",
                                   count(case when now() > act.completion_date and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired\",
                                   count(case when act.category='issue' and act.completion_date between  now() and now()+ '7 days' and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired_seven_days\",
                                   count(case when act.category='issue' and act.creation_date between '$start_date' and '$end_date' then 1 end) as \"issue_created_today\"
                                   
                            from
                                 
                            (select *,i.created_at creation_date from issues i
                            inner join facility_registry fr on fr.facilityid = i.facility_id
                            inner join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                            where fr.zillaid in (
                                select zilla from region where region_name ='$region_name'
                                )) act
                            
                            group by act.\"ZillaNameEng\",act.zillaid
                        
                        ");



            return $region;

        }catch (Exception $e){

        }
    }

    private function get_region_data_by_zilla($zilla){
        $start_date = date("Y-m-d 00:00:00");
        $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));
        try {


            $region = DB::select("
        
                            select act.upazilaid \"location\", act.\"UpazilaNameEng\" \"location_name\", count(act.id) as \"activity\",
                                   count(case when act.category='issue' then 1 end) as \"issue\",
                                   count(case when act.category='comment' then 1 end) as \"comment\",
                                   count(case when act.status='resolved' then 1 end) as \"resolved\",
                                   count(case when act.status='postpone' and act.category='issue' then 1 end) as \"postpone\",
                                   count(case when now() > act.completion_date and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired\",
                                   count(case when act.completion_date between  now() and now()+ '7 days' and act.category='issue' and act.status ='ongoing' then 1 end) as \"expired_seven_days\",
                                   count(case when act.category='issue' and act.creation_date::date between '$start_date' and '$end_date' then 1 end) as \"issue_created_today\"

                            from
                            
                            
                            (select *,i.created_at creation_date from issues i
                            inner join facility_registry fr on fr.facilityid = i.facility_id
                            --inner join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                            inner join \"Upazila\" u on u.\"ZillaId\" = fr.zillaid and u.\"UpazilaId\" = fr.upazilaid
                            
                            where fr.zillaid in ('$zilla'
                                )) act
                            
                            group by act.\"upazilaid\",act.\"UpazilaNameEng\"
                        
                        ");
            return $region;

        }catch (Exception $e){

        }
    }

    ///DASHBOARD DETAIL CONTROL SECTION

    public function detail(){
        //Issue Type
        //issue = raised, resolved, overdue, overdue7d
        //region = all, region name
        //zilla = id
        //type = pending (ongoing), rso

        if(isset($_GET['issue']) ){


            //if Region is not set. show all region status
            if($_GET['issue']=='overdue'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_overdue_issue();
                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    //this will add zill and upazil id with condition array for sql query
                    $cond = $this->prepare_geo_condition($cond);

                    $issues = $this->get_overdue_issue($cond);
                }
                return view('dashboard/dashboard_issue_detail',['title'=>'Overdue Issue','data'=>$issues]);

            }


            //if Region is not set. show all region status
            if($_GET['issue']=='overdue7d'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_overdue7_issue();

                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    $issues = $this->get_overdue7_issue($cond);
                }

                return view('dashboard/dashboard_issue_detail',['title'=>'Issue Overdue in next 7 days', 'data'=>$issues]);
            }

            //Resolved issue
            if($_GET['issue']=='resolved'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_resolved_issue();

                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    //this will add zill and upazil id with condition array for sql query
                    $cond = $this->prepare_geo_condition($cond);

                    //Get all resolved issue depending on condition
                    $issues = $this->get_resolved_issue($cond);
                }

                return view('dashboard/dashboard_issue_detail',['title'=>'Issue Resolved', 'data'=>$issues]);
            }

            //Raised issue
            if($_GET['issue']=='raised'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_all_issue();

                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    //this will add zill and upazil id with condition array for sql query
                    $cond = $this->prepare_geo_condition($cond);

                    //var_dump($cond);

                    //get all issue form sql depending on condition
                    $issues = $this->get_all_issue($cond);
                }

                return view('dashboard/dashboard_issue_detail',['title'=>'Issue Raised', 'data'=>$issues]);
            }


            //Raised issue today
            if($_GET['issue']=='raised-today'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_all_issue_created_today();

                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    //this will add zill and upazil id with condition array for sql query
                    $cond = $this->prepare_geo_condition($cond);

                    //var_dump($cond);

                    //get all issue form sql depending on condition
                    $issues = $this->get_all_issue_created_today($cond);
                }

                return view('dashboard/dashboard_issue_detail',['title'=>'Issue Raised Today', 'data'=>$issues]);
            }

            //Postpone issue
            if($_GET['issue']=='postpone'){
                if(isset($_GET['region']) && $_GET['region'] == 'all'){
                    $issues = $this->get_all_postpone_issue();

                }
                else if ($_GET['region'] != 'all'){
                    $cond = array(
                        'region' => $_GET['region']
                    );

                    //this will add zill and upazil id with condition array for sql query
                    $cond = $this->prepare_geo_condition($cond);

                    //var_dump($cond);

                    //get all issue form sql depending on condition
                    $issues = $this->get_all_postpone_issue($cond);
                }

                return view('dashboard/dashboard_issue_detail',['title'=>'Postpone Issue', 'data'=>$issues]);
            }

        }



        //showing for comment
        if(isset($_GET['comment']) ){
            if(isset($_GET['region']) && $_GET['region'] == 'all'){
                $comments = $this->get_all_comment();

            }
            else if ($_GET['region'] != 'all'){
                $cond = array(
                    'region' => $_GET['region']
                );

                //this will add zill and upazil id with condition array for sql query
                $cond = $this->prepare_geo_condition($cond);

                $comments = $this->get_all_comment($cond);
            }

            return view('dashboard/dashboard_issue_detail',['title'=>'Comments', 'data'=>$comments]);
        }
    }


    //get overdue issue
    public function get_overdue_issue($cond = null){

        $sql = $this->issue_sql();

        if($cond == null){
            $sql .= " Where  now() > i.completion_date and i.category='issue' and i.status = 'ongoing' ";
        }

        //When region is not set, all region value will return
        if ($cond != null)
        {
            $sql .= $this->prepare_region_zila_upazila_condition($cond);
            $sql .= " and now() > i.completion_date and i.status = 'ongoing' ";
        }

        try {
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }


    //get issue overdue in next 7 days
    public function get_overdue7_issue($cond=null){

        $sql = $this->issue_sql();

        if($cond == null){
            $sql .= " Where  i.completion_date between  now() and now()+ '7 days' and i.category='issue' and i.status = 'ongoing' ";
        }

        //When region is not set, all region value will return
        if ($cond != null)
        {
            $sql .= $this->prepare_region_zila_upazila_condition($cond);
            $sql .= " and i.completion_date between  now() and now()+ '7 days'  and i.status = 'ongoing' ";
        }

        try {
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}

    }

    //get issue resolved
    public function get_resolved_issue($cond = null){

        $sql = $this->issue_sql();

        //When region is not set, all region value will return
        if ($cond == null)
        {
            $sql .= " where i.status = 'resolved'";
        }

        //when region set, it will find zilla from region table and the return only region value
        if($cond['region']!=null){
            $sql .= $this->prepare_region_zila_upazila_condition($cond);
        }


        // $sql .= $this->prepare_region_zila_upazila_condition($cond);
        $sql .= " and i.status = 'resolved' ";

        try {
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }

    //get all issue
    public function get_all_issue($cond = null){

        //Get common select statement
        $sql = $this->issue_sql();

        //When region is not set, all region value will return
        if ($cond == null)
        {
            $sql .= " where i.category='issue' order by i.create_date desc";
        }
        //var_dump($cond);

        //when region set, it will find zilla from region table and the return only region value
        if($cond['region']!=null){
            $sql .= $this->prepare_region_zila_upazila_condition($cond);

            $sql .= " order by i.create_date desc";
        }
        try {
            //echo $sql;
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }


    //get all comment
    public function get_all_comment($cond = null){

        $sql = $this->issue_sql();

        //When region is not set, all region value will return
        if ($cond == null)
        {
            $sql .= " where i.category='comment' order by i.create_date desc";
        }

        //when region set, it will find zilla from region table and the return only region value
        if($cond['region']!=null){
            //$sql .= " where i.category='comment' ";
            //and fr.zillaid in (select zilla from region where region_name = '".$_GET['region']."') order by i.create_date desc";
            $sql .= $this->prepare_region_zila_upazila_condition($cond, 'comment');
        }

        try {
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }


    private function last_login_info(){
        return $region = DB::select("select u.name user_name, count(ll.user_id) lastlogin, z.\"ZillaNameEng\" zilla  from last_login ll
                    left join users u on u.user_id = ll.user_id
                    left join \"Zilla\" z on z.\"ZillaId\" = u.zilla_id
                    where ll.user_id::int != 261111 
                    group by ll.user_id, u.name, z.\"ZillaNameEng\" order by lastlogin desc");


    }

    private function issue_sql(){
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
                            ";
    }

    private function prepare_region_zila_upazila_condition($cond,$category = 'issue'){
        $sql = " where i.category='".$category."'";
        $sql_cond = "";

        //if zilla or upazila is set, it need not to check in region table
        if(isset($cond['zilla']) || isset($cond['upazila'])){
            //if zilla is set to url, it will be added to $sql_cond
            if(isset($cond['zilla'])){
                //var_dump($cond['zilla']);
                $sql_cond .= ' and fr.zillaid::int ='. $cond['zilla'];
            }

            //if upazila is set to url, it will be added to $sql_cond
            if(isset($cond['upazila'])){
                $sql_cond .= ' and fr.upazilaid::int ='. $cond['upazila'];
            }

            //Add GEO condition to existing SQL statement
            $sql .= $sql_cond; // Add zilla upazila filter

        }
        else{
            //If there is no GEO information in URL, all region data will be shown
            $sql .= " and fr.zillaid in (select zilla from region where region_name = '".$_GET['region']."') ";
        }


        return $sql;
    }

    private function prepare_geo_condition($cond){
        //add zilla id if there is zilla in get super global (URL)
        if(isset($_GET['zilla']))
        {
            $cond['zilla'] = $_GET['zilla'];
        }

        //add upazila id if there is upazila in get super global (URL)
        if(isset($_GET['upazila']))
        {
            $cond['upazila'] = $_GET['upazila'];
        }

        return $cond;
    }


    public function my_pending_issue(){

        $notification = new Notification();

        $issues = $notification->my_pending_task_list(Auth::user()->user_id);
        //$issues = $notification->my_pending_task_list(9055);
        //var_dump($issues);
        return view('dashboard/dashboard_issue_detail',['title'=>'My Pending Issue', 'data'=>$issues]);
    }

    public function logindetail(){

        if(isset($_GET['start_date']) || isset($_GET['to_date'])){

            $result = null;

            $sql = "Select ll.user_id user_id, u.name user_name, u.designation designation, count(*) total_login from last_login as ll ";
            $sql .= " Left Join users u using (user_id)";
            $sql .= " WHERE ll.created_at between '".$_GET['from_date']."' AND '".$_GET['to_date']."'";
            $sql .= " GROUP BY ll.user_id, user_name,designation";
            $sql .= " order by u.name asc";

            echo $sql;

            try {
                $result = DB::select($sql);
            }catch (Exception $e)
            {}

            return  $this->create_table($result);
            //$result;

        }

        return view('dashboard/login_detail',['title'=>'Login Detail']);

    }


    private function create_table($data){
        // var_dump($data);
        $html = '';

        foreach ($data as $d){
            $html.= '<tr>
						<td>'.$d->user_id.'</td>
                        <td>'.$d->user_name.'</td>
                        <td>'.$d->designation.'</td>
                        <td>'.$d->total_login.'</td>
					</tr>';
        }


        $html.=				'';

        return $html;
    }


    //get all issue created today May 20, 2021
    public function get_all_issue_created_today($cond = null){

        $start_date = date("Y-m-d 00:00:00");
        $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));

        //Get common select statement
        $sql = $this->issue_sql();

        //When region is not set, all region value will return
        if ($cond == null)
        {
            $sql .= " where i.category='issue' and i.created_at between '$start_date' and '$end_date' order by i.create_date desc";
        }
        //var_dump($cond);

        //when region set, it will find zilla from region table and the return only region value
        if($cond['region']!=null){
            $sql .= $this->prepare_region_zila_upazila_condition($cond);
            $sql .= " and i.created_at between '$start_date' and '$end_date' ";
            $sql .= " order by i.create_date desc";
        }
        try {
            //echo $sql;
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }


    public function get_all_postpone_issue($cond = null){

        $start_date = date("Y-m-d 00:00:00");
        $end_date = date('Y-m-d 00:00:00', strtotime($start_date. ' + 1 days'));

        //Get common select statement
        $sql = $this->issue_sql();

        //When region is not set, all region value will return
        if ($cond == null)
        {
            $sql .= " where i.category='issue' and status='postpone' order by i.create_date desc";
        }
        //var_dump($cond);

        //when region set, it will find zilla from region table and the return only region value
        if($cond['region']!=null){
            $sql .= $this->prepare_region_zila_upazila_condition($cond);
            $sql .= " and and status='postpone' ";
            $sql .= " order by i.create_date desc";
        }
        try {
            //echo $sql;
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}
    }

    private function facility_performance(){

        $data = array(
            'q1' => array(
                'facility_created_issue' => 0,
                'facility_not_created_issue' => 0
            ),

            'q2' => array(
                'facility_created_issue' => 0,
                'facility_not_created_issue' => 0
            ),

            'q3' => array(
                'facility_created_issue' => 0,
                'facility_not_created_issue' => 0
            ),
        );

        function inner($start_date,$end_date){

            //When no region and Zilla are selected
            $inner_sql = "select region from mamoni_regions";

            //when region selected
            if(isset($_GET['region']) && $_GET['region'] != ""){
                $inner_sql = " select zilla from region where region_name = '".$_GET['region']."'";
            }

            //when zilla selected
            if(isset($_GET['zilla']) && $_GET['zilla'] != ""){
                $inner_sql = "'".$_GET['zilla']."'";
            }

            $sql = "select count(case when issues is not null then 1 else null end) as with_issue,
                    count(case when issues is null then 1 else null end) as without_issue
                    from (
                    select facilityid from facility_registry
                    where zillaid in (".$inner_sql.")
                    ) sq left join (
                    select facility_id as facilityid, count(*) issues
                    from issues
                    where created_at::date between '".$start_date."' and '".$end_date."'
                    group by facility_id
                    ) sq2 using(facilityid);";

            if(isset($_GET['dev']) && $_GET['dev']!="")
            {
                echo $sql;
            }

            return $sql;
        }


        //Calculate months from quarter

        //Q1 = Oct, Nov, Dec
        //Q2 = Jan, Feb, Mar
        //Q3 = Apr, May, Jun
        //Q4 = Jul, Aug, Sep

        $month = date("m"); //retun month in number 01,02, ... 12
        //$month =10; // Remove comment for testing

        //echo $month;
        //Q1 = Oct, Nov, Dec
        if($month >=10 && $month <=12){

            //Q1 Oct
            $start_date_m1 = date('Y') . '-10-01'; // October 01 in current year
            $end_date_m1 = date('Y') . '-10-31'; // October 01 in current year
            $month_name_m1 = 'October';

            //Q1 Nov
            $start_date_m2 = date('Y') . '-11-01'; // October 01 in current year
            $end_date_m2 = date('Y') . '-11-30'; // October 01 in current year
            $month_name_m2 = 'November';

            //Q1 Dec
            $start_date_m3 = date('Y') . '-12-01'; // October 01 in current year
            $end_date_m3 = date('Y') . '-12-31'; // October 01 in current year
            $month_name_m3 = 'December';
        }

        //Q2 = Jan, Feb, Mar
        if($month >=1 && $month <=3){

            //Q2 January
            $start_date_m1 = date('Y') . '-01-01'; // October 01 in current year
            $end_date_m1 = date('Y') . '-01-31'; // October 01 in current year
            $month_name_m1 = 'January';

            //Q2 February
            $start_date_m2 = date('Y') . '-02-01'; // October 01 in current year
            $end_date_m2 = date('Y') . '-02-28'; // October 01 in current year
            $month_name_m2 = 'February';

            //Q2 March
            $start_date_m3 = date('Y') . '-12-01'; // October 01 in current year
            $end_date_m3 = date('Y') . '-12-31'; // October 01 in current year
            $month_name_m3 = 'March';
        }

        //Q3 = Apr, May, Jun
        if($month >=4 && $month <=6){

            //Q3 April
            $start_date_m1 = date('Y') . '-04-01'; // October 01 in current year
            $end_date_m1 = date('Y') . '-04-30'; // October 01 in current year
            $month_name_m1 = 'April';

            //Q3 May
            $start_date_m2 = date('Y') . '-05-01'; // October 01 in current year
            $end_date_m2 = date('Y') . '-05-31'; // October 01 in current year
            $month_name_m2 = 'May';

            //Q3 June
            $start_date_m3 = date('Y') . '-06-01'; // October 01 in current year
            $end_date_m3 = date('Y') . '-06-30'; // October 01 in current year
            $month_name_m3 = 'June';
        }

        //Q4 = Jul, Aug, Sep
        if($month >=7 && $month <=9){

            //Q4 July
            $start_date_m1 = date('Y') . '-07-01'; // October 01 in current year
            $end_date_m1 = date('Y') . '-07-31'; // October 01 in current year
            $month_name_m1 = 'July';

            //Q4 August
            $start_date_m2 = date('Y') . '-08-01'; // October 01 in current year
            $end_date_m2 = date('Y') . '-08-31'; // October 01 in current year
            $month_name_m2 = 'August';

            //Q4 September
            $start_date_m3 = date('Y') . '-09-01'; // October 01 in current year
            $end_date_m3 = date('Y') . '-09-30'; // October 01 in current year
            $month_name_m3 = 'September';
        }


        //Month 1
        $result = DB::select(inner($start_date_m1,$end_date_m1 ));

        if(sizeof($result>0)){
            $data['q1']['facility_created_issue'] = $result[0]->with_issue;
            $data['q1']['facility_not_created_issue'] = $result[0]->without_issue;
            $data['q1']['month']=$month_name_m1;
            $data['q1']['start_date']= $start_date_m1;
            $data['q1']['end_date']= $end_date_m1;
        }


        //Month 2
        $result = DB::select(inner($start_date_m2,$end_date_m2 ));

        if(sizeof($result>0)){
            $data['q2']['facility_created_issue'] = $result[0]->with_issue;
            $data['q2']['facility_not_created_issue'] = $result[0]->without_issue;
            $data['q2']['month']=$month_name_m2;
            $data['q2']['start_date']= $start_date_m2;
            $data['q2']['end_date']= $end_date_m2;
        }

        //Month 3
        $result = DB::select(inner($start_date_m3,$end_date_m3 ));

        if(sizeof($result>0)){
            $data['q3']['facility_created_issue'] = $result[0]->with_issue;
            $data['q3']['facility_not_created_issue'] = $result[0]->without_issue;
            $data['q3']['month']=$month_name_m3;
            $data['q3']['start_date']= $start_date_m3;
            $data['q3']['end_date']= $end_date_m3;
        }


        return $data;


    }

    public function issue_search(){
        $sql = $this->issue_sql();

        $sql .= " where i.category='issue' ";
        if(isset($_GET['zillaid']) && $_GET['zillaid']!=-1){

            $zilla = $_GET['zillaid'];

            if($_GET['zillaid']<=9){
                $zilla = "0".$_GET['zillaid'];
            }

            $sql .= " and u.zilla_id ='".$zilla."'";

            if(isset($_GET['upazilaid']) && $_GET['upazilaid']!=""){

                $upazila = $_GET['upazilaid'];

                if($_GET['upazilaid']<=9){
                    $upazila = "0".$_GET['upazilaid'];
                }


                $sql .= " and u.upazilla_id ='".$upazila."'";
            }

            if(isset($_GET['union']) && $_GET['union']!=""){
                $union = $_GET['union'];

                if($_GET['union']<=9){
                    $union = "0".$_GET['union'];
                }

                $sql .= " and un.\"UnionId\" ='".$union."'";
            }
        }

        if(isset($_GET['start_date']) && $_GET['start_date']!="" && isset($_GET['end_date']) && $_GET['end_date']!=""){
            $sql .= " and i.created_at::date between '".$_GET['start_date']."' and '".$_GET['end_date']."'";
        }


        //echo $sql;
        $result = DB::select($sql);

        return view('component/region_view',['data'=>$result]);


    }

    public function goal(){

        $sql = "select facility_id as facilityid, fr.facility_name, z.\"ZillaNameEng\" as zilla, count(case when i.category = 'issue' then 1 end ) as issues,
                       count(case when i.category = 'comment' then 1 end ) as comment
                from issues i
                left join facility_registry fr on fr.facilityid = i.facility_id
                left join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                left join \"Upazila\" u on u.\"ZillaId\" = fr.zillaid and u.\"UpazilaId\" =  fr.upazilaid
                where i.facility_id::int >1 ";

        if(isset($_GET['region']) && $_GET['region']=='all'){
            $sql .= " and fr.zillaid in (select region from mamoni_regions) ";
        }

        if(isset($_GET['region']) && $_GET['region']!='all'){
            $sql .= " and fr.zillaid in (select zilla from region where region_name ='".$_GET['region']."') ";
        }

        if(isset($_GET['zilla']) && $_GET['zilla']!=''){
            $sql .= " and fr.zillaid = '".$_GET['zilla']."' ";
        }

        if(isset($_GET['sdate']) && isset($_GET['edate'])){
            $sql .= " and i.created_at::date between '".$_GET['sdate']."' and '".$_GET['edate']."' ";
        }


        $sql .= " group by i.facility_id, fr.facility_name, zilla order by issues desc;";

        //echo $sql;

        $result = DB::select($sql);

        return view('dashboard/goal_view',['data'=>$result]);
    }

}