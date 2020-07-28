<?php
namespace App\Helpers;

use App;

class RouteBuilder
{
    public static function localeRoute($name, $parameters = [], $absolute = true): string
    {
        $locale = App::getLocale();

        $parameters = array_merge([
            'locale' => $locale,
        ], $parameters);

        return route($name, $parameters, $absolute);
    }
}