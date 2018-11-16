<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;
class Product extends Controller{


    public function index(){

         $allData = Storage::get('product_data.json');
         $data = json_decode($allData);
        return view('welcome', compact('data'));
    }

    public function store(Request $request){
        try {
           
            $product_data = Storage::disk('local')->exists('product_data.json') ? json_decode(Storage::disk('local')->get('product_data.json')) : [];
        
            $data = $request->only(['product_name', 'stock', 'price','created_at']);
           
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['id'] = sizeof($product_data)+1;
 
            array_push($product_data,$data);
    
            Storage::disk('local')->put('product_data.json', json_encode($product_data));
            
            return $data;

        } catch(Exception $e) {
 
            return ['sorry' => true, 'message' => $e->getMessage()];
 
        }
        
    }
}
