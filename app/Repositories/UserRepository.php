<?php

namespace App\Repositories;

use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserList as UserListResource;
use App\Models\User;

class UserRepository
{
    public function getAll() {
        return UserListResource::collection(User::all());
    }

    public function getItem($id) {
        return new UserResource(User::findOrFail($id));
    }

    public function create($request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'publish' => $request->publish ?? 1
        ])->attachRoles($request->roles);

        return $user;
    }

    public function createWithRoleUser($request) {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'verified' => 0
        ])->attachRole('user');

        return $user;
    }

    public function createUserWithSocials($request)
    {
        $user = $this->createWithRoleUser($request);

        if (!$user->hasSocialLinked($request->service)) {
            $this->createUserSocial($user, $request->social_id, $request->service);
        }

        $this->sendEmailVerification($user);

        return $user;
    }

    public function createUserSocial(User $user, $socialId, $service) {
        return $user->socials()->create([
            'social_id' => $socialId,
            'service' => $service
        ]);
    }

    public function setVerifyToken(User $user)
    {
        $user->verifyUser()->updateOrCreate(
            ['user_id' => $user->id],
            ['token' => sha1(time())]);
    }

    public function update($id, $request) {
        $user = User::findOrFail($id);

        if ($request->has('old_passoword', 'password')) {
            $this->setPassword($user, $request->password);
        }

        $user->fill($request->except('roles', 'password'))->save();
        $user->syncRoles($request->roles);

        return $user;
    }

    public function publish($id) {
        $user = User::findOrFail($id);
        $user->publish = !$user->publish;
        $user->save();

        return $user;
    }

    public function delete($id) {
        return User::findOrFail($id)->delete();
    }

    public function verifyUser(User $user) {
        return $user->verified ? null : $user->update(['verified' => 1]);
    }

    public function getUserVerify($token) {
        return User::getUserVerify($token);
    }

    public function getUserByEmail($email) {
        return User::where('email', $email)->first();
    }

    public function sendEmailVerification(User $user) {
        $this->setVerifyToken($user);
        $user->sendEmailVerificationNotification();
    }

    public function setPassword (User $user, $password) {
        password_verify($password, $user->password)
            ? $user->password = bcrypt($password)
            : abort(422, trans('auth.wrong_active_password'));
    }
}
