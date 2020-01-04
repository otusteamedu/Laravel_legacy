<?php

namespace App\Http\Middleware;

use App\Http\Controllers\ApiController;
use Closure;

class CheckApiToken
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
		if (request('api_token') != config('services.api_rest_iphone.secret')) {
			return ApiController::answer('error', 'Неверный token для приложения');
		}

        return $next($request);
    }
}
