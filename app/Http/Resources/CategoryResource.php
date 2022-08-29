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
        return [
            'en_name' => $this->en_name,
            'ar_name' => $this->ar_name,
            'en_detail' => $this->en_detail,
            'ar_detail' => $this->ar_detail,
        ];
    }
}
