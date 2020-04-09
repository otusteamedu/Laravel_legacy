<?php


namespace App\Services\SettingGroup;


use App\Services\Base\Resource\ClientBaseResourceService;
use App\Services\Cache\Key;
use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\SettingGroup\Repositories\ClientSettingGroupRepository;
use Illuminate\Support\Facades\Cache;

class ClientSettingGroupService extends ClientBaseResourceService
{
    /**
     * ClientCategoryService constructor.
     * @param ClientSettingGroupRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     */
    public function __construct(
        ClientSettingGroupRepository $repository,
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
        $key = $this->cacheKeyManager->getResourceKey(Key::SETTINGS_PREFIX, ['settings']);

        return Cache::tags(Tag::SETTINGS_TAG)->remember($key, TTL::SETTINGS_TTL, function () {
            return $this->repository->getItems();
        });
    }
}
