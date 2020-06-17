<?php

namespace App\Http\Controllers\Api\Events\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request = null)
    {
        return [
          'id' => $this->id,
          'lat' => $this->lat,
          'long' => $this->long,
          'type_id' => $this->type_id,
          'country_id' => $this->country_id,
          'region' => $this->region,
          'locality' => $this->locality,
          'author_id' => $this->type_id,
          'description' => $this->type_id,
        ];
    }
}
