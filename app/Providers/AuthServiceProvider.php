<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\User;
use Auth;
use App\Models\Transaction;
use App\Policies\TransactionPolicy;
use App\Models\Reason;
use App\Policies\ReasonPolicy;
use Laravel\Passport\Passport;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Transaction::class => TransactionPolicy::class,
        Reason::class => ReasonPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-owner', function ($user, $student) {

                if ($user->role_id == 1) {
                    return TRUE;
                }

                if ($user->role_id == 2) {
                    return $user->id === $student->created_by;
                }

            return FALSE;
        });


        Passport::routes();

        Passport::tokensCan([
            'user.students'=>'see your students',
        ]);

    }
}
