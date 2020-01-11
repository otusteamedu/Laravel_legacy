<?php


namespace App\Services\User\Repositories;

use App\Models\User;
use App\Services\Resource\Repositories\ResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class UserRepository extends ResourceRepository
{
    /**
     * TextureRepository constructor.
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::with('roles')
            ->withCount('orders')
            ->get();
    }

    /**
     * @param int $id
     * @return User
     */
    public function show(int $id): User
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function showWithRole(int $id): JsonResource
    {
        return new UserResource($this->model::findOrFail($id));
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->model::create(Arr::except($data, 'roles'))
            ->attachRole($data['roles']);
    }

    /**
     * @param array $data
     * @param User $item
     * @return User
     */
    public function update(array $data, $item): User
    {
        $item->update(Arr::except($data, 'roles'));
        $item->syncRoles([$data['roles']]);

        return $item;
    }

//    public function createWithRoleUser($request) {
//        $user = User::create([
//            'name' => $request['name'],
//            'email' => $request['email'],
//            'password' => bcrypt($request['password']),
//            'verified' => 0
//        ])->attachRole('user');
//
//        return $user;
//    }

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @param User $user
     */
    public function setPassword (string $oldPassword, string $newPassword,  User $user) {
        password_verify($oldPassword, $user->password)
            ? $user->password = bcrypt($newPassword)
            : abort(422, trans('auth.wrong_active_password'));
    }
}
