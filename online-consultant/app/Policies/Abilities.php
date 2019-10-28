<?php

namespace App\Policies;

abstract class Abilities
{
    public const MANAGE_ANY = 'manage any';
    public const VIEW_ANY = 'view any';
    public const VIEW = 'view';
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const DELETE = 'delete';
    public const RESTORE = 'restore';
    public const FORCE_DELETE = 'force delete';
    
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
