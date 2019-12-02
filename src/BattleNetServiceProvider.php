<?php

namespace Gerfey\BattleNet;

use Gerfey\BattleNet\Http\BattleNetClient;
use Illuminate\Support\ServiceProvider;

class BattleNetServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('BattleNetClient', BattleNetClient::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
