<?php

namespace App\Http\Controllers\API;

use App\Http\Resources\ProductResource;
use App\Http\Resources\SearchProductResource;
use App\Http\Resources\SearchCategoryResource;
use App\Http\Controllers\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use File;
use Image;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products =  ProductResource::collection(Product::with('category')->paginate(10));
        return $products;
    }

    public function search(Request $request)
    {
        $language = $request->header('Accept-Language');
        $product_name = $request->product_name; 
        $category_name = $request->category_name; 
        $price = $request->price;
        $sort = 'asc';
        if(isset($request->sort)){
          $sort = $request->sort;
        }
        if($language == "ar"){
            $name = 'ar_name';
        }else {
            $name = 'en_name';
        }
        $product_data = search_function($name, $language, $product_name , $category_name, $price, $sort);
        if(!isset($product_name) && isset($category_name)){
            $data = SearchCategoryResource::collection($product_data);
        }else{
            $data = SearchProductResource::collection($product_data);
        }
        return $data;
    }

    public function store(Request $request)
    {
      
    }

    public function show($id)
    {
        $product = new ProductResource(Product::findOrFail($id));
        return $product;
    }

    public function update(Request $request)
    {
      
    }

    public function destroy($id)
    {
       
    }
}
