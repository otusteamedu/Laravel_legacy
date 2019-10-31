<?php

namespace App\Repositories\Permissions;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Permission;

class EloquentPermissionRepository implements PermissionRepositoryInterface
{
    /**
     * Get all permissions
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection
    {
        return Permission::all($columns);
    }
    
    /**
     * Create permission
     *
     * @param  array  $data
     *
     * @return Permission
     */
    public function create(array $data): Permission
    {
        $permission = new Permission();
        $permission->fill($data);
        $permission->save();
        
        return $permission;
    }
    
    /**
     * Find permission by id
     *
     * @param  int  $id
     *
     * @return Permission|null
     */
    public function find(int $id): ?Permission
    {
        return Permission::find($id);
    }
    
    /**
     * Update permission
     *
     * @param  Permission  $permission
     * @param  array  $data
     *
     * @return Permission
     */
    public function update(Permission $permission, array $data): Permission
    {
        $permission->update($data);
        
        return $permission;
    }
    
    /**
     * Delete permission
     *
     * @param  Permission  $permission
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(Permission $permission): ?bool
    {
        return $permission->delete();
    }
    
    /**
     * Get array of permissions for form select
     *
     * @param  array  $columns
     *
     * @return Permission[]|array|Collection
     */
    public function getFormSelectOptions($columns = [])
    {
        return $this->all($columns)->toArray();
    }
}
