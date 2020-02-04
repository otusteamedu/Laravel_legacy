<?php


namespace App\Services\Product\Handlers;

use App\Models\Products;
use App\Services\Product\Repositories\ProductRepositoryInterface;

class CreateProductHandler
{
    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $data
     * @return Products
     */
    public function handle(array $data): Products
    {
        return $this->productRepository->createFromArray($data);
    }
}
