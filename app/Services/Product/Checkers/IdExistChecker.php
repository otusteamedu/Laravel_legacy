<?php

namespace App\Services\Product\Checkers;

use App\Services\Product\Exceptions\IdDoesntExistException;
use App\Services\Product\Repositories\EloquentProductRepository;

class IdExistChecker
{
    protected $productRepository;

    public function __construct(
        EloquentProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    public function check(int $id): void
    {
        if (!$this->productRepository->find($id)) {
            throw new IdDoesntExistException('Product with id=' . $id . ' doesn\'t exist');
        }
    }
}
