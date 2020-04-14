<?php

namespace App\Http\Controllers\Cms\Cities;

use App\Http\Controllers\Cms\Cities\Requests\StoreCityRequest;
use App\Models\Country;
use App\Services\Cities\CitiesService;
use App\Services\Countries\CountriesService;
use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
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
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', [City::first()]);

        View::share([
            'cities' => City::paginate(),
        ]);

        return view(config('view.cms.cities.index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize(City::first());

        $countries = Country::all();

        return view(config('view.cms.cities.create'), [
            'countries' => $countries,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCityRequest $request
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(StoreCityRequest $request)
    {
        $this->authorize('create', [City::first()]);

        $data = $request->getFormData();

        try{
            $this->citiesService->storeCity($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store city error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.cities.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param City $cityId
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(City $cityId)
    {
        $this->authorize('view', [City::first()]);

        return view(config('view.cms.cities.show'), [
            'cities' => City::paginate(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\City  $city
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(City $city)
    {
        $this->authorize('update', [City::first()]);

        $country = Country::where('id', $city->country_id);

        return view(config('view.cms.countries.edit'), [
            'cities' => $city,
            'country' => $country,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\City  $city
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, City $city)
    {
        $this->authorize('update', [City::first()]);

        try {
            $this->countriesService->updateCountry($city, $request->all());
            $city->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update city error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.cities.index')));
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
