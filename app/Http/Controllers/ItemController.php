<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){

        $sql = "select * from inv_category order by category_name asc";
        $category = DB::select($sql);

        return view('inventory/items/item_view',['category'=>$category]);
    }


    public function addnew(Request $request){

        // Prepare POST data
       
        DB::table('inv_items')->insert([
            'item_name' => $request->post('name'),
            'category' => $request->post('cat'),
            'sku' => $request->post('sku'),
            'description' => $request->post('description'),
            'exp_date' => $request->post('expdate'),
            
        ]);
         

    } 
}
