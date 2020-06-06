<?php

namespace App\Providers;

use App\Models\Project;
use App\Policies\ClientPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\StaffPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Project::class => ProjectPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::resource('staff', StaffPolicy::class);
        Gate::resource('client', ClientPolicy::class);
        Gate::resource('project', ProjectPolicy::class);
    }
}
