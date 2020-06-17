<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class UserByApiToken
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
        $request->request->add(['user' => User::getUserByToken($request->get('api_token'))]);
        return $next($request);
    }
}
