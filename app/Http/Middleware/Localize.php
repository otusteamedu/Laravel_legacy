<?php

namespace App\Http\Middleware;

use App;
use Closure;

/**
 * Class Localize
 * @package App\Http\Middleware
 */
class Localize
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');
        if (!$this->localize($locale)) abort(404);

        $request->route()->forgetParameter($locale);

        return $next($request);
    }

    /**
     * @param $locale
     * @return bool
     */
    private function localize(string $locale): bool
    {
        if (!$locale || !$this->isAvailableLocale($locale)) {
            return false;
        }
        App::setLocale($locale);
        return true;
    }


    /**
     * @param string $locale
     * @return bool
     */
    private function isAvailableLocale(string $locale): bool
    {
        $availableLocales = config('app.available_locales');
        if (in_array($locale, $availableLocales)) {
            return true;
        }
        return false;
    }
}
