<?php

namespace App\Http\Middleware;

use App\Services\User\UserValidationBuilder;
use Closure;
use Illuminate\Http\Request;


class UserValid
{
    private UserValidationBuilder $userValidator;

    /**
     * UserAuthorised constructor.
     */
    public function __construct()
    {
        $this->userValidator = new UserValidationBuilder;
    }

    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         return ! $this->userValidator->validateRequest($request)
             ? $this->userValidator->getStatus()
             : $next($request);
    }
}
