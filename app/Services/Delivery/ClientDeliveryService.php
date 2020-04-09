<?php


namespace App\Services\Delivery;


use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\Key;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Delivery\Repositories\ClientDeliveryRepository;
use Illuminate\Support\Facades\Cache;

class ClientDeliveryService extends ClientBaseResourceService
{
    /**
     * ClientCategoryService constructor.
     * @param ClientDeliveryRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     */
    public function __construct(
        ClientDeliveryRepository $repository,
        CacheKeyManager $cacheKeyManager
    )
    {
        parent::__construct($repository, $cacheKeyManager);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|mixed
     */
    public function index()
    {
        $key = $this->cacheKeyManager->getResourceKey(Key::DELIVERY_PREFIX, ['published']);

        return Cache::tags(Tag::DELIVERY_TAG)->remember($key, TTL::DELIVERY_TTL, function () {
            return $this->repository->index();
        });
    }
}
