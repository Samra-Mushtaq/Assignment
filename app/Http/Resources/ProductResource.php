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
        if($language == "ar"){
            $data = [
                'ar_name' => $this->ar_name,
                'ar_description' => $this->ar_description,
                'category' => $this->category->ar_name,
                'status' =>  $this->status,
                'price' =>  $this->price,
    
            ];
        }else{
            $data = [
                'en_name' => $this->en_name,
                'en_description' => $this->en_description,
                'category' => $this->category->en_name,
                'status' =>  $this->status,
                'price' =>  $this->price,
    
            ];
        }
        return $data;
    }
}
