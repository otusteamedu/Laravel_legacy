<?php
namespace App\Repositories;
use App\Models\Role;
use App\Repositories\Repository;
use Config;
use Gate;


class RoleRepository extends Repository {

    public function __construct(Role $role)
    {
        $this->model = $role;
    }
    public function add($request) {


        if (\Gate::denies('create',$this->model)) {
            abort(403);
        }

        $data = $request->all();

        if(!empty($data['role_id'])) {
            $role = $this->model->create([
                'name' => $data['name'],
            ]);
            $role->savePermissions($data['role_id']);
        }
        else {
            return ['error' => 'Не указаны привелегии'];

        }

    return ['status' => 'Роль добавлена'];

    }
    public function update($request, $role) {


        if (\Gate::denies('edit',$this->model)) {
            abort(403);
        }

        $data = $request->all();
        if(!empty($data['role_id'])) {
            $role->fill($data)->update();
            $role->savePermissions($data['role_id']);
        } else {
            return ['error' => 'Не указаны привелегии'];

        }
        return ['status' => 'Роль изменена'];

    }

    public function delete($role) {

        if (Gate::denies('edit',$this->model)) {
            abort(403);
        }
        $role->savePermissions([]);
        if($role->delete()) {

            return ['status' => 'Роль удалена'];
        }
    }

    public function savePermissions($inputPermissions) {
        // dd($inputPermissions);
        if(!empty($inputPermissions)) {
            $this->model->permissions()->sync($inputPermissions);
        }
        else {
            $this->model->permissions()->detach();
        }

        return TRUE;
    }

}


?>