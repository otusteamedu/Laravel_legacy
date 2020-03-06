<?php


namespace App\Services\User\Repositories;

use App\Models\User;
use App\Services\Base\Resource\Repositories\CmsBaseResourceRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Services\User\Resources\User as UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;


class UserRepository extends CmsBaseResourceRepository
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
    public function getItem(int $id): User
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @param int $id
     * @return JsonResource
     */
    public function getItemWithRole(int $id): JsonResource
    {
        return new UserResource($this->model::findOrFail($id));
    }

    /**
     * @param array $data
     * @return User
     */
    public function store(array $data): User
    {
        return $this->model::create(Arr::except($data, 'role'))
            ->attachRole($data['role']);
    }

    /**
     * @param $item
     * @param array $updateData
     * @return User
     */
    public function update($item, array $updateData): User
    {
        if (Arr::has($updateData, 'role')) {
            $item->update(Arr::except($updateData, 'role'));
            $item->syncRoles([$updateData['role']]);
        } else {
            $item->update($updateData);
        }

        return $item;
    }

    /**
     * @param User $user
     * @param string $oldPassword
     * @param string $newPassword
     */
    public function setPassword(User $user, string $oldPassword, string $newPassword)
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
            ['token' => sha1(time())]
        );
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
     * @param string $token
     * @return mixed
     */
    public function getUserVerify(string $token)
    {
        return $this->model::getUserVerify($token)->first();
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function getUserByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
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
     * @param string $id
     * @return mixed
     */
    public function getUserBySocialId(string $id)
    {
        return $this->model::getUserBySocialId($id)->first();
    }
}
