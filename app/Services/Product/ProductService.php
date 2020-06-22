<?php

namespace App\Services\Product;

use App\Services\Product\Repositories\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function getPage(int $page = 1, int  $perPage = 20, string $search = null): array
    {
        return $this->productRepository->getPage($page, $perPage, $search);
    }
}
