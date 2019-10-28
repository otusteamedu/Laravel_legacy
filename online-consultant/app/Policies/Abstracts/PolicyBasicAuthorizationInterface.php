<?php

namespace App\Policies\Abstracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface PolicyBasicAuthorizationInterface
{
    /**
     * Determine whether the user can view any models.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function viewAny(User $user);
    
    /**
     * Determine whether the user can create models.
     *
     * @param  User  $user
     *
     * @return mixed
     */
    public function create(User $user);
    
    /**
     * Determine whether the user can update the model.
     *
     * @param  User  $user
     * @param  Model  $model
     *
     * @return mixed
     */
    public function update(User $user, $model);
    
    /**
     * Determine whether the user can delete the model.
     *
     * @param  User  $user
     * @param  Model  $model
     *
     * @return mixed
     */
    public function delete(User $user, $model);
}
