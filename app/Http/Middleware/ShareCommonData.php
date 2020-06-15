<?php

namespace App\Http\Middleware;

use App\Services\Adverts\AdvertsService;
use Closure;


class ShareCommonData
{
    /**
     * Handle an incoming request.
     *
     * @param AdvertsService $advertsService
     */
    private $advertsService;
    public function __construct(AdvertsService $advertsService)
    {
        $this->advertsService = $advertsService;
    }

    public function handle($request, Closure $next)
    {

            \View::share([
                'locale'=>\App::getLocale(),
                'url'=>$request->url(),
                'user' =>\Auth::user(),
            ]);

        return $next($request);
    }
}
