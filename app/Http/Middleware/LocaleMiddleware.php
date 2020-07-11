<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use App\Helpers\LocaleHelper;

/**
 * Class LocaleMiddleware
 * @package App\Http\Middleware
 */
class LocaleMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        $locale = LocaleHelper::getLocale();
        $locale ? App::setLocale($locale) : App::setLocale(config('app.locale'));

        return $next($request);
    }

}
