<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Services\Wishlists\Repositories;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface WishlistsRepositoryInterface
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
     * @return LengthAwarePaginator
     */
    public function getProducts(Wishlist $wishlist) :LengthAwarePaginator;

    /**
     * @param  array  $data
     *
     * @return Wishlist
     */
    public function create(array $data) :Wishlist;
}