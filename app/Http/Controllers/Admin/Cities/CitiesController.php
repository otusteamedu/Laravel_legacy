<?php

namespace App\Http\Controllers\Admin\Cities;

use App\Http\Controllers\Admin\Cities\Requests\StoreCityRequest;
use App\Http\Controllers\Admin\Cities\Requests\UpdateCityRequest;
use App\Policies\Abilities;
use App\Services\Countries\CountriesService;
use View;
use App\Models\City;
use App\Services\Cities\CitiesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CitiesController extends Controller
{

    protected $countriesService;
    protected $citiesService;

    public function __construct(
        CountriesService $countriesService,
        CitiesService $citiesService
    )
    {
        $this->countriesService = $countriesService;
        $this->citiesService = $citiesService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('cities.index',[
            'cities' => City::with('country')->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create', [
            'countries' => $this->countriesService->getListCountries(),
        ]);
    }

    /**
     * @param StoreCityRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCityRequest $request)
    {
        $data = $request->getFormData();

        $this->citiesService->storeCity($data);

        return redirect(route('admin.cities.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
//        dd($city);
        return view('cities.edit', [
            'city' => $city,
            'countries' => $this->countriesService->getListCountries(),
        ]);
    }

    /**
     * @param UpdateCityRequest $request
     * @param City $city
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCityRequest $request, City $city)
    {
        $this->citiesService->updateCity($city, $request->all());

        return redirect(route('admin.cities.index'));
    }

    /**
     * @param City $city
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $city)
    {
        return view('cities.show', [
            'city' => $city,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        $this->citiesService->deleteCity($city);

        return redirect(route('admin.cities.index'));
    }
}