<?php


namespace App\Services\Product\Handlers;

use App\Models\Product;
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
     * @return Product
     */
    public function handle(array $data): Product
    {
        return $this->productRepository->createFromArray($data);
    }
}
