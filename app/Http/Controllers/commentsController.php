<?php

namespace App\Http\Controllers;


use App\EmailQueue;
use App\IssueAction;
use Faker\Provider\File;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Facility;
use App\Zilla;
use App\Union;
use App\Upazila;
use App\Section;
use App\Comment;
use App\Issues;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Mockery\Exception;
use Mail;
use DB;
use Monolog\Handler\ElasticSearchHandler;
use mysql_xdevapi\Statement;
use Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;
use App\Http\Controllers\MailManager;



class commentsController extends Controller
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


    public function index() {

		//return Zilla::all();
        return view('comments/commentsView_tags');
    }
	
	public function get_zilla() {

        $zillaid = $_GET['zillaid']<=9?'0'.$_GET['zillaid']:$_GET['zillaid'];

		return Zilla::select('*')->where('DivId','=',$zillaid)->get();

        //return view('commentsView');
    }

    public function get_users() {

        return DB::select("select user_id,user_id as userid, name,email from users order by name asc");

        //return User::select('*')->get();

        //return view('commentsView');
    }
	
	public function get_upazila() {


		
		$zillaid = strlen($_GET['zillaid'])<2?'0'.$_GET['zillaid']:$_GET['zillaid'];
		//echo $zillaid;
		return Upazila::select('*')->where('ZillaId','=',$zillaid)->get();

		//$sql = "select * from \"Upazila\" where \"ZillaId\" = '".$zillaid."'";
        //echo $sql;
        //return DB::select($sql);

    }

    public function get_unions() {

        //$zillaid = $_GET['zillaid']<10?"0".$_GET['zillaid']:$_GET['zillaid'];
        //$zillaid = $_GET['zillaid']<10?$_GET['zillaid']:$_GET['zillaid'];
        $zillaid = strlen($_GET['zillaid'])<2?'0'.$_GET['zillaid']:$_GET['zillaid'];

        //$upazilaid = $_GET['upazilaid']<10?"0".$_GET['upazilaid']:$_GET['upazilaid'];
        $upazilaid = strlen($_GET['upazilaid'])<2?'0'.$_GET['upazilaid']:$_GET['upazilaid'];

        $sql = "Select * from \"Unions\" WHERE \"ZillaId\"= '$zillaid' AND \"UpazilaId\"= '$upazilaid'";

        try {
            $issue = DB::select($sql);
            return $issue;
        }catch (Exception $e)
        {}

    }
	
	public function get_facility() {
		
		$zillaid = $_GET['zillaid']<10?"0".$_GET['zillaid']:$_GET['zillaid'];
		$upazilaid = $_GET['upazilaid']<10?"0".$_GET['upazilaid']:$_GET['upazilaid'];

		$get = Facility::select('*')
            ->where('zillaid','=',$zillaid)->where('upazilaid','=',$upazilaid)->orderBy('facility_name_eng','asc');

		return $get->get();

        //return view('commentsView');
    }
	
	
	public function get_comments() {
		
		$facility_id = $_GET['facility_id'];

        $sql = "select  s.id, s.facility_id, f.facility_name, s.user_id,u.name as name, s.title, s.details, s.category, 
                s.priority, s.tags, s.create_date, s.completion_date, s.created_at, s.updated_at, s.status, s.resolved, 
                s.child_of, s.assign_to, ua.name as assign_personnel,  s.attachment, status_changed_by
                
        from issues s 
            left join users u on u.user_id = s.user_id
            left join users ua on ua.user_id = s.assign_to
            left join facility_registry  f on f.facilityid = s.facility_id";
            
            //--left join users ac_user on ac_user.user_id = s.status_changed_by::text";

            $slq_facility = $sql ." where  s.facility_id = $facility_id and child_of = 0 order by s.created_at desc";

            //echo $slq_facility;

        $comments= DB::select($slq_facility);

        foreach($comments as $key=>$comment){

           $child_sql = $sql . " where s.facility_id = $facility_id and child_of = $comment->id";

           $child= DB::select($child_sql);

           $comments[$key]->child = $child;
           
        }
        //var_dump ($comments);

        //Get Mail receivers
        $email_receivers = MailManager::email_receivers($facility_id);


        if(isset($_GET['return_type']) && $_GET['return_type'] == 'view'){
            return view('issue/issue_detail_with_child_ajax_view',['comments'=>$comments, 'email_receivers'=> $email_receivers]);
        }
        return $comments;

    }
	
	public function add_comments() {
		
		try{
			$comment = new Issues;
			$comment->facility_id = $_GET['facility_id'];

			$comment->user_id = Auth::id(); //Logged in USer
			$comment->title = $_GET['title'];
			$comment->details = $_GET['detail'];
			$comment->category = $_GET['category'];
			$comment->priority = $_GET['priority'];

            //getting email from hash and tag
            $tags_mail=$this->getting_email_from_hash_tag($comment->details);

            if($tags_mail !=false){
                $tag = implode(",",$tags_mail);
            }
            else{
                $tag = "";
            }


            //exit();

			$comment->tags = $tag;
			$comment->create_date = isset($_GET['create_date'])?$_GET['create_date']:date('Y-d-m');
			$comment->completion_date = isset($_GET['completion_date'])?$_GET['completion_date']: date('Y-m-d');
            $comment->child_of = isset($_GET['child_of'])?$_GET['child_of']:0;
            $comment->assign_to = isset($_GET['assign_to'])?$_GET['assign_to']:0;
            $comment->attachment = isset($_GET['attachment'])?$_GET['attachment']:"";
            $comment->reson_of_visit = isset($_GET['reson_of_visit'])?$_GET['reson_of_visit']:"";

            if(isset($_GET['assign_to']))
            {
                $comment->assign_to = $_GET['assign_to'];
            }
            else
            {
                //$comment->assign_to = '123';
            }
            $comment->status = 'ongoing';
			$comment->save();

	        $last_inserted_issue_id = $comment->id;



	        //add data to mail queue
            $this->add_to_mail_queue($comment);

            //Add assign to mail
            if($comment->title == 'Reply'){
                //$this->send_assing_to_mail($comment);
            }

            //$comment->last_assign_id = $last_inserted_issue_id;



		}
		catch(Exception $e){
			//return redirect('insert')->with('failed',"operation failed");
		}

    }

    private function getting_email_from_hash_tag($txt){

        $email_all = array();


        //Get email from @

        $emails = explode ("@[",$txt);

        //var_dump($emails);
        //cleaning email address by removing extra information
        foreach ($emails as $key=>$val){

            $email = substr($val,0,strpos($val,"]"));
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);

            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($email_all,$email);
            }
        }


        //Getting #Tagged value
        $hash = explode ("#[",$txt);
        //cleaning extra information
        foreach ($hash as $key=>$val){

            $hash = substr($val,0,strpos($val,"]"));

            //Getting Hash email from DB
            $data= DB::select("select * from groups WHERE group_name = '$hash'");

            //var_dump($data);

            if(is_array($data) && sizeof($data)>0){
                foreach ($data as $d){
                    array_push($email_all,$d->email);
                }
            }
        }


        if(sizeof($email_all)>0) {
            return $email_all;
        }
        else{
            return false;
        }

    }



    function addtoMail($issue_id){
           
        try{
            $comments= DB::select("select * from issues s 
                join users u on u.user_id = s.user_id
                where s.id = $issue_id");

            if(sizeof($comments)>0)
          
            {
                $email = new EmailQueue;
                $email->creator_id = $comments[0]->user_id;
                $email->issue_id = $comments[0]->id;
                $email->mail_to = $comments[0]->email;
                $email->cc = '';
                $email->bcc ='';
                $email->mail_subject = '';
                $email->mail_body = $comments[0]->details;
                $email->priority =$comments[0]->priority;
                $email->tags =$comments[0]->tags;
                $email->category =$comments[0]->category;
                $email->status = 'pending';

                $email->save();
                
            }

           
        }
        catch (Exception $e){

        }
    }

    public function update_status()
    {

        try {
            Issues::where('id', $_GET['comment_id'])->where('facility_id', $_GET['facility_id'])
                ->update([
                    'status' => $_GET['status'],
                    'status_changed_by' => Auth::id(),
                    'resolved' => $_GET['resolved']
                ]);

            //Save status to table issue_action
            $status = new IssueAction;
            $status->issue_id = $_GET['comment_id'];
            $status->detail = $_GET['resolved'];
            $status->status = $_GET['status'];
            $status->creator_id = Auth::id();
            $status->save();

         //$this->sendMail($_GET['comment_id']);
        }catch (Exception $e){

        }
    }

    public function update_issue_details()
    {

        try {
            Issues::where('id', $_GET['comment_id'])
                ->update([
                    'details' => $_GET['detail']
                ]);

            //$this->sendMail($_GET['comment_id']);
        }catch (Exception $e){

        }
    }

    public function update_reply_details()
    {

        try {
            Issues::where('id', $_GET['comment_id'])
                ->update([
                    'details' => $_GET['detail']
                ]);

            //$this->sendMail($_GET['comment_id']);
        }catch (Exception $e){

        }
    }

    //This function will return a issue/comment with its child (Reply)
    private function getIssueByID($issue_id){

        $issues= DB::select("select * from issues s 
            join users u on u.user_id = s.user_id
            where s.id = $issue_id and child_of = 0 order by s.created_at desc");

        foreach($issues as $key=>$comment){

            $child= DB::select("select * from issues s 
            join users u on u.user_id = s.user_id
            where child_of = $comment->id");

            $issues[$key]->child = $child;

        }
        return $issues;
    }


    public function issues(){

        //If id has a value, it means it will show the detail of an individual issue/comment with all reply
        if(isset($_GET['id'])){
            $issues=$this->getIssueByID($_GET['id']);
            $data = array(
                'issues' => $issues
            );

            return view('issue/issue_single_view',['data'=>$data]);
        }


        $category = isset($_GET['type'])?$_GET['type']:'NULL';
        //This will show all issues/comments in list


        $issues= DB::select("select 
                                i.id,
                                i.facility_id,
                                i.user_id,
                                i.details,
                                i.category,
                                i.priority,
                                i.tags,
                                i.create_date,
                                i.completion_date,
                                --s.name as assign_to,
                                CASE WHEN i.assign_to is null  THEN '' ELSE s.name END as assign_to,
                                i.status,
                                --case when i.status = 'ongoing' then 'Pending' end \"i.status\",
                                u.name,
                                fr.zillaid,
                                fr.upazilaid,
                                fr.unionid,
                                fr.facility_name,
                                z.\"ZillaNameEng\" as zilla_name,
                                uz.\"UpazilaNameEng\" as upazil_name,
                                un.\"UnionNameEng\" as union_name                         
                                
                                from issues i 
                                left join users u on u.user_id = i.user_id
                                left join users s on s.user_id = i.assign_to
                                left join facility_registry fr on fr.facilityid = i.facility_id
                                left join \"Zilla\" z on z.\"ZillaId\" = fr.zillaid
                                left join \"Upazila\" uz on uz.\"UpazilaId\" = fr.upazilaid and uz.\"ZillaId\" = fr.zillaid
                                left join \"Unions\" un on un.\"ZillaId\" = fr.zillaid and un.\"UpazilaId\" = fr.upazilaid and un.\"UnionId\" = fr.unionid
                                
                                where i.child_of = 0 and i.category='$category'
                                   
                            order by i.create_date desc");


        $data = array(
            'issues' => $issues
        );

        //var_dump($data);

        return view('issue/issue_view',['data'=>$data]);
    }


    //Updated by Fazlu Bhai
    public function issue_details($issue_id) {

        //Checking if the issue is a child or not. it it is a chile system will search for parent and return parent with all detail
        //if not system will return parent only

        $is_child = DB::select("select child_of from issues where  id = $issue_id order by created_at desc");

        //echo "select child_of from issues where  id = $issue_id order by created_at desc";
        //the $is_child result set array will grater than 0 if there is any record. if it is grater than 0, child_of field returns parent id
        //system will set ID to parent id and search for detail issue

        //IF there is no result found 404 will return

        if (sizeof($is_child)<1){
            return view('issue/issue_not_found');
        }


        //IF there are multiple result
        if (sizeof($is_child)>1){
            return view('issue/issue_not_found', ['err'=>'There are some duplication in issue. Please inform this to ATS team.']);
        }

        //there is issue having no child
        if(sizeof($is_child)>0 && $is_child[0]->child_of ==0){
            $id = $issue_id;
        }else
        {
            $id = $is_child[0]->child_of;
        }

        //Processing issue detail
        $sql = "select  s.id, s.facility_id, f.facility_name, s.user_id,u.name, s.title, s.details, s.category, 
                s.priority, s.tags, s.create_date, s.completion_date, s.created_at, s.updated_at, s.status, s.resolved, 
                s.child_of, s.assign_to, ua.name as assign_personnel, s.attachment,
                
                z.\"ZillaNameEng\" || ' [' || f.zillaid || ']' as zillaname,
                uz.\"UpazilaNameEng\" || ' [' || f.upazilaid || ']' as upazilaname ,
                un.\"UnionNameEng\" || ' [' || f.unionid || ']' as unionname,
                ac_user.name as status_changed_by
                
        from issues s 
            join users u on u.user_id = s.user_id
            left join users ua on ua.user_id = s.assign_to
            join facility_registry  f on f.facilityid = s.facility_id
            
            left join \"Zilla\" z on z.\"ZillaId\" = f.zillaid
            left join \"Upazila\" uz on uz.\"ZillaId\" = f.zillaid and uz.\"UpazilaId\" = f.upazilaid
            left join \"Unions\" un on un.\"ZillaId\" = f.zillaid and un.\"UpazilaId\" = f.upazilaid and un.\"UnionId\" = f.unionid
            --left join issue_action ia on ia.issue_id = s.id and ia.status = s.status
            left join users ac_user on ac_user.user_id = s.status_changed_by::text
            
            where  s.id = $id and child_of = 0 order by s.created_at desc";
        //echo $sql;
        $comments= DB::select($sql);

        foreach($comments as $key=>$comment){


            $child= DB::select("select s.id, s.facility_id, s.user_id,u.name, s.title, s.details, s.category, s.priority, s.tags, 
                                    s.create_date, s.completion_date, s.created_at, s.updated_at, s.status, s.resolved, s.child_of,
                                    s.assign_to, s.attachment from issues s 
            join users u on u.user_id = s.user_id
            where  child_of = $comment->id order by created_at desc"  );
            $comments[$key]->child = $child;
        }

        //Get other issue in this facility

        $other_issue= DB::select("
            select 
            s.id as id,
            s.facility_id as facility_id,
            s.user_id as user_id,
            s.title as title,
            s.details as details,
            s.category as category,
            s.priority as priority,
            s.tags as tags,
            s.create_date as created_at,
            s.updated_at as updated_at,
            s.completion_date as completion_date,
            s.status as status,
            s.resolved as resolved,
            s.attachment,
            u.name as name
            
            
            from issues s 
            join users u on u.user_id = s.user_id
            
            
            where  s.facility_id = (select facility_id from issues where id = $id ) and child_of = 0 order by s.created_at desc");


           // var_dump($comments[0]->child);
        if(isset($_GET['ajax']) && $_GET['ajax']==1){
            return view('issue/issue_detail_reply_ajax_view',['comments'=>$comments,'other_issues'=>$other_issue]);
        }

       return view('issue/issue_details_view',['comments'=>$comments,'other_issues'=>$other_issue]);

    }


    public function get_single_issue_by_id(){

        if(isset($_GET['issueid'])) {
            $issue = DB::select("SELECT * FROM issues where id = '" . $_GET['issueid'] . "'");

            $users = DB::select ("Select user_id, name from users order by name asc");

            return view('comments/issue_edit_modal',['issue'=>$issue, 'users'=>$users]);
        }

        return false;
    }

    public function single_issue_update(){
        try {
            Issues::where('id', $_GET['issueid'])
                ->update([
                    'details' => $_GET['detail'],
                    'category' => $_GET['category'],
                    'priority' => $_GET['priority'],
                    'create_date' => $_GET['create_date'],
                    'completion_date' => $_GET['completion_date'],
                    'assign_to' => $_GET['assign_to'],
                    'attachment' => $_GET['attachment']
                ]);

            return "Success";
        }catch (Exception $e){

        }

        return false;
    }

    //Get facility by Facility ID
    public function get_facility_by_id(){

        if(isset($_GET['facilityid'])) {
             $result =  DB::select ("Select * from facility_registry where facilityid = ".$_GET['facilityid']);
             if(sizeof($result)>0){
                 return $result;
             }
             else{
                 return 0;
             }

        }

        return false;
    }

    private function send_assing_to_mail($issue){

       // var_dump($issue);

        $email = new EmailQueue;
        $email->creator_id = $issue['user_id'];
        $email->issue_id = $issue['last_assign_id'];
        $email->mail_to = $this->get_email_by_id($issue['assign_to']);
        $email->cc = '';
        $email->bcc ='';
        $email->mail_subject = 'ATS - Assign New Issue';
        $email->mail_body = 'Dear, ';
        $email->priority =$issue['priority'];
        $email->tags = $issue['tags'];
        $email->category =$issue['category'];
        $email->status = 'pending';
        $email->template = 'assign';

        //var_dump($email);

        //$email->save();
    }

    private function get_email_by_id($id){

        $sql = "Select email from users where user_id = '".$id."'";
        $result =  DB::select ($sql);

        echo $sql;
        if(sizeof($result)>0){

           if(isset($result[0]->email)){

               return $result[0]->email;
           }

        }
        else{
            return '';
        }
    }

    private function get_issue_title_by_id($issueid){
        $sql = "SELECT * FROM issues WHERE id = $issueid";
        $result =  DB::select ($sql);

        if(sizeof($result>0)){
            return $result[0]->title;
        }

    }

    private function add_to_mail_queue(Issues $comment)
    {
        //After creating issu/comment following information will store in email table. Another script will run and in cron and send the email
        //From background process. While sending the email, background process will update stats of email table after sending email

        $email = new EmailQueue;
        $email->creator_id = Auth::id();
        $email->issue_id = $comment->id;
        $email->mail_to = Auth::user()->email;
        $email->mail_to .= "," . $this->assign_to_email($comment->assign_to);
        $email->cc = '';
        $email->bcc ='';
        $email->mail_body = $comment->details;
        $email->priority =$comment->priority;
        $email->tags = $comment->tags;
        $email->category =$comment->category;
        $email->status = 'pending';
        $email->template = 'new-issue-comment';


        //IF IT IS A REPLY MAIL OF PREVIOUS ISSUE/COMMENT IT WILL GET TITLE FROM PARENT ISSUE
        if($comment->title=='Reply'){
            $email->mail_subject = 'RE: '. $this->get_issue_title_by_id($comment->child_of);
            $email->mail_to .= "," . $this->get_creator_email($comment->child_of); // Concate new email with previous separated by comma (email,email,email)
            $email->mail_to .= "," . $this->assign_to_email_by_child_id($comment->child_of);
        }
        else{
            $email->mail_subject = $comment->title;
        }

        //Region focal email
        $email->mail_to .= "," . $this->get_region_email($comment->facility_id);
       // echo $email->mail_to;

        $email->save();
    }

    private function get_creator_email($id){
        $sql = "SELECT u.email FROM users u
                left join issues i on i.user_id = u.user_id
                WHERE i.id =" . $id;

        $result =  DB::select ($sql);

        if(sizeof($result>0)){
            return $result[0]->email;
        }
    }

    private function assign_to_email($assign_to){

        if ($assign_to == "" )
        {
            return "";
        }

        $sql = "SELECT u.email FROM users u 
                WHERE u.user_id ='" . $assign_to ."'";
        echo $sql;
        $result =  DB::select ($sql);

        if(sizeof($result>0)){
            return $result[0]->email;
        }
    }


    private function assign_to_email_by_child_id($child_of){

        if ($child_of == "" )
        {
            return "";
        }

        $sql = "SELECT u.email FROM users u
                    left join issues i on i.assign_to = u.user_id
                    WHERE i.id ='" . $child_of ."'";
        //echo $sql;
        $result =  DB::select ($sql);

        if(sizeof($result>0)){
            return $result[0]->email;
        }
    }

    private function get_region_email ($facilty_id){
        $sql = "select u.email from region_mail_group rmg
                        left join users u on u.user_id = rmg.user_id
                    where zillaid in (
                        select zilla from region where region_name = (select region_name from region
                        where zilla =
                                   (
                                       select zillaid from facility_registry where  facilityid = $facilty_id
                                       )
                                   )
                    )";
        //echo $sql;
        $result =  DB::select ($sql);

        //var_dump($result);

        $email_array = array();

        if(sizeof($result>0) && is_array($result)){

            foreach ($result as $r){
                array_push($email_array,$r->email);
            }

            $result =  implode(",",$email_array);

            return $result;
        }

        return "";
    }

}