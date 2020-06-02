<?php

namespace App\Providers;

use App\Services\Users\Repositories\EloquentUsersRepository;
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
        $this->app->bind(UsersRepositoryInterface::class, EloquentUsersRepository::class);
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
    }
}
