<?php


namespace App\Services\Category;


use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Category\Repositories\ClientCategoryRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ClientCategoryService extends ClientBaseResourceService
{
    public function __construct(
        ClientCategoryRepository $repository,
        CacheKeyManager $cacheKeyManager
    )
    {
        parent::__construct($repository, $cacheKeyManager);
    }

    public function index()
    {
        $key = $this->cacheKeyManager->getCategoriesKey(['client', 'published']);

        return Cache::tags(Tag::CATEGORIES_TAG)->remember($key, TTL::CATEGORIES_TTL, function () {
            return $this->repository->index();
        });
    }

    public function getImages(array $pagination, int $categoryId)
    {
        $category = $this->repository->show($categoryId);
        $paginateData = $this->repository->getImages($category, $pagination);

        $key = $this->cacheKeyManager->getCategoriesKey(
            Arr::collapse([['client', 'category_' . $categoryId, 'images'], Arr::flatten($pagination)])
        );

        return Cache::tags(Tag::CATEGORIES_TAG)
            ->remember($key, TTL::CATEGORIES_TTL, function () use ($paginateData) {
                return $paginateData;
            });
    }

    public function getItemWithImages(array $pagination, string $categoryAlias)
    {
        $category = $this->repository->getItemByAlias($categoryAlias);
        $paginateData = $this->repository->getImages($category, $pagination);

        $key = $this->cacheKeyManager->getCategoriesKey(
            Arr::collapse([['client', $category->alias, 'with-images'], Arr::flatten($pagination)])
        );

        return Cache::tags(Tag::CATEGORIES_TAG)
            ->remember($key, TTL::CATEGORIES_TTL, function () use ($category, $paginateData) {
            return ['item' => $category, 'paginateData' => $paginateData];
        });
    }
}
