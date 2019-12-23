<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Http\Controllers\Cms\Countries\Requests\StoreCountryRequest;
use App\Http\Controllers\Cms\Countries\Requests\UpdateCountryRequest;
use App\Policies\Abilities;
use App\Services\SimpleFoo;
use View;
use App\Models\Country;
use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountriesController extends Controller
{

    protected $countriesService;

    public function __construct(
        CountriesService $countriesService,
        SimpleFoo $simpleFoo
    )
    {
        $simpleFoo->saveFoo();


        $this->countriesService = $countriesService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        View::share([
            'countries' => $this->countriesService->searchCountries(),
        ]);

        return view('countries.index');
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
     * @param StoreCountryRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCountryRequest $request)
    {
        $data = $request->getFormData();

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
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->authorize(Abilities::UPDATE, $country);

        $this->countriesService->updateCountry($country, $request->all());
        $country->update($request->all());

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
}
