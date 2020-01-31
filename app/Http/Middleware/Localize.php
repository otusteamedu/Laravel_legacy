<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Localize
{
    private $langs = ['en', 'ru'];

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->localize($request);
        return $next($request);
    }

    /**
     * @param Request $request
     */
    private function localize(Request $request)
    {
        $lang = $this->getRequestLang($request);
        app()->setLocale($lang);
    }

    /**
     * @param Request $request
     * @return string
     */
    private function getRequestLang(Request $request): string
    {
        if ($request->route('lang')) {
            $lang = $request->route('lang');
            $request->route()->forgetParameter('lang');

            $this->isHasLang($lang);
            
            return $lang;
        }

        return config('app.locale');
    }

    public function isHasLang($lang)
    {
        if (!in_array($lang, $this->langs)) {
            abort(404);
        }
    }
}
