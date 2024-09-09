<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');


    }

    public function index(){

        //gettign Wearhous list
        $sql = "select * from inv_wearhouse where type = '1' order by name asc ";
        $wearhouse = DB::select($sql);

        //gettign item list
        $sql = "select * from inv_items order by item_name asc";
        $items = DB::select($sql);

        //gettign item list
        $sql = "select * from inv_brands order by brand_name asc";
        $brands = DB::select($sql);

        //gettign item list
        $sql = "select * from inv_suppliers order by supplier_name asc";
        $suppliers = DB::select($sql);


        return view('inventory/stock/stock_view',['wearhouse' => $wearhouse, 'items'=>$items, 'brands'=> $brands, 'suppliers'=>$suppliers]);
    }


    public function addnew(Request $request){
        
        //DB::enableQueryLog();

        //Upsert stock. Item will insert to stock if it is not already stored. 
        //Item ID, Wearhouse ID and wearhouse type should be unique
        //Other wise the system will update the quantity of item

        try{
            $r= DB::table('inv_stock')->upsert([
                
                    'wearhouse_id' => $request->post('wearhouse'),
                    'wearhouse_type' => $request->post('type'),
                    'item_id' => $request->post('itemid'),
                    'description' => $request->post('description'),
                    'quantity' => $request->post('newquantity'),
                    'minimum_stock_level' => $request->post('minstocklevel'),
                    'unit_of_measure' => $request->post('unitofmeasure'),
                    'status' => $request->post('status'),
                    'updated_at' => date("Y-m-d H:i:s")
                
            
            
            ], ['item_id','wearhouse_id','wearhouse_type'], ['quantity'=>DB::raw('inv_stock.quantity + '. $request->post('newquantity') ),'updated_at']);

            //dd(DB::getQueryLog());

        

        // Everytime the stocke will update or insert the stock_meta table will be updated by inserting meta information of item iserted 
            DB::table('inv_stock_meta')->insert([
                'item_id' => $request->post('itemid'),
                'brand_id' => $request->post('brand'),
                'supplier_id' => $request->post('supplier'),
                'bar_code' => $request->post('barcode'),
                'description' => $request->post('description'),
                'quantity' => $request->post('newquantity'),
                'minimum_stock_level' => $request->post('minstocklevel'),
                'batch_number' => $request->post('batchnumber'),
                'lot_number' => $request->post('lotnumber'),
                'order_po_number' => $request->post('ponumber'),
                'exp_date' =>$request->post('expdate'),
                'price' => $request->post('price'),
                'cost_price' => $request->post('costprice'),
                'unit_of_measure' => $request->post('unitofmeasure'),
                'weight' => $request->post('weight'),
                'dimension' =>$request->post('dimension'),
                'status' => $request->post('status'),
                'wearhouse_id' => $request->post('wearhouse'),
                'wearhouse_type' => $request->post('type')
            ]);


            return "success";
        }
        catch(Exception $e){
            return $e;
        }
         

    } 


    public function movein(){

        //gettign Wearhous list
        $sql = "select * from inv_wearhouse where type = '1' order by name asc ";
        $wearhouse = DB::select($sql);

        //gettign DC office list
        $sql = "select * from inv_wearhouse where type = '2' order by name asc ";
        $dcoffice = DB::select($sql);


        return view('inventory/stock/movein_view', ['wearhouse'=>$wearhouse, 'dcoffice'=>$dcoffice]);
    }

    public function getitems(Request $request){


        $wid = $request->get('wearhouseid')==""?0:$request->get('wearhouseid');
        $sql  = "select i.item_name, i.id, s.quantity from inv_items  i";
        $sql .=" left join inv_stock s on s.item_id = i.id";
        $sql .=" where s.wearhouse_id =  " . $wid;
        $dcoffice = DB::select($sql);



       $sql = "select *  from inv_items  i "; 
       $sql .= " left join inv_stock_meta sm on sm.item_id = i.id"; 
       $sql .= " where sm.wearhouse_id = ".$wid." and sm.wearhouse_type = 1 ";

       echo $sql;

       $items = DB::select($sql); 

        $data = [
            "item"=>$dcoffice[0]->item_name,
            "quatity"=>$dcoffice[0]->quantity,
            "detail"=>$items
        ];

        var_dump($items);
        //return $dcoffice;

    }
}
