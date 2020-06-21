<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Models\UserGroup;
use Closure;
use Illuminate\Support\Facades\Auth;

/**
 * Посредник ограничивающий доступ к административной части сайта
 * для определенных групп пользователей
 *
 * Class AdminAccess
 * @package App\Http\Middleware
 */
class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $allowedUserGroups = [
            UserGroup::ADMIN_GROUP,
            UserGroup::EDITOR_GROUP,
            UserGroup::AUTHOR_GROUP,
            UserGroup::MODERATOR_GROUP
        ];
        /** @var User $user */
        $user = Auth::user();
        if ($user && in_array($user->group->name, $allowedUserGroups)) {
            return $next($request);
        }

        return redirect('/');
    }
}
