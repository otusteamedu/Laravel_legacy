<?php


namespace App\Policies;


use App\Models\User;
use App\Repositories\Interfaces\IUserRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    private $repository;

    public function __construct(IUserRepository $repository) {
        $this->repository = $repository;
    }
    /**
     * @param User $user
     * @param $ability
     * @return mixed
     */
    public function before(User $user, $ability) {
        if($user->isRoot())
            return true;
    }
    /**
     * @param User $user
     * @return bool
     */
    public function view(User $user) {
        return $this->repository->requiredAccess($user, "user" , "R");
    }
    /**
     * @param User $user
     * @return bool
     */
    public function create(User $user) {
        return $this->store($user);
    }
    /**
     * @param User $user
     * @return bool
     */
    public function store(User $user) {
        return $this->repository->requiredAccess($user, "user" , "U");
    }
    /**
     * Determine whether the user can view the $userData.
     *
     * @param User $user
     * @param User $userData
     * @return mixed
     */
    public function edit(User $user, User $userData) {
        return $this->update($user, $userData);
    }
    /**
     * Determine whether the user can update the $userData.
     *
     * @param \App\Models\User $user
     * @param User $userData
     * @return mixed
     */
    public function update(User $user, User $userData)
    {
        if($userData->isRoot())
            return false;
        return $this->repository->requiredAccess($user, "user" , "U");
    }
    /**
     * Determine whether the user can delete the $userData.
     *
     * @param \App\Models\User $user
     * @param User $userData
     * @return mixed
     */
    public function delete(User $user, User $userData)
    {
        if($userData->isRoot())
            return false;
        if($user->id == $userData->id)
            return false;
        return $this->repository->requiredAccess($user, "user" , "U");
    }
}
