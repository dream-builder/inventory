<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class FocalPersonMailController extends Controller
{
    // Created by Shahed
    //Date: 13.12.2021

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {

        if(isset($_GET['ajax']) && $_GET['ajax']=='true'){

            $focal = $this->get_focalperson_by_geo($_GET['zillaid'],$_GET['upazilaid'],$_GET['unionid']);


            return $focal;

        }

        $alluser=$this->allusers();
        //return Zilla::all();
        return view('focal_mail/index_view',['data'=>$alluser]);
    }

    private function get_focalperson_by_geo($zillaid=0,$upazilaid=0,$unionid=0){

        //$sql = "SELECT user_id,name,email FROM users where  user_id not in('261111', '269753' ) ";
        $sql = "SELECT id,u.user_id, u.name,u.email, region_id, region_name, zillaid, upazilaid, unionid FROM region_mail_group rmg
                left join users u on u.user_id = rmg.user_id where  u.user_id not in('261111', '269753' ) ";

        //Only zilla is set
        if($zillaid>0 && $upazilaid==0 && $unionid ==0){
            $sql .= " and rmg.zillaid = '".$zillaid."'";
            $sql .= " and rmg.upazilaid = '0'";
            $sql .= " and rmg.unionid = '0'";
        }

        //When zilla and Upazila is set
        if($zillaid>0 && $upazilaid>0 && $unionid ==0){
            $sql .= " and rmg.zillaid = '".$zillaid."'";
            $sql .= " and rmg.upazilaid = '".$upazilaid."'";
            $sql .= " and rmg.unionid = '0'";
        }

        //When zilla, Upazila and Union is set
        if($zillaid>0 && $upazilaid>0 && $unionid > 0){
            $sql .= " and rmg.zillaid = '".$zillaid."'";
            $sql .= " and rmg.upazilaid = '".$upazilaid."'";
            $sql .= " and rmg.unionid = '".$unionid."'";
        }

        $sql .= " order by u.name asc";

       // echo $sql;

        $result = DB::select($sql);

        return $result;

    }

    private function allusers(){
        $sql = "SELECT user_id,name,email FROM users where  user_id not in(select user_id from skip_users) order by name asc;";

        $result = DB::select($sql);

        return $result;

    }


    private function get_focal_person(){
        $sql = "SELECT user_id,name,email FROM users where  user_id not in('261111', '269753' ) order by name asc;";

        $result = DB::select($sql);

        return $result;

    }

    public function set_focal_person(){

        $sql="";
        $users = null;

        if(isset($_GET['users'])){
            $users = explode(",",$_GET['users']);

        }

        if(is_array($users)){
            $sql .= "insert  into region_mail_group(region_id, zillaid, user_id, upazilaid, unionid, created_at) values ";

            foreach ($users as $u){
                $sql .= "('0','".$_GET['zillaid']."','".$u."','".$_GET['upazilaid']."','".$_GET['unionid']."',now()),";
            }

            $sql = rtrim($sql,",");

           // echo $sql;
            $result = DB::statement($sql);

            if($result){
                $json = "{
                            \"users\": [".$_GET['users']."],
                            \"status\": \"success\"
                        }";
                return $json;
            }

        }

        return 'failed';

    }

    public function del_focal_person(){

        if(isset($_GET['users']) && !empty($_GET['users'])) {

            $sql = "delete from region_mail_group where user_id::integer in (" . $_GET['users'] . ")  ";
            $sql .= " and zillaid =  '".$_GET['zillaid']."'";
            $sql .= " and upazilaid =  '".$_GET['upazilaid']."'";
            $sql .= " and unionid =  '".$_GET['unionid']."'";

            $result = DB::statement($sql);

            if ($result) {
                $json = "{
                            \"users\": [" . $_GET['users'] . "],
                            \"status\": \"removed\"
                        }";
                return $json;
            }

        }

        return 'failed';

    }

    public function find_user(){
        $sql = "SELECT user_id,name,email FROM users where  user_id not in(select user_id from skip_users) ";

        $sql .= " and name ilike '%". $_GET['find'] ."%' or email ilike '%". $_GET['find']."%' order by name asc";
       // echo  $sql;
        $result = DB::select($sql);

        $row = "";

        if(sizeof($result>0 && is_array($result))){

            foreach ($result as $d){
                $row .= ' <tr>
                            <td><input class="userid-ul" type="checkbox" value="'.$d->user_id.'" name="useridul[]"> </td>
                            <td>'.$d->name.'</td>
                            <td>'.$d->email.'</td>
                        </tr>';
            }

        }
//        //echo $row;
        return $row;

    }
}