<?php

namespace App\Policies;

use App\Models\User;
use App\Services\Auth\AuthService;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class BasePolicy
{
    use HandlesAuthorization;

    protected $authService;

    public function __construct(
        AuthService $authService
    )
    {
        $this->authService = $authService; // @ToDo: на будущее. Нужно использовать для сложной логики определения прав
    }

    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }
}
