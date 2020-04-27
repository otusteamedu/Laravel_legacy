<?php

namespace App\Services\OrderStatus\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusWithPivotDate extends JsonResource
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
            'title' => $this->title,
            'alias' => $this->alias,
            'order' => $this->order,
            'date' => $this->pivot ? $this->pivot->created_at->format('d.m.Y - H:i:s') : null
        ];
    }
}
