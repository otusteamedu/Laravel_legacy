<?php

namespace App\Policies\Abstracts;

use App\Traits\Auth\PolicyPermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

abstract class AbstractPolicy implements PolicyBasicAuthorizationInterface
{
    use HandlesAuthorization, PolicyPermissions;
    
    protected $modelClass;
    protected $modelAuthorizedUserIdColumn;
}
