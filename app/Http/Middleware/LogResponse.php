<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class LogResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
//        \Log::debug('LogResponse', [
//            'url' => $request->getUri(),
//            'response' => $response->content(),
//        ]);

        return $response;
    }
}
