<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Category;
use App\Models\Compilation;
use App\Models\Favorite;
use App\Models\Handbook;
use App\Models\Journal;
use App\Models\Material;
use App\Models\Review;
use App\Models\User;
use App\Services\Authors\Repositories\CachedAuthorRepository;
use App\Services\Authors\Repositories\EloquentAuthorRepository;
use App\Services\Cache\CacheKeyManager;
use App\Services\Categories\Repositories\CachedCategoryRepository;
use App\Services\Categories\Repositories\EloquentCategoryRepository;
use App\Services\Compilations\Repositories\CachedCompilationRepository;
use App\Services\Compilations\Repositories\EloquentCompilationRepository;
use App\Services\Favorites\Repositories\CachedFavoriteRepository;
use App\Services\Favorites\Repositories\EloquentFavoriteRepository;
use App\Services\Handbooks\Repositories\CachedHandbookRepository;
use App\Services\Handbooks\Repositories\EloquentHandbookRepository;
use App\Services\Journals\Repositories\CachedJournalRepository;
use App\Services\Journals\Repositories\EloquentJournalsRepository;
use App\Services\Materials\Repositories\CachedMaterialRepository;
use App\Services\Materials\Repositories\EloquentMaterialRepository;
use App\Services\Reviews\Repositories\CachedReviewRepository;
use App\Services\Reviews\Repositories\EloquentReviewsRepository;
use App\Services\Users\Repositories\EloquentUserRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class CacheWarmUp extends Command {

    private $entities = [
        'Author' => Author::class,
        'Category' => Category::class,
        'Compilation' => Compilation::class,
        'Favorite' => Favorite::class,
        'Handbook' => Handbook::class,
        'Journal' => Journal::class,
        'Material' => Material::class,
        'Review' => Review::class,
    ];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache:warm-up 
                            {entity? : model name (Author, Category etc). } 
                            {--all : select all entities}
                            {--select : select entity from list}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'warming up entities cache';

    /**
     * @param CacheKeyManager $cacheKeyManager
     */
    public function handle(CacheKeyManager $cacheKeyManager) {
        $options = $this->options();
        $arguments = $this->arguments();
        $dateStart = new \DateTime();
        echo 'start ' . $dateStart->format('d.m.Y H:i:s');

        if (!$options['all'] && !$options['select'] && !$arguments['entity']) {
            echo "no entity select \n\r";
            return;
        }

        if ($options['all']) {
           $this->createCacheForAllEntities($cacheKeyManager);
            return;
        }

        if ($options['select']) {
            $entity = $this->choice('Select entity:', array_values($this->entities), Material::class);
            $this->createEntityCache($entity, $cacheKeyManager);
            return;
        }

        if ($this->isEntityExist($arguments['entity'])) {
          $this->createEntityCache($this->entities[$arguments['entity']], $cacheKeyManager);
        }
        $dateEnd = new \DateTime();
        echo "\n\r";
        echo 'stop ' . $dateEnd->format('d.m.Y H:i:s');
    }

    private function createCacheForAllEntities(CacheKeyManager $cacheKeyManager) {
        foreach ($this->entities as $entity) {
            $this->createEntityCache($entity, $cacheKeyManager);
        }
    }

    private function createEntityCache(string $entity, CacheKeyManager $cacheKeyManager): void {

        $repository = $this->getRepositoryToMakeCache($entity, $cacheKeyManager);
        if (!$repository) {
            echo 'repository not found';
        }

        if (is_object($repository) && method_exists($repository, 'search')) {
            $repository->search();
            return;
        }
    }

    private function isEntityExist($entityName) {
        if (class_exists($this->entities[$entityName])) {
            return true;
        }
        return false;
    }

    private function getRepositoryToMakeCache($entityClass, CacheKeyManager $cacheKeyManager) {

        $eloquentRepository = $this->getEloquentRepository($entityClass);
        if (!$eloquentRepository) {
            return null;
        }

        $cachedRepositoryList = [
            Author::class => CachedAuthorRepository::class,
            Category::class => CachedCategoryRepository::class,
            Compilation::class => CachedCompilationRepository::class,
            Favorite::class => CachedFavoriteRepository::class,
            Handbook::class => CachedHandbookRepository::class,
            Journal::class => CachedJournalRepository::class,
            Material::class => CachedMaterialRepository::class,
            Review::class => CachedReviewRepository::class,
        ];

        if ($cachedRepositoryList[$entityClass]) {
           return  App::make($cachedRepositoryList[$entityClass],[$eloquentRepository, $cacheKeyManager]);
        }

        return null;
    }

    private function getEloquentRepository(string $entityClass) {
        $eloquentRepository = [
            Author::class => EloquentAuthorRepository::class,
            Category::class => EloquentCategoryRepository::class,
            Compilation::class => EloquentCompilationRepository::class,
            Favorite::class => EloquentFavoriteRepository::class,
            Handbook::class => EloquentHandbookRepository::class,
            Journal::class => EloquentJournalsRepository::class,
            Material::class => EloquentMaterialRepository::class,
            Review::class => EloquentReviewsRepository::class,
            User::class => EloquentUserRepository::class,
        ];

        if ($eloquentRepository[$entityClass]) {
           return App::make($eloquentRepository[$entityClass]);
        }
        return null;
    }
}
