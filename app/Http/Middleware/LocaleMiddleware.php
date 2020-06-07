<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

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
        $locale = $this->languageService->getLanguage();

        if ($locale) {
            App::setLocale($locale);
        } else {

            $local = $this->languageService->getLanguageFromRefferer();
            dd($local);

            if($local)
                return redirect('/' .$local);
            else
                return redirect('/ru');
        }

        return $next($request);
    }
}
