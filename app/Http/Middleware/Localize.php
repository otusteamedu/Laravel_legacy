<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localize
{
    private $availableLags = ['ru', 'en'];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->getRequestLocale($request);
        $request->route()->forgetParameter('locale');
        $this->localize($locale);

        return $next($request);
    }

    /**
     * @param string $locale
     */
    private function localize(string $locale)
    {
        app()->setLocale($locale);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getRequestLocale(Request $request): string
    {
        $locale = config('app.locale');

        if ($request->route('locale')) {
            $locale = $request->route('locale');

        } elseif ($request->get('locale')) {
            $locale = $request->get('locale');
        }

        if (!in_array($locale, $this->availableLags)) {
            abort(404);
        }

        return $locale;
    }
}
