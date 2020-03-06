<?php


namespace App\Services\Image;


use App\Services\Cache\KeyManager as CacheKeyManager;
use App\Services\Cache\Tag;
use App\Services\Cache\TTL;
use App\Services\Image\Repositories\ClientImageRepository;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class ClientImageService
{
    private ClientImageRepository $repository;

    private CacheKeyManager $cacheKeyManager;

    /**
     * ClientImageService constructor.
     * @param ClientImageRepository $repository
     * @param CacheKeyManager $cacheKeyManager
     */
    public function __construct(
        ClientImageRepository $repository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->repository = $repository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function getPublishedImages($paginateData)
    {
        $key = $this->cacheKeyManager
            ->getImagesKey(Arr::collapse([['client', 'published'], Arr::flatten($paginateData)]));

        return Cache::tags(Tag::IMAGES_TAG)
            ->remember($key, TTL::IMAGES_TTL, function () use ($paginateData) {
            return $this->repository->getPublishedImages($paginateData);
        });
    }
}
