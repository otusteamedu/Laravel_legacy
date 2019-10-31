<?php

use App\Policies\Permissions;
use App\Policies\Roles;
use App\Services\Permissions\PermissionService;
use App\Services\Roles\RoleService;
use App\Services\Users\UserService;
use Illuminate\Database\Seeder;

class AppSetupSeeder extends Seeder
{
    private const APP_ADMIN_NAME = 'John Smith';
    private const APP_ADMIN_EMAIL = 'app.admin@online-consultant.test';
    private const APP_ADMIN_PASSWORD = 'app.admin';
    
    private $userService;
    private $roleService;
    private $permissionService;
    
    public function __construct(
        UserService $userService,
        RoleService $roleService,
        PermissionService $permissionService
    ) {
        $this->userService = $userService;
        $this->roleService = $roleService;
        $this->permissionService = $permissionService;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        if (!$this->readyToSeed()) {
            $this->command->error('You must clear your DB before seed! Nothing changed.');
            
            return;
        }
        
        // TODO make console commands for seeding roles and permission
        $this->seedPermissions();
        $this->seedRoles();
        $this->seedAppAdminUser();
    }
    
    /**
     * Confirming user to clear DB and run seed
     *
     * @return bool
     */
    private function readyToSeed(): bool
    {
        $this->command->warn('You must run this seed only once during app setup!');
        
        if ($this->command->confirm('If you continue, all DB data will be lost. Do you want to proceed?')) {
            $this->command->call('migrate:refresh');
            $this->command->warn('Data cleared, starting from blank database.');
            
            return true;
        }
        
        return false;
    }
    
    /**
     * Seed all permissions
     */
    private function seedPermissions(): void
    {
        $this->command->comment('Let\'s create roles permissions');
        
        foreach (Permissions::getAllPermissions() as $permissionName) {
            $this->permissionService->createPermission([
                'name' => $permissionName
            ]);
        }
        
        $this->command->comment('Permissions seeding done');
    }
    
    /**
     * Seed all roles
     */
    private function seedRoles(): void
    {
        $this->command->comment('Let\'s create user roles');
        
        foreach (Roles::getRolesData() as $roleData) {
            $role = $this->roleService->createRole($roleData);
            $this->command->info(sprintf('Role "%s" has been created.', $role->name));
            
            $rolePermissions = Permissions::getPermissionsByRole($role);
            
            if ($rolePermissions) {
                $role->syncPermissions($rolePermissions);
                $this->command->info(sprintf('Permissions for role "%s" has been set.', $role->name));
            }
        }
        
        $this->command->comment('Roles seeding done');
    }
    
    /**
     * Seed App Admin user
     */
    private function seedAppAdminUser(): void
    {
        $this->command->comment('Let\'s create App Admin user');
        
        $this->userService->createUser([
            'name'              => self::APP_ADMIN_NAME,
            'email'             => self::APP_ADMIN_EMAIL,
            'password'          => Hash::make(self::APP_ADMIN_PASSWORD),
            'email_verified_at' => now(),
            'roles'             => [Roles::APP_ADMIN]
        ]);
        
        $this->command->info(sprintf('App Admin user "%s" has been created', self::APP_ADMIN_NAME));
        $this->command->question('Use these credentials to login:');
        $this->command->question(sprintf('E-Mail: %s', self::APP_ADMIN_EMAIL));
        $this->command->question(sprintf('Password: %s', self::APP_ADMIN_PASSWORD));
        $this->command->error('Use this account only to login and create your own user with real email and strong password!');
        
        $this->command->comment('App Admin user seeding done');
    }
}
