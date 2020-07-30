<?php
/**
 * Description of CountriesResource.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\Api\Countries\Resources;


use App\Http\Controllers\Api\Countries\Requests\CountriesListRequest;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CountriesResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  CountriesListRequest  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => CountryResource::collection($this),
            'count' => $this->count(),
            'limit' => (int) $request->get('limit', CountriesListRequest::MAX_PER_PAGE),
        ];
    }
}
