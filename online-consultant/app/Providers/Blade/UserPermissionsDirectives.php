<?php

namespace App\Providers\Blade;

use App\Policies\Abilities;
use App\Traits\Auth\PolicyPermissions;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

trait UserPermissionsDirectives
{
    use PolicyPermissions;
    
    protected $user;
    protected $modelClass;
    
    /**
     * Get shared data from controllers
     */
    private function getSharedValues(): void
    {
        $this->user = View::shared('currentUser');
        $this->modelClass = View::shared('modelClass');
    }
    
    /**
     * Get shared data and check if user has permission
     *
     * @param  string  $ability
     *
     * @return bool
     */
    private function sharedUserCan(string $ability): bool
    {
        $this->getSharedValues();
        
        return $this->userCan($this->user, $ability);
    }
    
    /**
     * Get shared data and check if user doesn't have permission
     *
     * @param  string  $ability
     *
     * @return bool
     */
    private function sharedUserCannot(string $ability): bool
    {
        $this->getSharedValues();
        
        return $this->userCannot($this->user, $ability);
    }
    
    /**
     * Register custom blade directives for user permissions
     */
    public function registerDirectivesForUserPermissions(): void
    {
        Blade::if('userCan', function (string $ability) {
            return $this->sharedUserCan($ability);
        });
        
        Blade::if('userCannot', function (string $ability) {
            return $this->sharedUserCannot($ability);
        });
        
        foreach (Abilities::allAbilities() as $ability) {
            $directiveCanName = sprintf('userCan%s', ucfirst(Str::camel($ability)));
            $directiveCannotName = sprintf('userCannot%s', ucfirst(Str::camel($ability)));
            
            Blade::if($directiveCanName, function () use ($ability) {
                return $this->sharedUserCan($ability);
            });
            
            Blade::if($directiveCannotName, function () use ($ability) {
                return $this->sharedUserCannot($ability);
            });
        }
    }
}
