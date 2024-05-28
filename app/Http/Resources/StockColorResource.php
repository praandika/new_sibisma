<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StockColorResource extends JsonResource
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
            'dealer_name' => $this->dealer_name,
            'address' => $this->address,
            'whatsapp' => $this->phone2,
            'color_name' => $this->color_name,
            'color_code' => $this->color_code
        ];
    }
}
