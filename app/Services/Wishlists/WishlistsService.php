<?php
/**
 * @copyright Copyright (c) Archvile
 * @link https://0x25.ru
 */

namespace App\Services\Wishlists;

use App\Models\User;
use App\Models\Wishlist;
use App\Services\Wishlists\Repositories\CachedWishlistsRepositoryInterface;
use App\Services\Wishlists\Repositories\WishlistsRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WishlistsService
{

    /** @var CachedWishlistsRepositoryInterface */
    protected $cachedWishlistsRepository;

    /** @var WishlistsRepositoryInterface */
    protected $wishlistsRepository;

    public function __construct(
        WishlistsRepositoryInterface $wishlistsRepository,
        CachedWishlistsRepositoryInterface $cachedWishlistsRepository)
    {
        $this->cachedWishlistsRepository = $cachedWishlistsRepository;
        $this->wishlistsRepository = $wishlistsRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function index() :LengthAwarePaginator
    {
        /**
         * @var User $user
         */
        $user = \Auth::user();

        return $this->cachedWishlistsRepository->getByUser($user);
    }

    /**
     * @param  Wishlist  $wishlist
     *
     * @return LengthAwarePaginator
     */
    public function products(Wishlist $wishlist) :LengthAwarePaginator
    {
        return $this->cachedWishlistsRepository->getProducts($wishlist);
    }

    /**
     * @param  array  $data
     *
     * @return Wishlist
     */
    public function create(array $data = []) :Wishlist
    {
        return $this->wishlistsRepository->create($data);
    }

}