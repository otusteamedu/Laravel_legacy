<?php


namespace App\Services\Category\Handlers;


use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Category\Repositories\ClientCategoryRepository;
use Illuminate\Support\Facades\Cache;

class CacheWarmUpHandler
{
    private ClientCategoryRepository $clientRepository;
    private CacheKeyManager $cacheKeyManager;

    public function __construct(
        ClientCategoryRepository $clientRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->clientRepository = $clientRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    /**
     * @param int|null $ttl
     * @return bool
     */
    public function handle(?int $ttl = null)
    {
        $key = $this->cacheKeyManager->getCategoriesKey(['client', 'published']);
        $ttl = $ttl ?? TTL::CATEGORIES_TTL;

        $items = $this->clientRepository->index();

        return Cache::tags(Tag::CATEGORIES_TAG)->put($key, $items, $ttl);
    }
}
