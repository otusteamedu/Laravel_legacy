<?php

namespace App\Policies;

/**
 * Class Abilities
 * @package App\Policies
 */
class Abilities
{
    const VIEW_ANY = 'viewAny';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const RESTORE = 'restore';
    const FORCE_DELETE = 'forceDelete';
    const BATCH_CREATE = 'batch-create';
}
