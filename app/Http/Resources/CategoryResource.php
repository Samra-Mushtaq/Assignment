<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
                'ar_detail' => $this->ar_detail,
            ];
        }else{
            $data = [
                'en_name' => $this->en_name,
                'en_detail' => $this->en_detail,
            ];
        }
        return $data;
    }
}
