<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class OrganizationController extends Controller
{
    //

    public function profile(){

        if(isset($_GET['id'])){
            $sql = "SELECT *  FROM facility_registry where facilityid = " . $_GET['id'];
            $profile = DB::select($sql);
        }

        var_dump($profile);
        
        

        return view('facility/profile', ['profile'=>$profile[0]]);



    }
}
