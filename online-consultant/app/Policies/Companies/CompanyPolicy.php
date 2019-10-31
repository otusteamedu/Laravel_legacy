<?php

namespace App\Policies\Companies;

use App\Models\Company;
use App\Models\User;
use App\Policies\Abilities;
use App\Policies\Abstracts\AbstractPolicy;
use App\Policies\Abstracts\PolicySoftDeletesInterface;
use App\Traits\PolicyPermissions;

class CompanyPolicy extends AbstractPolicy implements PolicySoftDeletesInterface
{
    protected $modelClass = Company::class;
    protected $modelAuthorizedUserIdColumn = 'created_user_id';
    
    /**
     * Determine whether the user can view any companies.
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
     * Determine whether the user can create companies.
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
     * Determine whether the user can update the company.
     *
     * @param  User  $user
     * @param  Company  $model
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
     * Determine whether the user can delete the company.
     *
     * @param  User  $user
     * @param  Company  $model
     *
     * @return mixed
     */
    public function delete(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
    
    /**
     * Determine whether the user can restore the company.
     *
     * @param  User  $user
     * @param  Company  $model
     *
     * @return mixed
     */
    public function restore(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
    
    /**
     * Determine whether the user can permanently delete the company.
     *
     * @param  User  $user
     * @param  Company  $model
     *
     * @return mixed
     */
    public function forceDelete(User $user, $model)
    {
        return $this->userCanManageAny($user);
    }
}
