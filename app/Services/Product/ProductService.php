<?php

namespace App\Services\Product;

use App\Models\Product;
use App\Services\Product\Handlers\CreateProductHandler;
use App\Services\Product\Repositories\ProductRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    private $productRepository;

    private $createProductHandler;

    public function __construct(
        CreateProductHandler $createProductHandler,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->createProductHandler = $createProductHandler;
        $this->productRepository = $productRepository;
    }

    public function searchProduct(): LengthAwarePaginator
    {
        return $this->productRepository->search();
    }

    public function createProduct(array $data): Product
    {
        return $this->createProductHandler->handle($data);
    }

    public function findProduct(int $id):?Product
    {
        return $this->productRepository->find($id);
    }

    public function updateProduct(Product $product, array $data): Product
    {
        return $this->productRepository->updateFromArray($product, $data);
    }

    public function destroyProduct($id)
    {
        return $this->productRepository->destroy($id);
    }

}
