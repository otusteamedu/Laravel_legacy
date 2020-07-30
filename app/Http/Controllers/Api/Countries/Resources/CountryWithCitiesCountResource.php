<?php

namespace App\Http\Controllers\Api\Countries\Resources;

class CountryWithCitiesCountResource extends CountryResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);
        $data['cities_count'] = $this->cities()->count();

        return $data;
    }
}
