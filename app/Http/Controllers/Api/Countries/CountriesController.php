<?php

namespace App\Http\Controllers\Api\Countries;

use App\Http\Controllers\Api\Countries\Requests\CountriesListRequest;
use App\Http\Controllers\Api\Countries\Resources\CountriesResource;
use App\Http\Controllers\Api\Countries\Resources\CountryResource;
use App\Http\Controllers\Api\Countries\Resources\CountryWithCitiesCountResource;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;

class CountriesController extends Controller
{


    /**
     * @var CountriesService
     */
    private $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    /**
     * @param CountriesListRequest $request
     * @return CountriesResource
     */
    public function index(CountriesListRequest $request)
    {
        $limit = $request->getLimit();
        $offset = $request->getOffset();
        $countries = $this->countriesService->getAll([], $limit, $offset);

        return new CountriesResource($countries);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Country $country
     * @return CountryWithCitiesCountResource
     */
    public function show(Country $country)
    {
        return new CountryWithCitiesCountResource($country);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
