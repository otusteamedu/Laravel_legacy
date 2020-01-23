<?php

namespace App\Services\Products\Repositories;


use App\Models\Products;
use App\Models\WishlistProduct;

interface ProductsRepositoryInterface
{

    /**
     * @param  int  $id
     *
     * @return Products
     */
    public function getProductById(int $id) :Products;

    /**
     * @param  array  $data
     */
    public function create(array $data): void;

    /**
     * @param  WishlistProduct  $wishlistProduct
     */
    public function delete(WishlistProduct $wishlistProduct): void;

    /**
     * @param  array  $data
     *
     * @return array
     */
    public function createProduct(array $data) :array;

    /**
     * @param  array  $productData
     * @param  array  $data
     */
    public function createWishlistProduct(array $productData, array $data) :void;
}