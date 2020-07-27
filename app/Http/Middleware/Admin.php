<?php

namespace App\Http\Middleware;

use App\Services\Users\UserService;
use Closure;

class Admin
{
    /**
     * @var UserService
     */
    private $service;

    /**
     * ForbidStudents constructor.
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$this->service->checkIsAdmin($request->user())) {
            return abort(403);
        }

        return $next($request);
    }
}
