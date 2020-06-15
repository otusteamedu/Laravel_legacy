<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RequestLoger
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
//        /** @var Response $response */
//        $response =$next($request);
//
//       // \Log::Info($request->url(), [$response->status()]);
//
//        return $response;

        return $next($request);
    }

    public function terminate(Request $request) //, Response $response)
    {
        \Log::Info('Terminate'.$request->url()); //, [$response->status()]);
    }
}
