<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Cms\Cities\Requests\StoreCityRequest;
use App\Services\Countries\CountriesService;
use App\Services\Cities\CitiesService;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use View;

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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        View::share([
            'cities' => City::paginate(),
        ]);

        return view('cms.cities.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('cities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = $request->getFormData();
        $this->citiesService->createCity($data);

        return redirect(route('cms.cities.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param City $cityId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $cityId)
    {
        //return view('cms.cities.show', ['city' => City::findOrFail($cityId)]);
        return view('cms.cities.show', [
            'cities' => City::paginate(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(City $city)
    {
        return view('cms.cities.edit', [
            'cities' => $city,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, City $city)
    {
        $this->authorize(Abilities::UPDATE, $city);

        $this->countriesService->updateCountry($city, $request->all());
        $city->update($request->all());

        return redirect(route('cms.cities.index'));
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
