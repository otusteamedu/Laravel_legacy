<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Cms\Cities\Requests\StoreCityRequest;
use App\Models\City;
use App\Services\Cities\CitiesService;
use App\Services\Countries\CountriesService;
use App\Services\SimpleFoo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CitiesController extends Controller
{
    protected $countriesService;
    protected $citiesService;
    protected $simpleFoo;

    public function __construct(
        CountriesService $countriesService,
        CitiesService $citiesService,
        SimpleFoo $simpleFoo
    )
    {
        $this->countriesService = $countriesService;
        $this->citiesService = $citiesService;
        $this->simpleFoo = $simpleFoo;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->simpleFoo->saveFoo();

        return view('countries.index', [
            'countries' => $this->countriesService->searchCountries(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * @param StoreCityRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCityRequest $request)
    {
        $data = $request->getFormData();
        $this->citiesService->createCity($data);

        return redirect(route('cms.cities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy(City $city)
    {
        //
    }
}
