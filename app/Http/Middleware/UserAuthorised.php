<?php

namespace App\Http\Middleware;

use Closure;


class UserAuthorised
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
        $credentials = $request->only('email', 'password');

        return auth()->attempt($credentials)
            ? $next($request)
            : response()->json([
                'message' => __('auth.wrong_login_pass'),
                'status' => 'danger'
            ], 401);
    }
}
