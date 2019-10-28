<?php

namespace App\Policies;

use App\Models\Company;
use App\Models\Conversation;
use App\Models\Lead;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Models\Widget;

abstract class Permissions
{
    /**
     * All permissions
     *
     * @return array
     */
    public static function getAllPermissions(): array
    {
        return [
            // Companies
            Permission::makeNameFromAbility(Abilities::MANAGE_ANY, Company::class),
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Company::class),
            Permission::makeNameFromAbility(Abilities::CREATE, Company::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Company::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Company::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Company::class),
            Permission::makeNameFromAbility(Abilities::FORCE_DELETE, Company::class),
            
            // Conversations
            Permission::makeNameFromAbility(Abilities::MANAGE_ANY, Conversation::class),
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Conversation::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::FORCE_DELETE, Conversation::class),
            
            // Leads
            Permission::makeNameFromAbility(Abilities::MANAGE_ANY, Lead::class),
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Lead::class),
            Permission::makeNameFromAbility(Abilities::CREATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Lead::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Lead::class),
            Permission::makeNameFromAbility(Abilities::FORCE_DELETE, Lead::class),
            
            // Users
            Permission::makeNameFromAbility(Abilities::MANAGE_ANY, User::class),
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, User::class),
            Permission::makeNameFromAbility(Abilities::CREATE, User::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, User::class),
            Permission::makeNameFromAbility(Abilities::DELETE, User::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, User::class),
            Permission::makeNameFromAbility(Abilities::FORCE_DELETE, User::class),
            
            // Widgets
            Permission::makeNameFromAbility(Abilities::MANAGE_ANY, Widget::class),
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Widget::class),
            Permission::makeNameFromAbility(Abilities::CREATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Widget::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Widget::class),
            Permission::makeNameFromAbility(Abilities::FORCE_DELETE, Widget::class),
        ];
    }
    
    /**
     * Permissions for App User role
     *
     * @return array
     */
    public static function getAppUserPermissions(): array
    {
        return [
            // Companies
            Permission::makeNameFromAbility(Abilities::CREATE, Company::class),
            
            // Conversations
            Permission::makeNameFromAbility(Abilities::UPDATE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Conversation::class),
            
            // Leads
            Permission::makeNameFromAbility(Abilities::CREATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Lead::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Lead::class),
            
            // Users
            Permission::makeNameFromAbility(Abilities::CREATE, User::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, User::class),
            Permission::makeNameFromAbility(Abilities::DELETE, User::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, User::class),
            
            // Widgets
            Permission::makeNameFromAbility(Abilities::CREATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Widget::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Widget::class),
        ];
    }
    
    /**
     * Permissions for App Admin role
     *
     * @return array
     */
    public static function getAppAdminPermissions(): array
    {
        return self::getAllPermissions();
    }
    
    /**
     * Permissions for Company User role
     *
     * @return array
     */
    public static function getCompanyUserPermissions(): array
    {
        return [
        
        ];
    }
    
    /**
     * Permissions for Company Manager role
     *
     * @return array
     */
    public static function getCompanyManagerPermissions(): array
    {
        return [
        
        ];
    }
    
    /**
     * Permissions for Company Admin role
     *
     * @return array
     */
    public static function getCompanyAdminPermissions(): array
    {
        return [
            // Companies
            Permission::makeNameFromAbility(Abilities::UPDATE, Company::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Company::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Company::class),
            
            // Conversations
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Conversation::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Conversation::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Conversation::class),
            
            // Leads
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Lead::class),
            Permission::makeNameFromAbility(Abilities::CREATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Lead::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Lead::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Lead::class),
            
            // Users
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, User::class),
            Permission::makeNameFromAbility(Abilities::CREATE, User::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, User::class),
            Permission::makeNameFromAbility(Abilities::DELETE, User::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, User::class),
            
            // Widgets
            Permission::makeNameFromAbility(Abilities::VIEW_ANY, Widget::class),
            Permission::makeNameFromAbility(Abilities::CREATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::UPDATE, Widget::class),
            Permission::makeNameFromAbility(Abilities::DELETE, Widget::class),
            Permission::makeNameFromAbility(Abilities::RESTORE, Widget::class),
        ];
    }
    
    /**
     * Get permissions for role
     *
     * @param  Role  $role
     *
     * @return mixed
     */
    public static function getPermissionsByRole(Role $role)
    {
        $roleNameWithoutSpaces = str_replace(' ', '', $role->name);
        $permissionsMethodByRoleName = sprintf('get%sPermissions', $roleNameWithoutSpaces);
        
        if (method_exists(self::class, $permissionsMethodByRoleName)) {
            return self::$permissionsMethodByRoleName();
        }
        
        return false;
    }
}
