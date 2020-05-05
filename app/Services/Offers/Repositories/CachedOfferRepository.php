<?php


namespace App\Services\Offers\Repositories;


use App\Models\Offer;
use App\Services\Cache\CacheKeyManager;
use App\Services\Cache\Tag;
use Cache;

class CachedOfferRepository implements CachedOfferRepositoryInterface
{

    const CACHE_SEARCH_SECONDS = 60;

    /** @var OfferRepositoryInterface */
    private $offerRepository;
    /** @var CacheKeyManager */
    private $cacheKeyManager;

    public function __construct(
        OfferRepositoryInterface $offerRepository,
        CacheKeyManager $cacheKeyManager
    )
    {
        $this->offerRepository = $offerRepository;
        $this->cacheKeyManager = $cacheKeyManager;
    }

    public function search(array $filters = [], array $with = [])
    {
        $key = $this->cacheKeyManager->getSearchOffersKey($filters);

        return Cache::tags([Tag::OFFERS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($filters, $with) {
                return $this->offerRepository->search($filters, $with);
            });
    }

    public function clearSearchCache()
    {
        Cache::tags([Tag::CMS, Tag::OFFERS])->flush();
    }

    public function find(int $id)
    {
        $key = $this->cacheKeyManager->getOfferKey($id);
        return Cache::tags([Tag::CMS, Tag::OFFERS])
            ->remember($key, self::CACHE_SEARCH_SECONDS, function () use ($id) {
                return $this->offerRepository->find($id);
            });
    }

    public function clearOfferCache(Offer $country)
    {
        $key = $this->cacheKeyManager->getOfferKey($country->id);
        Cache::forget($key);
        $this->clearSearchCache();
    }
}
