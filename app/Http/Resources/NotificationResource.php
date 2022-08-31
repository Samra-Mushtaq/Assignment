<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
        $text_array  = $this->data;
        if($language == "ar"){
            $data = [
                'title' => $text_array["title_ar"],
                'description' => $text_array["description_ar"],
            ];
        }else{
            $data = [
                'title' => $text_array["title_en"],
                'description' => $text_array["description_en"],
            ];
        }
        return $data;
    }
}
