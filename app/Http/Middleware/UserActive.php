<?php

namespace App\Http\Middleware;

use Closure;


class UserActive
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
        if (! $request->user()) {
            $credentials = $request->only('email', 'password');
            auth()->attempt($credentials);
        }

        return auth()->user()->publish
            ? $next($request)
            : response()->json([
                'message' => __('auth.locked_out'),
                'status' => 'danger'
            ], 403);
    }
}
