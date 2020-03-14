<?php

namespace App\Services\Events\Models\User;
use App\Models\User;

abstract class UserEvent
{

    /** @var User */
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}
