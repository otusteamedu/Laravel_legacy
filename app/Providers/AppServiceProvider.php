<?php

namespace App\Providers;

use App\Notifications\SlackFailedJob;
use App\Providers\Views\BladeStatements;
use App\Services\Filters\Repositories\CachedFilterRepository;
use App\Services\Filters\Repositories\CachedFilterRepositoryInterface;
use App\Services\Filters\Repositories\EloquentFilterRepository;
use App\Services\Filters\Repositories\FilterRepositoryInterface;
use App\Services\FilterTypes\Repositories\EloquentFilterTypeRepository;
use App\Services\FilterTypes\Repositories\FilterTypeRepositoryInterface;
use App\Services\Mpolls\Repositories\EloquentMpollRepository;
use App\Services\Mpolls\Repositories\MpollRepositoryInterface;
use Illuminate\Queue\Events\JobFailed;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use Queue;

class AppServiceProvider extends ServiceProvider
{
    use BladeStatements;
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        if($this->app->environment('local', 'testing')){
            $this->app->register(DuskServiceProvider::class);
        }


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeStatements();

        $slackUrl = env('LOG_SLACK_WEBHOOK_URL');
        Queue::failing(function (JobFailed $event) use ($slackUrl) {
            Notification::route('slack', $slackUrl)->notify(new SlackFailedJob($event));
        });
    }


    private function registerBindings()
    {
        $this->app->bind(FilterRepositoryInterface::class, EloquentFilterRepository::class);
        $this->app->bind(CachedFilterRepositoryInterface::class, CachedFilterRepository::class);
        $this->app->bind(FilterTypeRepositoryInterface::class, EloquentFilterTypeRepository::class);
        $this->app->bind(MpollRepositoryInterface::class, EloquentMpollRepository::class);
//        $this->app->bind(CachesService::class);
    }
}
