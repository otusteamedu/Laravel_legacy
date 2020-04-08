<?php

namespace App\Http\Middleware;

use App\Services\Locales\LocalesService;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{
    private $localesService;

    public function __construct(LocalesService $localesService)
    {
        $this->localesService = $localesService;
    }

    public function handle(Request $request, \Closure $next)
    {
        $allLocaleList = $this->localesService->getAllLocaleList();

        View::share([
            'alLocaleList' => $allLocaleList,
        ]);

        return $next($request);
    }

}
