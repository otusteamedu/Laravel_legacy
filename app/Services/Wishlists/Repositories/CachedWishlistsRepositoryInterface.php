<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Wishlists\Repositories;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CachedWishlistsRepositoryInterface
{
    /**
     * @param  User  $user
     *
     * @return LengthAwarePaginator
     */
    public function getByUser(User $user) :LengthAwarePaginator;

    /**
     * @param  Wishlist  $wishlist
     *
     * @return mixed
     */
    public function getProducts(Wishlist $wishlist);

    /**
     * @return mixed
     */
    public function clearCache();
}
