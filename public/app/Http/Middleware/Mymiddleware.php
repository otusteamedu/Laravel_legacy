<?php

namespace App\Http\Middleware;

use Closure;

class Mymiddleware extends Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
         if($request->route('page') != 'pages') {
             echo 'new route';
         }
        return $next($request);
    }
}
