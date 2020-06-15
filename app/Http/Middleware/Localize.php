<?php

namespace App\Http\Middleware;

use App\Services\Locale\Locale;
use Closure;
use App;
use Illuminate\Http\Request;

class Localize
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)

    {

        $locale = $request->route('locale');

        if(!Locale::isSupported($locale)) {
            //abort(404);
            $locale = Locale::RU;
        }

        Locale::setLocale($locale);

        $request->route()->forgetParameter('locale'); //забыть параметр

        return $next($request);
    }
}
