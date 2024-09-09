<?php


namespace App\Http\Controllers;
use DB;

class FacilityRegistrationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        //Facility Type
        $sql = "SELECT * FROM facility_type order by short_code";
        $facility_type= DB::select($sql);

        //get Zilla
        $zilla = DB::select("select * from \"Zilla\" order by \"ZillaNameEng\"");
        $div = DB::select("select * from \"Division\" order by \"division\"");
        return view('facility/register_facility', ['zilla'=>$zilla, 'facility_type'=>$facility_type, 'division' => $div]);
    }

    public function facility_edit(){


        if(isset($_GET['id'])){
            $sql = "select * from facility_registry where facilityid=".$_GET['id'];
            $facility = DB::select($sql);

            $zilla = DB::select("select * from \"Zilla\" order by \"ZillaNameEng\"");

            //Upazila
            $upazila = DB::select("select * from \"Upazila\" where \"ZillaId\"::integer =". $facility[0]->zillaid." order by \"UpazilaNameEng\"");

            //Union
            $unions = DB::select("select * from \"Unions\" where \"ZillaId\"::integer =". $facility[0]->zillaid.
                                        " and \"UpazilaId\"::integer  = " .$facility[0]->upazilaid."   order by \"UnionNameEng\"");

            $facility_type = DB::select('select * from facility_type order by type  asc');

        }



        return view('facility/edit_delete_facility',['facility'=>$facility,'zilla'=>$zilla, 'upazila'=>$upazila, 'unions'=>$unions, 'facility_type'=>$facility_type]);
    }

    public function facility_update(){


        if(!isset($_GET['facility_data'])){
            return false;
        }

        $data = $_GET['facility_data'];

        var_dump($data);
        $sql = "UPDATE facility_registry SET ";
        $sql .= "zillaid = '".$data['zillaid'] . "',";
        $sql .= "upazilaid = '".$data['upazilaid']. "',";
        $sql .= "unionid = '".$data['unionid']. "',";
        $sql .= "facilityid = ".$data['facilityid']. ",";
        $sql .= "facility_type_id = ".$data['facility_type']. ",";
        $sql .= "facility_owner = '".$data['facility_owner']. "',";
        $sql .= "lat = '".$data['lat']. "',";
        $sql .= "lon = '".$data['lon']. "',";
        $sql .= "facility_name = '".$data['facility_name']. "',";
        $sql .= "facility_name_eng = '".$data['facility_name_eng'] ."'";
        $sql .= " Where facilityid = ".$data['facilityid'];

        echo $sql;

        $update=DB::statement($sql);
        var_dump($update);

    }


    public function facility_delete(){
        $sql = "delete from facility_registry where facilityid = " . $_GET['facility_id'];
        $del=DB::statement($sql);

    }


}