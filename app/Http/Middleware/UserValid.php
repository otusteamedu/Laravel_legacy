<?php

namespace App\Http\Middleware;

use App\Services\User\UserValidator;
use Closure;
use Illuminate\Http\Request;


class UserValid
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $userValidator = userValidator();

        return ! $userValidator->validateRequest($request)
            ? $userValidator->getStatus()
            : $next($request);
    }
}
