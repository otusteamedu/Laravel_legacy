<?php

namespace App\Http\Middleware;

use App\Services\Locales\LocalesService;
use Closure;
use Illuminate\Http\Request;

class Localize
{
    private $localesService;

    public function __construct(LocalesService $localesService)
    {
        $this->localesService = $localesService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $this->localesService->getCurrentLocale();

        \App::setLocale($locale);
        \View::share(['locale' => $locale]);

        if ($this->localesService->isDefaultLocaleSet()) {
            // @ToDo: заменить 404 на 301 на эту же самую страницу без префикса в url
            return abort(404);
        }

        return $next($request);
    }

}
