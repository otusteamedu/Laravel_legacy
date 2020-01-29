<?php


namespace App\Services\User\Repositories;

use App\Models\User;
use App\Services\Base\Resource\Repositories\BaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;


class UserRepository extends BaseResourceRepository
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

    /**
     * @param string $oldPassword
     * @param string $newPassword
     * @param User $user
     */
    public function setPassword (string $oldPassword, string $newPassword,  User $user)
    {
        password_verify($oldPassword, $user->password)
            ? $user->password = bcrypt($newPassword)
            : abort(422, trans('auth.wrong_active_password'));
    }

    /**
     * @param User $user
     */
    public function setVerifyToken(User $user)
    {
        $user->verifyUser()->updateOrCreate(
            ['user_id' => $user->id],
            ['token' => sha1(time())]);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function verifyUser(User $user)
    {
        return $user->verified ? false : $user->update(['verified' => 1]);
    }

    /**
     * @param $token
     * @return mixed
     */
    public function getUserVerify($token)
    {
        return User::getUserVerify($token);
    }

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param User $user
     */
    public function sendEmailVerificationNotification(User $user)
    {
        $user->sendEmailVerificationNotification();
    }

    /**
     * @param User $user
     * @param string $socialId
     * @param string $service
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function storeUserSocial(User $user, string $socialId, string $service)
    {
        return $user->socials()->create([
            'social_id' => $socialId,
            'service' => $service
        ]);
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getUserBySocialId(int $id)
    {
        return $this->model::getUserBySocialId($id)->first();
    }
}
