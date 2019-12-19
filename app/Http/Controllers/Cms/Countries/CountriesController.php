<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Policies\Abilities;
use Gate;
use Auth;
use Log;
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

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
//        $this->authorize(Abilities::CREATE, Country::class);
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
//        $this->authorize(Abilities::CREATE, Country::class);

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);
        $data = $request->all();
        $data['created_user_id'] = Auth::id();
        $this->countriesService->storeCountry($data);

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
        return view('countries.edit', [
            'country' => $country,
        ]);
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
        $this->authorize(Abilities::UPDATE, $country);

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);

        $this->countriesService->updateCountry($country, $request->all());

        return redirect(route('cms.countries.index'));
    }

    /**
     * @param Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {

//        $this->authorize(Abilities::VIEW, $country);

        return view('countries.show', [
            'country' => $country,
            'cities' => $country->cities()->paginate(),
        ]);
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

    /**
     * @return \App\Models\User|null
     */
    private function getCurrentUser()
    {
        return \Auth::user();
    }
}
