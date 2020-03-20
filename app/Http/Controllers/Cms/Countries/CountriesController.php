<?php

namespace App\Http\Controllers\Cms\Countries;

use App\Helpers\RouteBuilder;
use App\Http\Controllers\Cms\CmsController;
use App\Policies\Abilities;
use Auth;
use Cache;
use Illuminate\Auth\Access\AuthorizationException;
use App\Models\Country;
use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;

class CountriesController extends CmsController
{

    protected $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function index(Request $request)
    {
        $key = $request->user()->id . '|' . $request->getUri();
        return Cache::remember($key, 60, function () {
            $this->authorize(Abilities::VIEW_ANY, Country::class);

            $countries = $this->countriesService->searchCachedCountriesWithCities();
            return view('countries.index', [
                'countries' => $countries,
            ])->render();
        });
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Country::class);
        return view('countries.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->authorize(Abilities::CREATE, Country::class);

        $lockKey = 'create-country';
        $lock = Cache::lock($lockKey, 5);
        if ($lock->get()) {
            $this->validate($request, [
                'name' => 'required|unique:countries,name|max:100',
                'continent_name' => 'required|max:20'
            ]);
            $data = $request->all();
            $data['created_user_id'] = Auth::id();
            $country = $this->countriesService->storeCountry($data);
            $lock->release();
            return response()->json($country, 201);
        }
        abort(422);
    }

    /**
     * @param Country $country
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws AuthorizationException
     */
    public function edit(Country $country)
    {
        $this->authorize(Abilities::UPDATE, $country);

        return view('countries.edit', [
            'country' => $country,
        ]);
    }

    /**
     * @param Request $request
     * @param Country $country
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Country $country)
    {
        $this->authorize(Abilities::UPDATE, $country);

        $this->validate($request, [
            'name' => 'required|unique:countries,name|max:100',
            'continent_name' => 'required|max:20'
        ]);

        $this->countriesService->updateCountry($country, $request->all());
        return redirect(RouteBuilder::localeRoute('cms.countries.index'));
    }

    /**
     * @param Request $request
     * @param Country $country
     * @return array|string
     * @throws AuthorizationException
     * @throws \Throwable
     */
    public function show(Request $request, Country $country)
    {
        $this->authorize(Abilities::VIEW, $country);

        $cities = $country->cities()
            ->paginate();

        $view = view('countries.show', [
            'country' => $country,
            'cities' => $cities,
        ])->render();

        return $view;
    }
}
