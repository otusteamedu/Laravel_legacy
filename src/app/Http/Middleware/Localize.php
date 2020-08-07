<?php

namespace App\Http\Middleware;

use App\Services\Locale\Locale;
use App\Services\Localize\LocalizeService;
use Closure;
use Illuminate\Support\Facades\App;

class Localize
{
    /**
     * @var LocalizeService
     */
    private $localizeService;

    public function __construct(LocalizeService $localizeService)
    {
        $this->localizeService = $localizeService;
    }

    /**
     * Установка локализации приложения
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $locale = $this->localizeService->get();
        App::setLocale($locale);

        return $next($request);
    }
}
