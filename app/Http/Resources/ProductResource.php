<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        $category_array = array();
        if($language == "ar"){
            if(isset($this->category)){
                foreach($this->category as $key=>$category){
                    $category_data = [
                        'ar_name' => $category->ar_name,
                        'ar_detail' =>  $category->ar_detail,
                    ];
                    $arraykey = 'Category_'.++$key;
                    $category_array[$arraykey] = $category_data;
                }
            }
            $data = [
                'ar_name' => $this->ar_name,
                'ar_description' => $this->ar_description,
                'category' => $category_array,
                'status' =>  $this->status,
                'price' =>  $this->price,
    
            ];
        }else{
            if(isset($this->category)){
                foreach($this->category as $key=>$category){
                    $category_data = [
                        'en_name' => $category->en_name,
                        'en_detail' =>  $category->en_detail,
                    ];
                    $arraykey = 'Category_'.++$key;
                    $category_array[$arraykey] = $category_data;
                }
            }
            $data = [
                'en_name' => $this->en_name,
                'en_description' => $this->en_description,
                'category' => $category_array,
                'status' =>  $this->status,
                'price' =>  $this->price,
    
            ];
        }
        return $data;
    }
}
