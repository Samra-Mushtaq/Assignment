<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Product;
use App\Models\User;

use DataTables;

class CalenderController extends Controller
{

    public function userdata(Request $request) {
        $date = date('Y-m-d');
        if($request->start != 0){
            $user = User::whereDate('created_at',  $request->start); 
            // dd($user);
           
        }else{
            $user = User::whereDate('created_at',  $date);
        } 
        return Datatables::of($user)
            ->addIndexColumn()->make(true);
    }

    public function productdata(Request $request) {
        $date = date('Y-m-d');
        if($request->start != 0){
            $product = Product::whereDate('created_at',  $request->start); 
           
        }else{
            $product = Product::whereDate('created_at',  $date);
        } 
        return Datatables::of($product)
            ->addColumn('category', function ($record) {
                $category_data = "";
                foreach($record->category as $key=>$category){
                    $category_data .= $category->en_name . " | ". $category->ar_name . " , ";
                }
                $category_data = substr_replace($category_data ,"", -2);
                return $category_data;
            })
            ->rawColumns(['category'])
            ->addIndexColumn()->make(true);
    }
}
