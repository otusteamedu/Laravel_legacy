<?php

namespace App\Policies;

use App\Models\User\User;

/**
 * Класс для проверки права
 * Class AuthorizationChecker
 * @package App\Policies
 */
final class AuthorizationChecker
{
    /**
     * @param User $user
     * @param string $right
     * @return bool
     */
    public static function hasUserRight(User $user, string $right): bool
    {
        $userRights = $user->group->rights->pluck('right', 'id');
        return $userRights->search($right) !== false;
    }
}