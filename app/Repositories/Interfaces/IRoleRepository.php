<?php


namespace App\Repositories\Interfaces;


use App\Base\Repository\IBaseRepository;
use App\Models\Role;

interface IRoleRepository extends IBaseRepository
{
    /**
     * @return array
     */
    public function getList4Perms(): array;
}
