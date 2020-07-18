<?php

namespace App\Services\Groups\Handlers;

use App\Models\Group;

/**
 * Class DeleteGroupHandler
 * @package App\Services\Groups\Handlers
 */
class DeleteGroupHandler extends BaseHandler
{
    /**
     * @param Group $group
     * @return bool
     */
    public function handle(Group $group): bool
    {
        return $this->repository->delete($group);
    }
}
