<?php

namespace App\Services\Products;

use App\Models\Product;
use App\Services\Products\Handlers\CreateProductHandler;
use App\Services\Products\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductsService
{

    /** @var ProductRepositoryInterface */
    private $productRepository;
    /** @var CreateProductHandler */
    private $createProductHandler;

    public function __construct(
        CreateProductHandler $createProductHandler,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->createProductHandler = $createProductHandler;
        $this->productRepository = $productRepository;
    }

    /**
     * @param int $id
     * @return Product|null
     */
    public function findProduct(int $id)
    {
        return $this->productRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchProducts(): LengthAwarePaginator
    {
        return $this->productRepository->search();
    }

    /**
     * @param array $data
     * @return Product
     */
    public function storeProduct(array $data): Product
    {
        $product = $this->createProductHandler->handle($data);

        return $product;
    }

    /**
     * @param Product $product
     * @param array $data
     * @return Product
     */
    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->updateFromArray($product, $data);
    }

}
