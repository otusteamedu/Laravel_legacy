<?php

namespace App\Providers;

use App\Providers\Blade\UserPermissionsDirectives;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    use UserPermissionsDirectives;
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerDirectivesForUserPermissions();
    }
}
