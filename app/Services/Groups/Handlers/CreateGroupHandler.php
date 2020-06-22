<?php

namespace App\Services\Groups\Handlers;

use App\DTOs\GroupDTO;
use App\Models\Group;

class CreateGroupHandler extends BaseHandler
{
    /**
     * @param GroupDTO $DTO
     * @return Group
     */
    public function handle(GroupDTO $DTO): Group
    {
        return $this->repository->store($DTO);
    }
}
