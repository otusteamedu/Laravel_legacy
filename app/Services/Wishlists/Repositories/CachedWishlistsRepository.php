<?php

namespace App\Services\Wishlists\Repositories;

use App\Events\WishlistTouched;
use App\Listeners\ClearWishlistCache;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CachedWishlistsRepository implements CachedWishlistsRepositoryInterface, WishlistsRepositoryInterface
{

    protected $wishlistsRepository;

    public function __construct(WishlistsRepositoryInterface $wishlistsRepository)
    {
        $this->wishlistsRepository = $wishlistsRepository;
    }

    /**
     * @inheritDoc
     */
    public function getProducts(Wishlist $wishlist)
    {
        $key = md5(request()->fullUrl());

        \Log::info($key);

        event(new WishlistTouched(['foo']));

        return Cache::rememberForever($key, function () use ($wishlist) {
            return $this->wishlistsRepository->getProducts($wishlist);
        });
    }

    public function getByUser(User $user) :LengthAwarePaginator
    {
        $wishlists = $user->wishlists()
            ->orderBy('id', 'desc')
            ->paginate();

        return $wishlists;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data) :Wishlist
    {
        \Log::info(request()->fullUrl());

        $wishlist = new Wishlist();
        $wishlist->create($data);

        return $wishlist;
    }

}
