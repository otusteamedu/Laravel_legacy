<?php


namespace App\Services\Emails;

use Illuminate\Support\ServiceProvider;

class EmailsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            'App\Services\Emails\Repositories\EmailRepositoryInterface',
            'App\Services\Emails\Repositories\EmailRepository'
        );
    }
}
