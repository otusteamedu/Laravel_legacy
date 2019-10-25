<?php
/**
 */

namespace App\Services\Users\Repositories;


use App\Models\User;


class EloquentUserRepository implements UserRepositoryInterface
{

    public function find(int $id)
    {
        return User::find($id);
    }

    public function search(array $filters = [])
    {
        return User::paginate();
    }

    public function createFromArray(array $data): User
    {
        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);
        $this->saveRoles($user, $data['role_id']);
        return $user;
    }

    public function updateFromArray(User $user, array $data)
    {

        $result = User::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $user->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $result = User::where('email', $data['email'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $user->id)) {

            return ['error' => 'Этот email уже успользуется'];
        }
        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);

        }


        $user->update($data);
        $this->saveRoles($user, $data['role_id']);


        return 1;
    }

    public function create(array $data): User
    {
        return $this->createFromArray($data);

    }

    public function delete(int $id)
    {
        return User::destroy($id);
    }

    public function getRolesNames(User $user, array $filters = [])
    {
        return $user->roles()->get()->pluck('name', 'id')->toArray();;

    }

    public function saveRoles(User $user, $roles)
    {
        //dd($roles);
        if (!empty($roles)) {
            $user->roles()->sync($roles);
        } else {
            $user->roles()->detach();
        }

        return TRUE;
    }

}