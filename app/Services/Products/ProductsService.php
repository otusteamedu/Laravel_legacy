<?php
/**
 * @copyright Copyright (c) Archvile
 * @link https://0x25.ru
 */

namespace App\Services\Products;


use App\Events\Http\CreateProductEvent;
use App\Models\Products;
use App\Models\WishlistProduct;
use App\Services\Products\Repositories\CachedProductsRepositoryInterface;
use App\Services\Products\Repositories\ProductsRepositoryInterface;

class ProductsService
{
    /** @var ProductsRepositoryInterface */
    protected $productsRepository;
    /** @var CachedProductsRepositoryInterface */
    protected $cachedProductsRepository;

    public function __construct(
        ProductsRepositoryInterface $productsRepository,
        CachedProductsRepositoryInterface $cachedProductsRepository
    ) {
        $this->productsRepository = $productsRepository;
        $this->cachedProductsRepository = $cachedProductsRepository;
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function index()
    {
        return $this->productsRepository->getAll();
    }

    /**
     * @param  int  $id
     *
     * @return Products
     */
    public function getProductById(int $id) :Products
    {
        return $this->cachedProductsRepository->getProductById($id);
    }

    /**
     * @param  array  $data
     *
     * @return array
     */
    public function create(array $data) :array
    {
        return $this->productsRepository->create($data);
        //event(CreateProductEvent::class, ['data' => $data]);
    }

    /**
     * @param  WishlistProduct  $wishlistProduct
     */
    public function delete(WishlistProduct $wishlistProduct) :void
    {
        $this->productsRepository->delete($wishlistProduct);
    }

    public function deleteProduct(int $id) :void
    {
        $this->productsRepository->deleteProduct($id);
    }
}
