<?php

namespace App\Http\Middleware;


use App\Services\Localisation\LocalisationService;
use Closure;
use Illuminate\Http\Request;

class Localisation
{
    private $localisationService;

    public function __construct(LocalisationService $localisationService)
    {
        $this->localisationService = $localisationService;
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
        $this->localisationService->LocalisationRequest($request);
        return $next($request);
    }

}
