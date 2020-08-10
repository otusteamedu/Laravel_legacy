<?php

namespace App\Http\Middleware;

use Closure;
use View;
use Illuminate\Http\Request;

class ShareCommonData
{
    public function handle(Request $request, \Closure $next, ?string $name)
    {
        View::share([
           'locale' => \App::getLocale(),
           'name' => $name
        ]);
        return $next($request);
    }


    public function terminate()
    {
        \Log::debug('terminate');
    }
}