<?php

namespace App\Services\Order\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientOrder extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'date' => $this->created_at->format('d.m.Y'),
            'number' => $this->number,
            'user_id' => $this->user_id,
            'items' => json_decode($this->items, true),
            'delivery' => json_decode($this->delivery, true),
            'customer' => json_decode($this->customer, true),
            'price' => $this->price,
            'comment' => $this->comment,
            'status' => $this->statuses->last()
        ];
    }
}
