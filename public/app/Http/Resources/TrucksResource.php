<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrucksResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'brand' => $this->brand,
            'plate' => $this->plate,
            'cars' => $this->cars
        ];
    }
}
