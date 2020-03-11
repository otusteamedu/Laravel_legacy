<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Services\UserGroup\UserGroupService;
use Closure;
use \Illuminate\Http\Request;

class CheckGroup
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param \Closure $next
     * @param mixed ...$groupCodes
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$groupCodes)
    {
        /** @var User $user */
        $user = $request->user();

        $userGroupService = app(UserGroupService::class);
        foreach ($groupCodes as $groupCode) {
            if ($user->group_id === $userGroupService->getIdByCode($groupCode)) {
                return $next($request);
            }
        }

        \Auth::logout();
        return redirect(route('pages.login'))->withErrors('Недостаточно прав.');
    }
}
