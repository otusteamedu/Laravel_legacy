<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Offer;
use App\Models\Project;
use App\Models\Segment;
use App\Models\Tariff;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\CityPolicy;
use App\Policies\CountryPolicy;
use App\Policies\OfferPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\SegmentPolicy;
use App\Policies\TariffPolicy;
use App\Policies\UserPolicy;
use App\Services\Segments\Repositories\SegmentRepositoryInterface;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Tariff::class => TariffPolicy::class,
        City::class => CityPolicy::class,
        Country::class => CountryPolicy::class,
        Segment::class => SegmentPolicy::class,
        User::class => UserPolicy::class,
        Category::class => CategoryPolicy::class,
        Project::class => ProjectPolicy::class,
        Offer::class => OfferPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('view-cms', function ($user) {
            return config('user-actions.'.$user->role.'.cms.view', config('user-actions.default-value-if-null'));
        });
    }
}
