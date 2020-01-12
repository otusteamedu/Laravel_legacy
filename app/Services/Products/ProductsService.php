<?php
/**
 * @copyright Copyright (c) Archvile
 * @link https://0x25.ru
 */

namespace App\Services\Products;


use App\Services\Products\Repositories\ProductsRepositoryInterface;

class ProductsService
{
    protected $productsRepository;

    public function __construct(ProductsRepositoryInterface $productsRepository)
    {
        $this->productsRepository = $productsRepository;
    }

    /**
     * @param  array  $data
     */
    public function create(array $data) :void
    {
        $this->productsRepository->create($data);
    }
}