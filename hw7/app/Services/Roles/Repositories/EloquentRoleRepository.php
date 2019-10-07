<?php
/**

 */

namespace App\Services\Roles\Repositories;


use App\Models\Role;

class EloquentRoleRepository implements RoleRepositoryInterface
{

    public function find(int $id)
    {
        return Role::find($id);
    }

    public function search(array $filters = [])
    {
        return Role::paginate();
      // return Role::all()->pluck('name', 'id')->toArray();
    }

    public function searchToArray(array $filters = [])
    {
        //return Role::paginate();
        return Role::all()->pluck('name', 'id')->toArray();
    }
    public function createFromArray(array $data): Role
    {
        $role = new Role();
        $role->create($data);
        $role->savePermissions($data['permissions']);

        return $role;
    }

    public function updateFromArray(Role $role, array $data)
    {

       $result =  Role::where('name',$data['name'])->get();
       if( (count($result) > 1) || (count($result) == 1 && $result[0]->id != $role->id)) {

            return ['error' => 'Это имя уже успользуется'];
       }
       $role->update($data);
       $role->savePermissions($data['permissions']);
       return 1;
    }
    public  function create(array $data): Role
    {
        return $this->createFromArray($data);
    }
    public function delete(int $id) {

        return Role::destroy($id);
    }

    public function permissions(Role $role, array $filters = [])
    {
        return $role->permissions()->get();

    }

}