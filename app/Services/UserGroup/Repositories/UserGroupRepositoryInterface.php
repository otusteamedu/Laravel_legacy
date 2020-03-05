<?php


namespace App\Services\UserGroup;


use App\Models\UserGroup;
use Illuminate\Support\Collection;

interface UserGroupRepositoryInterface
{
    public const ADMIN = 'admin';
    public const MASTER = 'master';
    public const CLIENT = 'client';

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
