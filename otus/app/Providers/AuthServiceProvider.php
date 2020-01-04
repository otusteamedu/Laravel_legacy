<?php

namespace App\Providers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Compilation;
use App\Models\Favorite;
use App\Models\Handbook;
use App\Models\Journal;
use App\Models\Material;
use App\Models\Review;
use App\Models\SelectionMaterial;
use App\Models\User;
use App\Policies\AuthorPolicy;
use App\Policies\CategoryPolicy;
use App\Policies\CompilationPolicy;
use App\Policies\FavoritePolicy;
use App\Policies\HandbookPolicy;
use App\Policies\JournalPolicy;
use App\Policies\MaterialPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\SelectionMaterialPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Author::class => AuthorPolicy::class,
        Category::class => CategoryPolicy::class,
        Compilation::class => CompilationPolicy::class,
        Favorite::class => FavoritePolicy::class,
        Handbook::class => HandbookPolicy::class,
        Journal::class => JournalPolicy::class,
        Material::class => MaterialPolicy::class,
        Review::class => ReviewPolicy::class,
        SelectionMaterial::class => SelectionMaterialPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        $this->registerPolicies();
        Passport::routes();
        Passport::enableImplicitGrant();
    }
}
