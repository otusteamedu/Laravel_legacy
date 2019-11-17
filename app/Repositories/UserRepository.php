<?php
/**
 * Created by PhpStorm.
 * User: smol
 * Date: 01/11/2018
 * Time: 22:22
 */

namespace App\Repositories;

use App\Models\User;
use Validator;

class UserRepository extends CRUDRepository
{
    public function create($request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'publish' => $request->publish
        ]);
        $user->roles()->attach($request->roles);

        return $user;
    }

    public function update($id, $request) {
        $user = User::findOrFail($id);

        if ($request->has('old_password', 'password')) {
            if (!password_verify($request->old_password, $user->password)) {
                abort(422, 'Действующий пароль не действителен!');
            }
            $user->fill([$request->except('roles', 'password'), 'password' => bcrypt($request->password)])->save();
        }

        $user->fill($request->except('roles', 'password'))->save();

        return $user->roles()->sync($request->roles);
    }

    public function publish($id) {
        $user = User::findOrFail($id);
        $user->publish = !$user->publish;
        $user->save();

        return $user;
    }

    public function passwordChange($id, $request) {
        $user = User::findOrFail($id);
        if (password_verify($request->password, $user->password)) {
            $user->password = bcrypt($request->password);
        }
    }
}
