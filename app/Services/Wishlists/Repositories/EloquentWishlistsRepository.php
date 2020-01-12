<?php

namespace App\Services\Wishlists\Repositories;

use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentWishlistsRepository implements WishlistsRepositoryInterface
{

    /**
     * @inheritDoc
     */
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
    public function getProducts(Wishlist $wishlist) :LengthAwarePaginator
    {
        $products = $wishlist->products()
            ->select([
                'wishlist_products.id as wishlistProductsId',
                'products.id',
                'productTitle',
                'productId',
            ])
            ->orderBy('products.updated_at', 'desc')
            ->paginate();

        return $products;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data) :Wishlist
    {
        $wishlist = new Wishlist();
        $wishlist->create($data);

        return $wishlist;
    }
}