<?php

namespace App\Http\Controllers\Api\Cms\Countries;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountriesResource;
use App\Http\Resources\CountryResource;
use App\Models\Country;
use App\Models\DTO\CmsCountryDTO;
use App\Policies\Abilities;
use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;

class CountriesController extends Controller
{

    private $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Country::class);
        $countries = $this->countriesService->getAll();

        return response()->json(new CountriesResource($countries));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize(Abilities::CREATE, Country::class);

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);
        $data = $request->all();
        $data['created_user_id'] = \Auth::id();
        $country = $this->countriesService->storeCountry($data);
        return response()->json(new CountryResource($country));
    }

    /**
     * @param Country $country
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Country $country)
    {
        $this->authorize(Abilities::VIEW, Country::class);

        return response()->json(new CountryResource($country));
    }

    /**
     * @param Request $request
     * @param Country $country
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Country $country)
    {
        $this->authorize(Abilities::UPDATE, $country);
        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);

        try {
            $this->countriesService->updateCountry($country, $request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ok'
            ], 200);
        }
        return response()->json(new CountryResource($country));
    }

}
