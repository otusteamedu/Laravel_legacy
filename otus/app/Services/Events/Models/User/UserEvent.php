<?php

namespace App\Services\Events\Models\User;

use App\Models\User;

class UserEvent {

    /** @var User */
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }
}
