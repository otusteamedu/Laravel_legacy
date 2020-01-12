<?php

namespace App\Services\Products\Repositories;

use App\Models\Products;
use App\Models\WishlistProduct;
use Illuminate\Database\Eloquent\Factory;

class EloquentProductsRepository implements ProductsRepositoryInterface
{
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function create(array $data = []) :void
    {
        $productData = $this->createProduct($data);
        $this->createWishlistProduct($productData, $data);
    }

    /**
     * @inheritDoc
     */
    public function createProduct(array $data) :array
    {
        $productData = $this->factory->raw(Products::class);
        $productData['productTitle'] = $data['product_name'];

        $product = new Products();
        $product->create($productData);

        return $productData;
    }

    /**
     * @inheritDoc
     */
    public function createWishlistProduct(array $productData, array $data) :void
    {
        $wishlistProductData['wishlist_id'] = $data['wishlist_id'];
        $wishlistProductData['product_id'] = $productData['productId'];

        $wishlistProduct = new WishlistProduct();
        $wishlistProduct->create($wishlistProductData);
    }

}