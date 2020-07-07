<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForbidStudents
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user() && $request->user()->isStudent()) {
            return abort(403);
        }

        return $next($request);
    }
}
