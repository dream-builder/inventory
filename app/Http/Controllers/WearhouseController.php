<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WearhouseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){
        return view('inventory/wearhouse/wearhouse_view');
    }


    public function addnew(Request $request){

        // Prepare POST data
        var_dump($request->post('name'));


        DB::table('inv_wearhouse')->insert([
            'name' => $request->post('name'),
            'type' => $request->post('type'),
            'contact_person' => $request->post('contact_person'),
            'contact_email' => $request->post('email'),
            'division' => $request->post('division'),
            'district' => $request->post('district'),
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
