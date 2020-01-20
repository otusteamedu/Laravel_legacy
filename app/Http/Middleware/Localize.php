<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class Localize
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->localize($request);

        return $next($request);
    }

    private function localize(Request $request)
    {
        $lang = $this->getRequestLocal($request);
        app()->setLocale($lang);
    }

    private function getRequestLocal(Request $request) :string
    {
        $locale = $request->route('locale');
        $request->route()->forgetParameter('locale');

        if (!in_array($locale, config('app.supported_locales'))) {
            $locale = config('app.default_locale');
        }

        return $locale;
    }
}
