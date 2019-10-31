<?php

namespace App\Policies;

abstract class Abilities
{
    const MANAGE_ANY = 'manage any';
    const VIEW_ANY = 'view any';
    const VIEW = 'view';
    const CREATE = 'create';
    const UPDATE = 'update';
    const DELETE = 'delete';
    const RESTORE = 'restore';
    const FORCE_DELETE = 'force delete';
    
    /**
     * Get all abilities
     *
     * @return array
     */
    public static function allAbilities(): array
    {
        return [
            self::MANAGE_ANY,
            self::VIEW_ANY,
            self::VIEW,
            self::CREATE,
            self::UPDATE,
            self::DELETE,
            self::RESTORE,
            self::FORCE_DELETE
        ];
    }
}
