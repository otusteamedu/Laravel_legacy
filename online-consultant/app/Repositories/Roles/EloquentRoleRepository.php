<?php

namespace App\Repositories\Roles;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{
    /**
     * Get all roles
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        return Role::all($columns);
    }
    
    /**
     * Create role
     *
     * @param  array  $data
     *
     * @return Role
     */
    public function create(array $data): Role
    {
        $role = new Role();
        $role->fill($data);
        $role->save();
        
        return $role;
    }
    
    /**
     * Find role by id
     *
     * @param  int  $id
     *
     * @return Role|null
     */
    public function find(int $id): ?Role
    {
        return Role::find($id);
    }
    
    /**
     * Update role
     *
     * @param  Role  $role
     * @param  array  $data
     *
     * @return Role
     */
    public function update(Role $role, array $data): Role
    {
        $role->update($data);
        
        return $role;
    }
    
    /**
     * Delete role
     *
     * @param  Role  $role
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Role $role): ?bool
    {
        return $role->delete();
    }
    
    /**
     * Get array of roles for form select
     *
     * @param  array  $columns
     *
     * @return Role[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
