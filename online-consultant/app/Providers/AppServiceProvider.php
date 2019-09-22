<?php

namespace App\Providers;

use App\Repositories\Companies\CompanyRepositoryInterface;
use App\Repositories\Companies\EloquentCompanyRepository;
use App\Repositories\Conversations\ConversationRepositoryInterface;
use App\Repositories\Conversations\EloquentConversationRepository;
use App\Repositories\Leads\EloquentLeadRepository;
use App\Repositories\Leads\LeadRepositoryInterface;
use App\Repositories\Users\EloquentUserRepository;
use App\Repositories\Users\UserRepositoryInterface;
use App\Repositories\Widgets\EloquentWidgetRepository;
use App\Repositories\Widgets\WidgetRepositoryInterface;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(CompanyRepositoryInterface::class, EloquentCompanyRepository::class);
        $this->app->bind(LeadRepositoryInterface::class, EloquentLeadRepository::class);
        $this->app->bind(WidgetRepositoryInterface::class, EloquentWidgetRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(ConversationRepositoryInterface::class, EloquentConversationRepository::class);
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
