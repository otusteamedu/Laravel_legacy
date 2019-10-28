<?php

namespace App\Policies\Users;

use App\Models\User;
use App\Policies\Abilities;
use App\Policies\Abstracts\AbstractPolicy;
use App\Policies\Abstracts\PolicySoftDeletesInterface;
use App\Policies\PolicyPermissions;

class UserPolicy extends AbstractPolicy implements PolicySoftDeletesInterface
{
    protected $modelClass = User::class;
    
    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $this->userCan($user, Abilities::VIEW_ANY);
    }
    
    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function create(User $user)
    {
        return $this->userCan($user, Abilities::CREATE);
    }
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  User  $model
     *
     * @return mixed
     */
    public function update(User $user, $model)
    {
        // TODO for now user can edit itself only. later add condition for companies to edit their own users
        return $this->userCanManageAny($user) || ($this->userCan($user, Abilities::UPDATE) && $user->id === $model->id);
    }
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  User  $model
     *
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        return ($user->id !== $model->id) && ($this->userCanManageAny($user) || $this->userCan($user, Abilities::DELETE));
    }
    
    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  User  $model
     *
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        return ($user->id !== $model->id) && ($this->userCanManageAny($user) || $this->userCan($user, Abilities::RESTORE));
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  User  $model
     *
     * @return mixed
     */
    public function forceDelete(User $user, $model)
    {
        return ($user->id !== $model->id) && ($this->userCanManageAny($user) || $this->userCan($user, Abilities::FORCE_DELETE));
    }
}
