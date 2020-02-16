<?php

namespace App\Http\Middleware;

use Closure;

class SocialMiddleware
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
        // Оптимизировать !!!

        $services = ['facebook', 'google', 'vkontakte', 'yandex'];
        $enabledServices = [];
        foreach ($services as $service) {
            if (config('services.' . $service))
                $enabledServices[] = $service;
        }

        if (!in_array(strtolower($request->service), $enabledServices)) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => __('auth.invalid_social_service'),
                    'status' => 'danger'
                ], 401 );
            }
            return redirect()->back();
        }

        return $next($request);
    }
}
