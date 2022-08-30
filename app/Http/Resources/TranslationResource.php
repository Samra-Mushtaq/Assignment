<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TranslationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $text_array = $this->text;
        $en_array = ["title"=> $text_array["title_en"], "description" => $text_array["description_en"]];
        $ar_array = ["title"=> $text_array["title_ar"], "description" => $text_array["description_ar"]];

        return [
            'en' => $en_array,
            'ar' => $ar_array,
        ];
    }
}
