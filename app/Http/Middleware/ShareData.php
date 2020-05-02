<?php

namespace App\Http\Middleware;

use Closure;
use View;
use Illuminate\Http\Request;

class ShareData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        View::share([
            'locale' => \App::getLocale(),
        ]);
        return $next($request);
    }
}
