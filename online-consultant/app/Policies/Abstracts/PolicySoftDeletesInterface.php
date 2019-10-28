<?php

namespace App\Policies\Abstracts;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

interface PolicySoftDeletesInterface
{
    /**
     * Determine whether the user can restore the model.
     *
     * @param  User  $user
     * @param  Model  $model
     *
     * @return mixed
     */
    public function restore(User $user, $model);
    
    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  User  $user
     * @param  Model  $model
     *
     * @return mixed
     */
    public function forceDelete(User $user, $model);
}
