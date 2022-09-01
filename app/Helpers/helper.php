<?php

use App\Models\Backend\Product;
use App\Models\Backend\Category;

use App\Http\Resources\SearchProductResource;
use App\Http\Resources\SearchCategoryResource;

function search_function($name, $language, $product_name , $category_name, $price, $sort){

    // If Only Product Name Given
    if((isset($product_name) || isset($product_name)) && !isset($category_name)){ 
        $products_data =  Product::with("category")->orderBy($name, $sort);
        if(isset($product_name)){
            $products_data->Where($name, 'like', "%{$product_name}%");
        }
        if(isset($price)){
            $price = explode("-", $price);
            if(isset($price[1])){
                $products_data->whereBetween('price', [$price[0], $price[1] ]);
            }else{
                $products_data->Where('price', $price[0]);
            }
        }
        $data =  $products_data->paginate(10);
    }

    // If Only Category Name Given
    if(!isset($product_name) && isset($category_name)){
        $category_data =  Category::with('products')->Where($name, 'like', "%{$category_name}%")->orderBy($name, $sort);
        $data =  $category_data->paginate(10);
    }

    // If Both Category & Product Name Given
    if((isset($product_name) || isset($product_name)) && isset($category_name)){
        $products_data =  Product::with("category")->orderBy($name, $sort);
        if(isset($product_name)){
            $products_data->Where($name, 'like', "%{$product_name}%");
        }
        if(isset($price)){
            $price = explode("-", $request->price);
            if(isset($price[1])){
                $products_data->whereBetween('price', [$price[0], $price[1] ]);
            }else{
                $products_data->Where('price', $price[0]);
            }
        }
        $product_data->where(function ($query) use ($category_name, $name) {
            $query->whereHas('category', function ($q)  use ($category_name, $name){
                $q->Where($name, 'like', "%{$category_name}%");
            });
        });
        $data =  $product_data->paginate(10);
    }
    return $data;
}


// $product_data =  Product::Where($name, 'like', "%{$product_name}%");