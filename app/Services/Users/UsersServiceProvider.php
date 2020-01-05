<?php

namespace App\Services\Users;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            'App\Services\Users\Repositories\UserRepositoryInterface',
            'App\Services\Users\Repositories\UserRepository'
        );
    }
}
