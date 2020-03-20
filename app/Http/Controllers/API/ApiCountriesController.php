<?php
/**
 * Description of ApiCountriesController.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Controllers\API;


use App\Services\Countries\CountriesService;
use Illuminate\Http\Request;

class ApiCountriesController
{
    const DEFAULT_LIMIT = 100;

    private $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    public function list(Request $request)
    {
        $limit = $request->get('limit', self::DEFAULT_LIMIT);
        $offset = $request->get('offset', 0);

        $countries = $this->countriesService->searchCountriesWithCities();

        return response()->json($countries);
    }

    public function show(Request $request, int $country_id)
    {
        $country = $this->countriesService->findCountryCached($country_id);
        if ($country) {
            abort(404);
        }

        return response()->json($country);
    }

}
