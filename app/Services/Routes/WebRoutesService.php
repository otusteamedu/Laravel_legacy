<?php
/**
 * Description of WebRoutesService.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

namespace App\Services\Routes;

use App\Models\Country;
use Route;

class WebRoutesService
{

    public static function registerAllRoutes()
    {
        self::registerCountriesRoutes();
    }

    private static function registerCountriesRoutes()
    {
        Route::get('/countries', function () {
            return view('countries.index', [
                'countries' => Country::paginate(),
            ]);
        })->name('countries.index');

        Route::get('/countries/create', function () {
            return view('countries.create');
        })->name('countries.create');

        Route::get('/countries/{country}', function (Country $country) {
            return view('countries.show', [
                'country' => $country,
                'cities' => $country->cities()->paginate(),
            ]);
        })->name('countries.show');
    }

}