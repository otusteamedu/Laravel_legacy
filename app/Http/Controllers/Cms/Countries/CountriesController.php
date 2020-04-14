<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Http\Controllers\Cms\Countries\Requests\StoreCountryRequest;
use App\Http\Controllers\Cms\Countries\Requests\UpdateCountryRequest;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\Countries\CountriesService;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
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
     * @return Application|Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize('view', [Country::first()]);

        View::share([
            'countries' => Country::paginate(),
        ]);

        return view(config('view.cms.countries.index'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|\Illuminate\View\View
     */
    public function create()
    {
        $this->authorize(Country::first());

        return view(config('view.cms.countries.create'));
    }

    /**
     * @param StoreCountryRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(StoreCountryRequest $request)
    {
        $this->authorize('create', [Country::first()]);

        $data = $request->getFormData();

        try {
            $this->countriesService->storeCountry($data);
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Store country error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.countries.index')));
    }

    /**
     * Display the specified resource.
     *
     * @param Country $country
     * @return Application|Factory|\Illuminate\View\View
     */
    public function show(Country $country)
    {
        $this->authorize('view', [Country::first()]);

        return view(config('view.cms.countries.show'), [
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
        $this->authorize('update', [Country::first()]);

        return view(config('view.cms.countries.edit'), [
            'country' => $country,
        ]);
    }

    /**
     * @param UpdateCountryRequest $request
     * @param Country $country
     * @return RedirectResponse|Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->authorize('update', [Country::first()]);

        try {
            $this->countriesService->updateCountry($country, $request->all());
            $country->update($request->all());
        } catch (\Exception $e) {
            \Log::channel('slack-critical')->critical(__METHOD__ . ': ' . $e->getMessage());
            return response()->json([
                'message' => 'Update country error',
                'errors' => [[$e->getMessage()]],
            ]);
        }

        return redirect(route(config('view.cms.countries.index')));
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
