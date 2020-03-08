<?php


namespace App\Services\UserGroup;


use App\Models\UserGroup;
use Illuminate\Support\Collection;

interface UserGroupRepositoryInterface
{
    public const ADMIN_GROUP_CODE = 'admin';
    public const MASTER_GROUP_CODE = 'master';
    public const CLIENT_GROUP_CODE = 'client';

    /**
     * @param string $code
     * @return int|null
     */
    public function getIdByCode(string $code): ?int;

    /**
     * @param string $code
     * @return UserGroup|null
     */
    public function getByCode(string $code): ?UserGroup;

    /**
     * @return Collection|null
     */
    public function getList(): ?Collection;
}
