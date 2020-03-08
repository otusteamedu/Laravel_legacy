<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Illuminate\Http\Request;
use View;

class ShareCMSData
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        View::share(['locale' => App::getLocale()]);

        return $next($request);
    }
}
