<?php

namespace App\Policies;

use App\Models\User;
use App\Services\UserGroup\UserGroupRightService;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    protected UserGroupRightService $userGroupRightService;

    public function __construct(UserGroupRightService $userGroupRightService)
    {
        $this->userGroupRightService = $userGroupRightService;
    }

    public function before(User $user): ?bool
    {
        return $user->isAdmin() ? true : null;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->hasClient($model->id);
    }

    /**
     * Determine whether the user can view list of clients.
     *
     * @param User $user
     * @return bool
     */
    public function viewClientList(User $user): bool
    {
        return $this->userGroupRightService->hasRight($user->group_id, 'client.list');
    }

    /**
     * Determine whether the user can view list of records.
     *
     * @param User $user
     * @return bool
     */
    public function viewRecordList(User $user): bool
    {
        return $this->userGroupRightService->hasRight($user->group_id, 'record.list');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return $this->userGroupRightService->hasRight($user->group_id, 'client.create');
    }

    /**
     * Determine whether the user can create the record.
     *
     * @param User $user
     * @param User $model
     * @return bool
     */
    public function createRecord(User $user, User $model): bool
    {
        return $this->userGroupRightService->hasRight($user->group_id, 'record.create')
            && $user->hasClient($model->id);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->hasClient($model->id);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->hasClient($model->id);
    }
}
