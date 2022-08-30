<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchProductResource extends JsonResource
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
            if(isset($this->category)){
                $category_data = [
                    'ar_name' => $this->category->ar_name,
                    'ar_detail' => $this->category->ar_detail
                ];
            }else{
                $category_data = [];
            }
            $product_data = [
                'ar_name' => $this->ar_name,
                'ar_description' =>  $this->ar_description,
                'price' =>  $this->price,
                'status' =>  $this->status,
                'category' => $category_data
            ];
            $data = [
                'product' => $product_data
            ];
        }else{
            if(isset($this->category)){
                $category_data = [
                    'en_name' => $this->category->en_name,
                    'en_detail' => $this->category->en_detail
                ];
            }else{
                $category_data = [];
            }
            $product_data = [
                'en_name' => $this->en_name,
                'en_description' =>  $this->en_description,
                'price' =>  $this->price,
                'status' =>  $this->status,
                'category' => $category_data
            ];
            $data = [
                'product' => $product_data
            ];
        }
        return $data;
    }
}
