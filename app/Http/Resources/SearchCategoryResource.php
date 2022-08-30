<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $language = $request->header('Accept-Language');
        if($language == "ar"){
            $product_data_array = array();
            if(isset($this->products)){
                foreach($this->products as $key=>$product){
                    $product_data = [
                        'ar_name' => $product->ar_name,
                        'ar_description' =>  $product->ar_description,
                        'price' =>  $product->price,
                        'status' =>  $product->status,
                    ];
                    $arraykey = 'product_'.++$key;
                    $product_data_array[$arraykey] = $product_data;
                }
            }
            $category_data = [
                'ar_name' => $this->ar_name,
                'ar_detail' => $this->ar_detail,
                'product' => $product_data_array
            ];
            $data = [
                'category' => $category_data
            ];
        }else{
            $product_data_array = array();
            if(isset($this->products)){
                foreach($this->products as $key=>$product){
                    $product_data = [
                        'en_name' => $product->en_name,
                        'en_description' =>  $product->en_description,
                        'price' =>  $product->price,
                        'status' =>  $product->status,
                    ];
                    $arraykey = 'product_'.++$key;
                    $product_data_array[$arraykey] = $product_data;
                }
            }
            $category_data = [
                'en_name' => $this->en_name,
                'en_detail' => $this->en_detail,
                'product' => $product_data_array
            ];
            $data = [
                'category' => $category_data
            ];
        }
        return $data;
    }
}
