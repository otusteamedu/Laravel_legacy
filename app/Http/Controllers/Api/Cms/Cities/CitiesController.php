<?php

namespace App\Http\Controllers\Api\Cms\Cities;

use App\Http\Controllers\Controller;
use App\Http\Resources\CountriesResource;
use App\Http\Resources\CountryResource;
use App\Models\City;
use App\Policies\Abilities;
use App\Services\Cities\CitiesService;
use Illuminate\Http\Request;

class CitiesController extends Controller
{

    /** @var CitiesService */
    private $citiesService;

    public function __construct(
        CitiesService $citiesService
    )
    {
        $this->citiesService = $citiesService;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, City::class);
        $countries = $this->citiesService->getAll();

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
        $this->authorize(Abilities::CREATE, City::class);

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);
        $data = $request->all();
        $data['created_user_id'] = \Auth::id();
        $country = $this->citiesService->storeCity($data);
        return response()->json(new CountryResource($country));
    }

    /**
     * @param City $city
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(City $city)
    {
        $this->authorize(Abilities::VIEW, City::class);

        return response()->json(new CountryResource($city));
    }

    /**
     * @param Request $request
     * @param City $country
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, City $country)
    {
        $this->authorize(Abilities::UPDATE, $country);
        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);

        try {
            $this->citiesService->updateCity($country, $request->all());
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ok'
            ], 200);
        }
        return response()->json(new CountryResource($country));
    }

}
