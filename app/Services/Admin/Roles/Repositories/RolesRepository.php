<?php


namespace App\Services\Admin\Roles\Repositories;


use App\Models\Role;

/**
 * Class RolesRepository
 * @package App\Services\Admin\Roles\Repositories
 */
class RolesRepository
{
    /**
     * @return Role[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getList()
    {
        return Role::all([
            'id',
            'title',
            'description'
        ]);
    }
}
