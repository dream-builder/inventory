<?php

namespace App\Http\Controllers;
use App\Facility;
use Mockery\Exception;
use Symfony\Component\HttpFoundation\Request;
use DB;

class APIController extends Controller
{
    public function add_facility(Request $request){

        
        //Checking Token
        if ($request->input('token') == 'e040cb79944b0c6e6da7862ea2266243'){

            //echo "autorized";
            //check json validity

            //SAMPLE JSON
            //            $facility_json= '{
            //                "zillaid":"12",
            //                "upazilaid":"123",
            //                "unionid":"123",
            //                "facilityid":123,
            //                "facility_type":"UH&FWC",
            //                "lat":"lat",
            //                "lon":"lon",
            //                "facility_name":"FA Name",
            //                "facility_name_eng":"eng_name"
            //            }';

            ///var_dump($request->input('data'));
            //return ;

            if($this->isJson($request->input('data'))){
                 echo $this->save_facility($request->input('data'));
            }

        }
        else{
            echo "You are not authorized";
            return '';
        }
        //Checking if the facility exists

    }

    private function save_facility($facility_json){


       $facility_json = json_decode($facility_json,true);

       $sql = "select max (facilityid) from facility_registry";
       $result = DB::select($sql);

       //Facility::insert($facility_json);

        try {
            $facility = new Facility;

            $facility->zillaid = $facility_json['zillaid'];
            $facility->upazilaid = $facility_json['upazilaid'];
            //$facility->unionid = $facility_json['unionid'];
            $facility->facilityid = $result[0]->max+1;
            
            $facility->contact_person = $facility_json['contact_person'];
            $facility->designation = $facility_json['designation'];
            $facility->facility_address = $facility_json['facility_address'];
            $facility->facility_email = $facility_json['facility_email'];
            $facility->facility_mobile = $facility_json['facility_mobile'];
            $facility->facility_name = $facility_json['facility_name'];
            $facility->facility_name_eng = $facility_json['facility_name_eng'];
            $facility->facility_owner = $facility_json['facility_owner'];
            $facility->facility_reg_no = $facility_json['facility_reg_no'];
            $facility->reg_year = $facility_json['facility_reg_year'];
            $facility->facility_type_id = $facility_json['facility_type_id'];
            $facility->female_worker =(int) $facility_json['female_worker'];
            $facility->lat = $facility_json['lat'];
            $facility->lon = $facility_json['lon'];
            $facility->male_worker = (int)$facility_json['male_worker'];
            

            $facility->save();

            return "success";

        }catch (Exception $e){

        }
    }

    private function isJson($string) {
        json_decode($string);
        return (json_last_error() == JSON_ERROR_NONE);
    }

    public function facility_suggestion (Request $request){
        $query = $request->input('query');
        
        // Replace with your model and search logic
        //$results = Facility::where('facility_name', 'LIKE', "%{$query}%")->pluck('facility_name');
        
        $sql = "select facility_name from facility_registry where facility_name like '%" .$query ."%'" ;

        //echo $sql;
        $result = DB::select($sql);
        //var_dump(json_encode($result));
        return response()->json($result);
    }

    public function  facility_id_check (Request $request){
        $query = $request->input('query');
        
        // Replace with your model and search logic
        //$results = Facility::where('facility_name', 'LIKE', "%{$query}%")->pluck('facility_name');
        
        $sql = "select facility_reg_no, facility_name from facility_registry where facility_reg_no = '" .$query ."'" ;

        //echo $sql;
        $result = DB::select($sql);
        
        if( !count ($result) >0 ){
            return false;
        }
        
        //var_dump(json_encode($result));
        return response()->json($result);
    }
   
}