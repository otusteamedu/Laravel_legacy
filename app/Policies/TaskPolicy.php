<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function before(User $user)
    {
        $result = ($user->isAdmin()) ? true : null;
        return $result;
    }

    public function view(User $user)
    {
        return $user->isManager();
    }

    public function create(User $user)
    {
        return $user->isManager();
    }

    public function update(User $user)
    {
        return $user->isManager();
    }

    public function delete(User $user, Task $task)
    {
        return $user->isAuthor($task->user_id);
    }

}
