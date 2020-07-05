<?php

namespace App\Http\Middleware;

use App\Repository\MenuRepository;
use App\Services\Menu\MenuServices;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{

    public function handle(Request $request, \Closure $next)
    {
        View::share([
            'locale' => \App::getLocale(),
            'menu' => MenuServices::all()
        ]);


        return $next($request);
    }

}
