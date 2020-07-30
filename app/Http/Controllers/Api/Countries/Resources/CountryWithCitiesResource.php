<?php

namespace App\Http\Controllers\Api\Countries\Resources;

class CountryWithCitiesResource extends CountryResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = parent::toArray($request);

        $cities = $this->cities;
        $citiesData = [];
        foreach ($cities as $city) {
            $citiesData[] = $city->toArray();
        }
        $data['cities'] = $citiesData;

        return $data;
    }
}
