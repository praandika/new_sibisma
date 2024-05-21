<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SparepartResource extends JsonResource
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
            'id' => $this->id,
            'parts_name' => $this->parts_name,
            'price' => $this->price,
            'image' => $this->image,
        ];
    }
}
