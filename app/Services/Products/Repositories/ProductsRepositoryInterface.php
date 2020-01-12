<?php

namespace App\Services\Products\Repositories;


interface ProductsRepositoryInterface
{

    /**
     * @param  array  $data
     */
    public function create(array $data): void;

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