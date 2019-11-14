<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CountryResource extends JsonResource
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
            'name' => $this->name,
            'continent_name' => $this->continent_name,
            'created_user_id' => $this->created_user_id,
            'cities' => new CitiesResource($this->whenLoaded('cities')),
        ];
    }
}
