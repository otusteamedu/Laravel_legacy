<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Models\Country;
use App\Services\Countries\CountriesService;
use App\Services\SimpleBar;
use App\Services\SimpleFoo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CountriesController extends Controller
{

    protected $countriesService;
    protected $simpleFoo;
    protected $simpleBar;

    public function __construct(
        CountriesService $countriesService,
        SimpleFoo $simpleFoo,
        SimpleBar $simpleBar
    )
    {
        $this->simpleFoo = $simpleFoo;
        $this->simpleBar = $simpleBar;
        $this->countriesService = $countriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->simpleFoo->saveFoo();

//        $this->simpleBar->getAppName();
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
        return view('countries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->beforeSave();

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent' => 'required|max:20'
        ]);

        $this->countriesService->storeCountry($request->all());

        return redirect(route('cms.countries.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
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
