<?php

namespace App\Providers;

use App\Models\Project;
use App\Models\User;
use App\Observers\ProjectObserver;
use App\Observers\UserObserver;
use App\Services\Projects\Repositories\EloquentCacheProjectsRepository;
use App\Services\Projects\Repositories\ProjectsRepositoryInterface;
use App\Services\Users\Repositories\EloquentCacheUsersRepository;
use App\Services\Users\Repositories\UsersRepositoryInterface;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UsersRepositoryInterface::class, EloquentCacheUsersRepository::class);
        $this->app->bind(ProjectsRepositoryInterface::class, EloquentCacheProjectsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('moneyFormat', function ($money) {
            return "<?php echo number_format($money, 2, ',', ' ') . 'р.'; ?>";
        });

        User::observe(UserObserver::class);
        Project::observe(ProjectObserver::class);
    }
}
