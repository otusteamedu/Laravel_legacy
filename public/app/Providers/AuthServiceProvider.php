<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\User;

use App\Models\Flow;
use App\Policies\FlowPolicy;

use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Flow::class => FlowPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-owner', function (User $user, $group) {
            foreach ($user->roles as $role) {
                if ($role->slug == 'admin') {
                    return TRUE;
                }
                if ($role->slug == 'admin_group') {
                    return $user->id == $group->created_by;
                }
            }
            return FALSE;
        });

        Gate::define('in-group', function ($group) {
            if (Auth::user()->groups()->find($group->id)) {
                return TRUE;
            } else {
                return FALSE;
            }
        });
    }
}
