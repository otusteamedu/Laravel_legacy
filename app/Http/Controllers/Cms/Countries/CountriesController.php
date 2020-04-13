<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Http\Controllers\Cms\Countries\Requests\StoreCountryRequest;
use App\Http\Controllers\Cms\Countries\Requests\UpdateCountryRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\Countries\CountriesService;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Gate;
use View;

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
     * @param Request $request
     * @return Application|Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        View::share([
            'countries' => Country::paginate(),
        ]);

        return view('cms.countries.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function create()
    {
        if (Gate::allows('create-country')) {
            return view('cms.countries.create');
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * @param StoreCountryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreCountryRequest $request)
    {
        $data = $request->getFormData();

        $this->countriesService->storeCountry($data);

        return redirect(route('cms.countries.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {
        return view('cms.countries.show', [
            'country' => $country,
            'cities' => $country->cities()->paginate(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Country $country
     * @return Application|Factory|\Illuminate\View\View
     */
    public function edit(Country $country)
    {
        if (Gate::allows('update-country')) {
            return view('cms.countries.edit', [
                'country' => $country,
            ]);
        }else{
            return view('errors.not-allowed');
        }
    }

    /**
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return RedirectResponse|Redirector
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
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
