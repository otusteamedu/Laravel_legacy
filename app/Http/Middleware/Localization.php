<?php

namespace App\Http\Middleware;

use App\Services\Cms\Localization\LocalizationService;
use Closure;
use Illuminate\Http\Request;

/**
 * Class Localization
 * @package App\Http\Middleware
 */
class Localization
{
    /** @var LocalizationService $localizationService */
    protected $localizationService;

    public function __construct(LocalizationService $localizationService)
    {
        $this->localizationService = $localizationService;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $this->localizationService->setLocale($request);

        $request->route()->forgetParameter('locale');

        return $next($request);
    }
}
