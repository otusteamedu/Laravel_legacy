<?php

namespace App\Http\Middleware;

use App\Services\User\UserValidator;
use Closure;
use Illuminate\Http\Request;


class UserValid
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed|null
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(Request $request, Closure $next)
    {
        $userValidator = app()->make(UserValidator::class);

        return ! $userValidator->validateRequest($request)
            ? $userValidator->getStatus()
            : $next($request);
    }
}
