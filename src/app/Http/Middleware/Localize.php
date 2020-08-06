<?php

namespace App\Http\Middleware;

use App\Services\Locale\Locale;
use Closure;
use Illuminate\Support\Facades\App;

class Localize
{
    /**
     * Установка локализации приложения
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->session()->pull(Locale::LOCALE_SESSION_KEY, App::getLocale());
        App::setLocale($locale);

        return $next($request);
    }
}
