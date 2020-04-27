<?php

namespace App\Services\Order\Resources;

use App\Services\OrderStatus\Resources\OrderStatusWithPivotDate;
use Illuminate\Http\Resources\Json\JsonResource;

class CmsOrder extends JsonResource
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
            'id' => $this->id,
            'number' => $this->number,
            'user' => $this->user,
            'items' => json_decode($this->items, true),
            'delivery' => json_decode($this->delivery, true),
            'customer' => json_decode($this->customer, true),
            'price' => $this->price,
            'statuses' => OrderStatusWithPivotDate::collection($this->statuses),
            'date' => $this->created_at->format('d.m.Y - H:i:s')
        ];
    }
}
