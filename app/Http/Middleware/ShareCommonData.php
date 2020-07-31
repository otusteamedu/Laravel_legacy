<?php

namespace App\Http\Middleware;

use Closure;
//use App\Services\Countries\CountriesService;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{

    public function handle(Request $request, \Closure $next, ?string $name)
    {
        View::share([
           'locale' => \App::getLocale(),
           'name' => $name,
           //'countries' => $this->countriesService->searchCountriesWithCities(),
        ]);
        return $next($request);
    }


    public function terminate()
    {
        \Log::debug('terminate');
    }
}
