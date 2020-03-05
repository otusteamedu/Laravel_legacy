<?php


namespace App\Services\UserGroup;


use App\Models\UserGroupRight;
use Illuminate\Support\Collection;

interface UserGroupRightRepositoryInterface
{
    /**
     * @return Collection|null
     */
    public function getList(): ?Collection;

    /**
     * @param string $code
     * @return UserGroupRight|null
     */
    public function getByCode(string $code): ?UserGroupRight;
}
