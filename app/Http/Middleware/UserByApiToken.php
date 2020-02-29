<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use App\Repositories\UserRepository;

class UserByApiToken
{
    protected $userRepository;

    public function __construct
    (
        UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
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
        $request->request->add(['user' => $this->userRepository->getUserByToken($request->get('api_token'))]);

        return $next($request);
    }
}
