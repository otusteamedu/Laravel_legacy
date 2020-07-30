<?php

namespace App\Http\Controllers\Api\Countries\Resources;

use App\Models\Country;
use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CountryResource
 * @package App\Http\Controllers\Api\Countries\Resources
 * @mixin Country
 */
class CountryResource extends JsonResource
{

    private function getCountriesService(): CountriesService
    {
        return app(CountriesService::class);
    }

    /**
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'continent_name' => $this->continent_name,
            'created_user_id' => $this->created_user_id,
        ];

        if ($request->get('withCitiesCount')) {
            $data['cities_count'] = $this->cities()->count();
        }

        return $data;
    }
}
