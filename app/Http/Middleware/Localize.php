<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localize
{
    private $locales = ['en', 'ru'];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $locale = $request->route()->path('locale');
        $locale = $this->getSupportedLang($request);
        if (!$locale) {
            abort(404);
        }

        \App::setLocale($locale);
        $request->route()->forgetParameter('locale');
        return $next($request);
    }

    public function getSupportedLang(Request $request)
    {
        $locale = $request->route('locale');
        if (in_array($locale, $this->locales)) {
            return $locale;
        }
        return 'ru';
    }
}
