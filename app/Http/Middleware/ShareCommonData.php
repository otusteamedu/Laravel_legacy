<?php
/**
 * Description of ShareCommonData.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Http\Middleware;

use App\Services\Countries\CountriesService;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{

    private $countriesService;

    public function __construct(
        CountriesService $countriesService
    )
    {
        $this->countriesService = $countriesService;
    }

    public function handle(Request $request, \Closure $next, ?string $name)
    {
        View::share([
           'locale' => \App::getLocale(),
           'name' => $name,
           'countries' => $this->countriesService->searchCountriesWithCities(),
        ]);
        return $next($request);
    }


    public function terminate()
    {
        \Log::debug('terminate');
    }

}