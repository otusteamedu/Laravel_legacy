<?php

namespace App\Http\Middleware;


use App\Services\Locale\LocaleService;
use Closure;
use Illuminate\Http\Request;

class Localize
{
    private $localeService;

    public function __construct(
        LocaleService $localeService
    )
    {
        $this->localeService = $localeService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $this->localeService->localizeRequest($request);
        return $next($request);
    }

}
