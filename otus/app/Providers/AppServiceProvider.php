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
use App\Services\Compilations\Repositories\CachedCompilationRepository;
use App\Services\Compilations\Repositories\CachedCompilationRepositoryInterface;
use App\Services\Compilations\Repositories\CompilationRepositoryInterface;
use App\Services\Compilations\Repositories\EloquentCompilationRepository;
use App\Services\Favorites\Repositories\CachedFavoriteRepositoryInterface;
use App\Services\Favorites\Repositories\CachedFavoriteRepository;
use App\Services\Favorites\Repositories\EloquentFavoriteRepository;
use App\Services\Favorites\Repositories\FavoriteRepositoryInterface;
use App\Services\Handbooks\Repositories\CachedHandbookRepository;
use App\Services\Handbooks\Repositories\CachedHandbookRepositoryInterface;
use App\Services\Handbooks\Repositories\EloquentHandbookRepository;
use App\Services\Handbooks\Repositories\HandbookRepositoryInterface;
use App\Services\Journals\Repositories\CachedJournalRepository;
use App\Services\Journals\Repositories\CachedJournalRepositoryInterface;
use App\Services\Journals\Repositories\EloquentJournalsRepository;
use App\Services\Journals\Repositories\JournalsRepositoryInterface;
use App\Services\Materials\Repositories\CachedMaterialRepository;
use App\Services\Materials\Repositories\CachedMaterialRepositoryInterface;
use App\Services\Materials\Repositories\EloquentMaterialRepository;
use App\Services\Materials\Repositories\MaterialsRepositoryInterface;
use App\Services\Reviews\Repositories\CachedReviewRepository;
use App\Services\Reviews\Repositories\CachedReviewRepositoryInterface;
use App\Services\Reviews\Repositories\EloquentReviewsRepository;
use App\Services\Reviews\Repositories\ReviewsRepositoryInterface;
use App\Services\SelectionMaterials\Repositories\CachedSelectionMaterialRepository;
use App\Services\SelectionMaterials\Repositories\CachedSelectionMaterialRepositoryInterface;
use App\Services\SelectionMaterials\Repositories\EloquentSelectionMaterialsRepository;
use App\Services\SelectionMaterials\Repositories\SelectionMaterialsRepositoryInterface;
use App\Services\Users\Repositories\CachedUserRepository;
use App\Services\Users\Repositories\CachedUserRepositoryInterface;
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
        $this->app->bind(CachedUserRepositoryInterface::class, CachedUserRepository::class);

        $this->app->bind(AuthorRepositoryInterface::class, EloquentAuthorRepository::class);
        $this->app->bind(CachedAuthorRepositoryInterface::class, CachedAuthorRepository::class);

        $this->app->bind(CategoryRepositoryInterface::class, EloquentCategoryRepository::class);
        $this->app->bind(CachedCategoryRepositoryInterface::class, CachedCategoryRepository::class);

        $this->app->bind(CompilationRepositoryInterface::class, EloquentCompilationRepository::class);
        $this->app->bind(CachedCompilationRepositoryInterface::class, CachedCompilationRepository::class);

        $this->app->bind(FavoriteRepositoryInterface::class, EloquentFavoriteRepository::class);
        $this->app->bind(CachedFavoriteRepositoryInterface::class, CachedFavoriteRepository::class);

        $this->app->bind(HandbookRepositoryInterface::class, EloquentHandbookRepository::class);
        $this->app->bind(CachedHandbookRepositoryInterface::class, CachedHandbookRepository::class);

        $this->app->bind(JournalsRepositoryInterface::class, EloquentJournalsRepository::class);
        $this->app->bind(CachedJournalRepositoryInterface::class, CachedJournalRepository::class);

        $this->app->bind(MaterialsRepositoryInterface::class, EloquentMaterialRepository::class);
        $this->app->bind(CachedMaterialRepositoryInterface::class, CachedMaterialRepository::class);

        $this->app->bind(ReviewsRepositoryInterface::class, EloquentReviewsRepository::class);
        $this->app->bind(CachedReviewRepositoryInterface::class, CachedReviewRepository::class);

        $this->app->bind(SelectionMaterialsRepositoryInterface::class, EloquentSelectionMaterialsRepository::class);
        $this->app->bind(CachedSelectionMaterialRepositoryInterface::class, CachedSelectionMaterialRepository::class);
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
