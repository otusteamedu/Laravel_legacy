<?php

namespace App\Services\Products\Repositories;


use App\Models\Products;
use App\Models\WishlistProduct;
use Illuminate\Contracts\Pagination;

interface ProductsRepositoryInterface
{

    /**
     * @return Pagination\LengthAwarePaginator
     */
    public function getAll() :Pagination\LengthAwarePaginator;

    /**
     * @param  int  $id
     *
     * @return Products
     */
    public function getProductById(int $id) :Products;

    /**
     * @param  array  $data
     *
     * @return array
     */
    public function create(array $data) :array;

    /**
     * @param  WishlistProduct  $wishlistProduct
     */
    public function delete(WishlistProduct $wishlistProduct) :void;

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

    /**
     * @param  int  $id
     */
    public function deleteProduct(int $id) :void;
}