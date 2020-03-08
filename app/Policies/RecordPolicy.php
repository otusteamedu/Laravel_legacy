<?php

namespace App\Policies;

use App\Models\Record;
use App\Models\User;
use App\Services\Record\Repositories\RecordRepository;
use App\Services\UserGroup\UserGroupRightService;
use App\Services\UserGroup\UserGroupService;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;

    protected UserGroupRightService $userGroupRightService;
    protected UserGroupService $userGroupService;
    protected RecordRepository $recordRepository;

    public function __construct(
        UserGroupRightService $userGroupRightService,
        UserGroupService $userGroupService,
        RecordRepository $recordRepository
    )
    {
        $this->userGroupRightService = $userGroupRightService;
        $this->userGroupService = $userGroupService;
        $this->recordRepository = $recordRepository;
    }

    public function before(User $user): ?bool
    {
        return $this->userGroupService->isAdmin($user) ? true : null;
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
        return $this->recordRepository->masterHasRecord($user->id, $record->id);
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
        return $this->recordRepository->masterHasRecord($user->id, $record->id);
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
        return $this->recordRepository->masterHasRecord($user->id, $record->id);
    }
}
