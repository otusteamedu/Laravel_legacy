<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use App\Services\UserGroup\UserGroupRightService;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
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
     * Determine whether the user can view the record.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return mixed
     */
    public function view(User $user, Record $record)
    {
        return $user->hasRecord($record->id);
    }

    /**
     * Determine whether the user can update the record.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return mixed
     */
    public function update(User $user, Record $record)
    {
        return $user->hasRecord($record->id);
    }

    /**
     * Determine whether the user can delete the record.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Record  $record
     * @return mixed
     */
    public function delete(User $user, Record $record)
    {
        return $user->hasRecord($record->id);
    }
}
