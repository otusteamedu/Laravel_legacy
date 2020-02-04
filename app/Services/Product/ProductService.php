<?php

namespace App\Services\Product;

use App\Models\Products;
use App\Services\Product\Handlers\CreateProductHandler;
use App\Services\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    private $productRepository;

    private $productHandler;

    public function __construct(
        CreateProductHandler $productHandler,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productHandler = $productHandler;
        $this->productRepository = $productRepository;
    }

    public function searchProduct(): LengthAwarePaginator
    {
        return $this->productRepository->search();
    }

    public function createProduct(array $data): Products
    {
        return $this->productHandler->handle($data);
    }

    public function findProduct(int $id)
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(Products $product, array $data): Products
    {
        return $this->productRepository->updateFromArray($product, $data);
    }

    public function destroyProduct($id)
    {
        return $this->productRepository->destroy($id);
    }

}
