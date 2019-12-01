<?php

namespace App\Providers;

use App\Services\Authors\Repositories\AuthorRepositoryInterface;
use App\Services\Authors\Repositories\CachedAuthorRepository;
use App\Services\Authors\Repositories\CachedAuthorRepositoryInterface;
use App\Services\Authors\Repositories\EloquentAuthorRepository;
use App\Services\Categories\Repositories\CachedCategoryRepositoryInterface;
use App\Services\Categories\Repositories\CachedCategoryRepository;
use App\Services\Categories\Repositories\CategoryRepositoryInterface;
use App\Services\Categories\Repositories\EloquentCategoryRepository;
use App\Services\Compilations\Repositories\CompilationRepositoryInterface;
use App\Services\Compilations\Repositories\EloquentCompilationRepository;
use App\Services\Favorites\Repositories\EloquentFavoriteRepository;
use App\Services\Favorites\Repositories\FavoriteRepositoryInterface;
use App\Services\Handbooks\Repositories\EloquentHandbookRepository;
use App\Services\Handbooks\Repositories\HandbookRepositoryInterface;
use App\Services\Journals\Repositories\EloquentJournalsRepository;
use App\Services\Journals\Repositories\JournalsRepositoryInterface;
use App\Services\Materials\Repositories\EloquentMaterialRepository;
use App\Services\Materials\Repositories\MaterialsRepositoryInterface;
use App\Services\Reviews\Repositories\EloquentReviewsRepository;
use App\Services\Reviews\Repositories\ReviewsRepositoryInterface;
use App\Services\SelectionMaterials\Repositories\EloquentSelectionMaterialsRepository;
use App\Services\SelectionMaterials\Repositories\SelectionMaterialsRepositoryInterface;
use App\Services\Users\Repositories\EloquentUserRepository;
use App\Services\Users\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use function Psy\bin;

class AppServiceProvider extends ServiceProvider {
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);

        $this->app->bind(AuthorRepositoryInterface::class, EloquentAuthorRepository::class);
        $this->app->bind(CachedAuthorRepositoryInterface::class, CachedAuthorRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(CachedCategoryRepositoryInterface::class, CachedCategoryRepository::class);

        $this->app->bind(CompilationRepositoryInterface::class, EloquentCompilationRepository::class);
        $this->app->bind(FavoriteRepositoryInterface::class, EloquentFavoriteRepository::class);
        $this->app->bind(HandbookRepositoryInterface::class, EloquentHandbookRepository::class);
        $this->app->bind(JournalsRepositoryInterface::class, EloquentJournalsRepository::class);
        $this->app->bind(MaterialsRepositoryInterface::class, EloquentMaterialRepository::class);
        $this->app->bind(ReviewsRepositoryInterface::class, EloquentReviewsRepository::class);
        $this->app->bind(SelectionMaterialsRepositoryInterface::class, EloquentSelectionMaterialsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        //
    }

}
