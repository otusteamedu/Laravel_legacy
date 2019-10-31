<?php

namespace App\Policies;

abstract class Roles
{
    const COMPANY_USER = 10;
    const COMPANY_MANAGER = 50;
    const COMPANY_ADMIN = 90;
    const APP_USER = 500;
    const APP_ADMIN = 900;
    
    /**
     * Get roles data
     *
     * @return array
     */
    public static function getRolesData(): array
    {
        return [
            [
                'id' => self::COMPANY_USER,
                'name' => 'Company User'
            ],
            [
                'id' => self::COMPANY_MANAGER,
                'name' => 'Company Manager'
            ],
            [
                'id' => self::COMPANY_ADMIN,
                'name' => 'Company Admin'
            ],
            [
                'id' => self::APP_USER,
                'name' => 'App User'
            ],
            [
                'id' => self::APP_ADMIN,
                'name' => 'App Admin'
            ],
        ];
    }
    
    /**
     * All roles
     *
     * @return array
     */
    public static function allRoles(): array
    {
        return array_merge(
            self::appRoles(),
            self::companyRoles()
        );
    }
    
    /**
     * Roles used by company users
     *
     * @return array
     */
    public static function companyRoles(): array
    {
        return [
            self::COMPANY_USER,
            self::COMPANY_MANAGER,
            self::COMPANY_ADMIN
        ];
    }
    
    /**
     * Roles used by app users
     *
     * @return array
     */
    public static function appRoles(): array
    {
        return [
            self::APP_USER,
            self::APP_ADMIN
        ];
    }
}
