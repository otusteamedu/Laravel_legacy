<?php
/**
 */

namespace App\Services\Permissions\Repositories;


use App\Models\Permission;

class EloquentPermissionRepository implements PermissionRepositoryInterface
{

    public function find(int $id)
    {
        return Permission::find($id);
    }

    public function search(array $filters = [])
    {
        return Permission::paginate();
    }

    public function createFromArray(array $data): Permission
    {
        $permission = new Permission();
        $permission->create($data);
        return $permission;
    }

    public function updateFromArray(Permission $permission, array $data)
    {

        $result = Permission::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $permission->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $permission->update($data);
        return 1;
    }

    public function create(array $data): Permission
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {

        return Permission::destroy($id);
    }

}