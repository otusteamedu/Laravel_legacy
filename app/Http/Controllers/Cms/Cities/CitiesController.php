<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Cms\CmsController;
use App\Models\City;
use App\Services\Countries\CountriesService;
use App\Services\SimpleFoo;
use Illuminate\Http\Request;

class CitiesController extends CmsController
{
    protected $countriesService;
    protected $simpleFoo;

    public function __construct(
        CountriesService $countriesService,
        SimpleFoo $simpleFoo
    )
    {
        $this->countriesService = $countriesService;
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
        //
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
