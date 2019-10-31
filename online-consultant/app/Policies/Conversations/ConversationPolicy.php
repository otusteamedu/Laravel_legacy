<?php

namespace App\Policies\Conversations;

use App\Models\Conversation;
use App\Models\User;
use App\Policies\Abilities;
use App\Policies\Abstracts\AbstractPolicy;
use App\Policies\Abstracts\PolicySoftDeletesInterface;

class ConversationPolicy extends AbstractPolicy implements PolicySoftDeletesInterface
{
    protected $modelClass = Conversation::class;
    protected $modelAuthorizedUserIdColumn = 'manager_id';
    
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
     * @param  Conversation  $model
     *
     * @return mixed
     */
    public function update(User $user, $model)
    {
        if ($this->userCanManageAny($user)) {
            return true;
        }
    
        return $this->userCanHandleModel($user, Abilities::UPDATE, $model);
    }
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Conversation  $model
     *
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
    
    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Conversation  $model
     *
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Conversation  $model
     *
     * @return mixed
     */
    public function forceDelete(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
}
