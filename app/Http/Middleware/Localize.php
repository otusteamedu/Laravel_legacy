<?php

namespace App\Http\Middleware;

use App\Services\Locale\LocaleService;
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

class Localize
{
    /**
     * @var LocaleService
     */
    private LocaleService $localeService;

    public function __construct(LocaleService $localeService)
    {

        $this->localeService = $localeService;
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->localeService->lacalizeRequest($request);

        return $next($request);
    }
}
