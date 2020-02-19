<?php

namespace App\Services\Products\Repositories;

use App\Models\Products;
use App\Models\WishlistProduct;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Facades\Cache;

class EloquentProductsRepository implements ProductsRepositoryInterface
{
    /** @var Factory */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function getAll() :LengthAwarePaginator
    {
        return Products::paginate();
    }

    /**
     * @inheritDoc
     */
    public function getProductById(int $id) :Products
    {
        return Products::find($id);
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
     * @throws \Exception
     */
    public function delete(WishlistProduct $wishlistProduct) :void
    {
        $wishlistProduct->delete();
    }

    /**
     * @inheritDoc
     */
    public function createProduct(array $data) :array
    {
        $productData = $this->factory->createAs(Products::class,
            'products', ['productTitle' => $data['product_name'],])->toArray();

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
