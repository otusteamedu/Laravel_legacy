<?php

namespace App\Repositories\Roles;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;

interface RoleRepositoryInterface
{
    /**
     * Get all roles
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection;
    
    /**
     * Create role
     *
     * @param  array  $data
     *
     * @return Role
     */
    public function create(array $data): Role;
    
    /**
     * Find role by id
     *
     * @param  int  $id
     *
     * @return Role|null
     */
    public function find(int $id): ?Role;
    
    /**
     * Update role
     *
     * @param  Role  $role
     * @param  array  $data
     *
     * @return Role
     */
    public function update(Role $role, array $data): Role;
    
    /**
     * Delete role
     *
     * @param  Role  $role
     *
     * @return bool|null
     */
    public function delete(Role $role): ?bool;
    
    /**
     * Get array of roles for form select
     *
     * @param  array  $columns
     *
     * @return Role[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
