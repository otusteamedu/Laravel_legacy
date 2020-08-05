<?php


namespace App\Services\Users\Repositories;


use App\Builders\QueryBuilder;
use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Password;

class EloquentUsersRepository implements UsersRepositoryInterface
{

    public function find(int $id)
    {
        return User::whereId($id)->first();
    }

    public function search(array $groups, int $limit = 20)
    {
        return User::whereIn('group_id', $groups)->paginate($limit);
    }

    public function getBy(QueryBuilder $builder): Collection
    {
        $builder = $builder->build(User::query());

        return $builder->get();
    }

    public function createFromArray(array $data): User
    {
        $user = (new User())->create($data);

        return $user;
    }

    public function updateFromArray(User $user, array $data): User
    {
        if (isset($data['password']) && is_null($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    public function delete(User $user)
    {
        return $user->delete();
    }


    public function updateEmail(User $user, string $email): User
    {
        $this->updateFromArray($user, [
            'email' => $email
        ]);
    }

    public function updatePassword(User $user, string $password): User
    {
        $this->updateFromArray($user, [
            'password' => $password
        ]);
    }

    public function register(\App\Services\Users\DTO\User $userDTO): User
    {
        $userDTO->group_id = current(Group::CLIENTS);

        return $this->createFromArray($userDTO->toArray());
    }

    public function sendRecoveryEmail(User $user): string
    {
        return Password::sendResetLink(['email' => $user->email]);
    }
}
