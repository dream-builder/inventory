<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CenterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){
        return view('inventory/center/center_view');
    }


    public function addnew(Request $request){

        // Prepare POST data
       
        DB::table('inv_center')->insert([
            'center_name' => $request->post('name'),
            'contact_person' => $request->post('contact_person'),
            'email' => $request->post('email'),
            'zilla' => $request->post('district'),
            'upazila' => $request->post('upazila'),
            'union' => $request->post('union'),
            'village' => $request->post('village'),
            'address' => $request->post('address'),
            'phone' => $request->post('phone'),
            'lat' => $request->post('lat'),
            'lon' => $request->post('lon')
        ]);
         

    } 
}
