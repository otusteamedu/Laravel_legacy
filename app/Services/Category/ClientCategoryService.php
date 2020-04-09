<?php


namespace App\Services\Category;


use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Category\Handlers\GetFiltersHandler;
use App\Services\Category\Handlers\GetWishListFiltersHandler;
use App\Services\Category\Repositories\ClientCategoryRepository;
use App\Services\Tag\Repositories\ClientTagRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ClientCategoryService extends ClientBaseResourceService
{
    private ClientTagRepository $tagRepository;
    private GetFiltersHandler $getFiltersHandler;
    private GetWishListFiltersHandler $getWishListFiltersHandler;

    /**
     * ClientCategoryService constructor.
     * @param ClientCategoryRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     * @param ClientTagRepository $tagRepository
     * @param GetFiltersHandler $getFiltersHandler
     * @param GetWishListFiltersHandler $getWishListFiltersHandler
     */
    public function __construct(
        ClientCategoryRepository $repository,
        CacheKeyManager $cacheKeyManager,
        ClientTagRepository $tagRepository,
        GetFiltersHandler $getFiltersHandler,
        GetWishListFiltersHandler $getWishListFiltersHandler
    )
    {
        parent::__construct($repository, $cacheKeyManager);
        $this->tagRepository = $tagRepository;
        $this->getFiltersHandler = $getFiltersHandler;
        $this->getWishListFiltersHandler = $getWishListFiltersHandler;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function index()
    {
        $key = $this->cacheKeyManager->getCategoriesKey(['client', 'published']);

        return Cache::tags(Tag::CATEGORIES_TAG)->remember($key, TTL::CATEGORIES_TTL, function () {
            return $this->repository->index();
        });
    }

    /**
     * @param string $alias
     * @return mixed
     */
    public function getItemByAlias(string $alias)
    {
        $categoryKey = $this->cacheKeyManager->getCategoriesKey(['client', $alias]);

        return Cache::tags(Tag::CATEGORIES_TAG)
            ->remember($categoryKey, TTL::CATEGORIES_TTL, function () use ($alias) {
                return $this->repository->getItemByAlias($alias);
            });
    }

    /**
     * @param int $categoryId
     * @param array $requestData
     * @return mixed
     */
    public function getImages(int $categoryId, array $requestData)
    {
        list('filter' => $filter, 'pagination' => $pagination) = $requestData;

        $category = $this->repository->getItem($categoryId);
        $paginateData = $this->repository->getImages($category, $pagination, $filter);

        $filtersKey = [];

        if ($filter !== null) {
            foreach($filter as $key => $field) {
                $filtersKey[$key] = ($key . '_' . implode('_', $field));
            }
        }

        $key = $this->cacheKeyManager->getImagesKey(
            Arr::collapse([
                ['client', $category->alias, 'images'],
                Arr::flatten($pagination),
                Arr::flatten($filtersKey)
            ]),
        );

        return Cache::tags(Tag::IMAGES_TAG)
            ->remember($key, TTL::IMAGES_TTL, function () use ($paginateData) {
                return $paginateData;
            });
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function getFilters(int $categoryId): array
    {
        $filters = $this->getFiltersHandler->handle($categoryId);

        $key = $this->cacheKeyManager->getCategoriesKey(['client', 'category_' . $categoryId, 'filters']);

        return Cache::tags(Tag::CATEGORIES_TAG)
            ->remember($key, TTL::CATEGORIES_TTL, function () use ($filters) {
                return $filters;
            });
    }

    /**
     * WishList Filters
     * @param array $ids
     * @return array
     */
    public function getFiltersByImageIds(array $ids): array
    {
        $filters = $this->getWishListFiltersHandler->handle($ids);

        $key = $this->cacheKeyManager->getCategoriesKey(['client', 'wishList_' . implode('.', $ids), 'filters']);

        return Cache::tags(Tag::CATEGORIES_TAG)
            ->remember($key, TTL::CATEGORIES_TTL, function () use ($filters) {
                return $filters;
            });
    }
}
