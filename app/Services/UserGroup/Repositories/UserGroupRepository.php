<?php


namespace App\Services\UserGroup;


use App\Models\UserGroup;
use Illuminate\Support\Collection;

class UserGroupRepository implements UserGroupRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getIdByCode(string $code): ?int
    {
        $userGroup = $this->getByCode($code);

        return $userGroup === null ? null : $userGroup->id;
    }

    /**
     * @inheritDoc
     */
    public function getByCode(string $code): ?UserGroup
    {
        return UserGroup::whereCode($code)->first();
    }

    /**
     * @inheritDoc
     */
    public function getList(): ?Collection
    {
        return UserGroup::all();
    }
}
