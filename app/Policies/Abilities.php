<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class Abilities
{
    use HandlesAuthorization;

    const VIEW_ANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const EDIT = 'edit';
    const DELETE = 'delete';
    const RESTORE = 'restore';
    const FORCE_DELETE = 'forceDelete';

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
