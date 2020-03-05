<?php


namespace App\Services\UserGroup;


use App\Models\UserGroupRight;
use Illuminate\Support\Collection;

class UserGroupRightRepository implements UserGroupRightRepositoryInterface
{
    public function getList(): ?Collection
    {
        return UserGroupRight::all();
    }

    public function getByCode(string $code): ?UserGroupRight
    {
        return UserGroupRight::whereCode($code)->first();
    }
}
