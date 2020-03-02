<?php


namespace App\Services\Category;


use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Category\Repositories\ClientCategoryRepository;
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

    public function show(int $id)
    {
        return $this->repository->show($id);
    }
}
