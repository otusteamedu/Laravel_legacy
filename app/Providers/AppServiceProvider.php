<?php

namespace App\Providers;

use App\Http\Services\Localize\LocalizeService;
use App\Models\User;
use App\Notifications\SlackAfterJob;
use App\Notifications\SlackFailedJob;
use App\Observers\UserObserver;
use App\Services\ViewControllerMethod;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
        $this->app->bind('Localize', LocalizeService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UserObserver::class);


        $slackUrl = env('SLACK_WEBHOOK_URL'); 

        
        Queue::after(function (JobProcessed $event) use ($slackUrl) {
            Notification::route('slack', $slackUrl)->notify(new SlackAfterJob($event));   
        });  

        Queue::failing(function (JobFailed $event) use ($slackUrl){
            Notification::route('slack', $slackUrl)->notify(new SlackFailedJob($event)); 
       });
    }

    private function registerBindings()
    {
        $this->app->singleton(ViewControllerMethod::class, ViewControllerMethod::class);
    }
}
