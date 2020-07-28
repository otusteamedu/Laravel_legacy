<?php

namespace App\Http\Middleware;

use App;
use View;
use Closure;
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
    public function handle($request, Closure $next)
    {
        $locale = $this->getRequestLocale($request);

        $request->route()->forgetParameter('locale');

        $this->localize($locale);

        return $next($request);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getRequestLocale(Request $request): string
    {
        return $request->route('locale');
    }

    /**
     * @param string $locale
     */
    private function localize(string $locale)
    {
        App::setLocale($locale);
    }
}