<?php

namespace App\Services\Products\Handlers;

use App\Models\Product;
use App\Services\Products\Repositories\ProductRepositoryInterface;
use Carbon\Carbon;

class CreateProductHandler
{

    private $productRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository
    )
    {
        $this->productRepository = $productRepository;
    }


    public function handle(array $data): Product
    {
        $data['created_at'] = Carbon::create()->subDay();

        return $this->productRepository->createFromArray($data);
    }

}
