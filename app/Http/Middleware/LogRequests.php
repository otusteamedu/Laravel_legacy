<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class LogRequests
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
        /** @var Response $reponse */
        $response = $next($request);

        \Log::debug('request response', [
            $request->toArray(),
            $response->getContent(),
        ]);
        return $response;
    }
}