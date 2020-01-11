<?php
/**
 * @copyright Copyright (c) Archvile
 * @link https://0x25.ru
 */

namespace App\Services\Wishlists;


use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WishlistsService
{

    /**
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        /**
         * @var $user User
         */
        $user = \Auth::user();
        $wishlists = $user->wishlists()
            ->orderBy('id', 'desc')
            ->paginate();

        return $wishlists;
    }

    /**
     * @param Wishlist $wishlist
     * @return LengthAwarePaginator
     */
    public function products(Wishlist $wishlist): LengthAwarePaginator
    {
        $products = $wishlist->products()
            ->select([
                'wishlist_products.id as wishlistProductsId',
                'products.id',
                'productTitle',
                'productId'
            ])
            ->orderBy('products.updated_at', 'desc')
            ->paginate();

        return $products;
    }

    /**
     * @param array $data
     * @return Wishlist
     */
    public function create(array $data = []): Wishlist
    {
        $wishlist = new Wishlist();
        $wishlist->create($data);

        return $wishlist;
    }

}