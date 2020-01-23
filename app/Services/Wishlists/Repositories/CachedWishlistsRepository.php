<?php

namespace App\Services\Wishlists\Repositories;

use App\Models\User;
use App\Models\Wishlist;
use App\Services\Cache\CacheManagerInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use App\Services\Cache\CacheTags;

class CachedWishlistsRepository implements CachedWishlistsRepositoryInterface
{

    /** @var WishlistsRepositoryInterface */
    protected $wishlistsRepository;

    /** @var CacheManagerInterface */
    protected $cacheManager;

    public function __construct(
        WishlistsRepositoryInterface $wishlistsRepository,
        CacheManagerInterface $cacheManager
    ) {
        $this->wishlistsRepository = $wishlistsRepository;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @param  User  $user
     *
     * @return LengthAwarePaginator
     */
    public function getByUser(User $user) :LengthAwarePaginator
    {
        return Cache::tags(CacheTags::WHISHLIST)
            ->rememberForever($this->cacheManager->authCacheKey(), function () use ($user) {
                return $this->wishlistsRepository->getByUser($user);
            });
    }

    /**
     * @inheritDoc
     */
    public function getProducts(Wishlist $wishlist)
    {
        return Cache::tags(CacheTags::WHISHLIST)
            ->rememberForever($this->cacheManager->authCacheKey(), function () use ($wishlist) {
                return $this->wishlistsRepository->getProducts($wishlist);
            });
    }

    public function clearCache(): void
    {
        $this->cacheManager->flushTags(CacheTags::WHISHLIST);
    }

}
