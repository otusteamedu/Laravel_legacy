<?php

namespace App\Services\Helpers;

/**
 * Class Ability
 * @package App\Services\Helpers
 */
class Ability
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';

    const CREATE_TEACHER = 'create-teacher';
    const UPDATE_TEACHER = 'update-teacher';
    const DELETE_TEACHER = 'delete-teacher';
    const CHANGE_SETTINGS = 'change-settings';
}
