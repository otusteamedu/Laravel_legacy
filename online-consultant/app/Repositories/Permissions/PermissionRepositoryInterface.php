<?php

namespace App\Repositories\Permissions;

use Illuminate\Database\Eloquent\Collection;
use App\Models\Permission;

interface PermissionRepositoryInterface
{
    /**
     * Get all permissions
     *
     * @param  array  $columns
     *
     * @return Collection
     */
    public function all($columns = ['*']): Collection;
    
    /**
     * Create permission
     *
     * @param  array  $data
     *
     * @return Permission
     */
    public function create(array $data): Permission;
    
    /**
     * Find permission by id
     *
     * @param  int  $id
     *
     * @return Permission|null
     */
    public function find(int $id): ?Permission;
    
    /**
     * Update permission
     *
     * @param  Permission  $permission
     * @param  array  $data
     *
     * @return Permission
     */
    public function update(Permission $permission, array $data): Permission;
    
    /**
     * Delete permission
     *
     * @param  Permission  $permission
     *
     * @return bool|null
     */
    public function delete(Permission $permission): ?bool;
    
    /**
     * Get array of permissions for form select
     *
     * @param  array  $columns
     *
     * @return Permission[]|array|Collection
     */
    public function getFormSelectOptions($columns = []);
}
