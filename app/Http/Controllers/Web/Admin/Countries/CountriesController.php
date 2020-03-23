<?php

namespace App\Http\Controllers\Web\Admin\Countries;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Users\Requests\StoreCountryRequest;
use App\Models\Country;
use App\Policies\Abilities;
use Illuminate\Http\Request;

/**
 * Class CountriesController
 * @package App\Http\Controllers\Web\Admin\Countries
 */
class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Abilities::VIEW_ANY, Country::class);

        return view('admin.countries.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Country::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCountryRequest $request
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreCountryRequest $request)
    {
        $this->authorize(Abilities::CREATE, Country::class);
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Country $country)
    {
        $this->authorize(Abilities::VIEW, Country::class);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Country $country
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Country $country)
    {
        $this->authorize(Abilities::UPDATE, Country::class);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Country $country
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Country $country)
    {
        $this->authorize(Abilities::UPDATE, Country::class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Country $country
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Country $country)
    {
        $this->authorize(Abilities::DELETE, Country::class);
    }
}
