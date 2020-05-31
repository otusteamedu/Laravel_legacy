<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Request;
use App\Services\LanguageService;

class LocaleMiddleware extends Middleware
{
    /** @var LanguageService */
    private $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $language = new LanguageService(new App\Services\LanguageResolver());
        $locale = $language->getLanguageFromRequst();

        if ($locale) {
            App::setLocale($locale);
        }

        return $next($request);
    }
}
