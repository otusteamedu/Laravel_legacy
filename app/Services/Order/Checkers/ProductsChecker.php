<?php

namespace App\Services\Order\Checkers;

use App\Services\Base\Checkers\ArrayChecker;
use App\Services\Base\Checkers\ArrayKeysChecker;
use App\Services\Base\Checkers\MoreThanZeroIntChecker;
use App\Services\Product\Checkers\IdExistChecker as ProductIdExistChecker;

class ProductsChecker
{
    protected $arrayChecker;
    protected $arrayKeysChecker;
    protected $moreThanZeroIntChecker;
    protected $productIdExistChecker;

    public function __construct(
        ArrayChecker $arrayChecker,
        ArrayKeysChecker $arrayKeysChecker,
        MoreThanZeroIntChecker $moreThanZeroIntChecker,
        ProductIdExistChecker $productIdExistChecker
    ) {
        $this->arrayChecker = $arrayChecker;
        $this->arrayKeysChecker = $arrayKeysChecker;
        $this->moreThanZeroIntChecker = $moreThanZeroIntChecker;
        $this->productIdExistChecker = $productIdExistChecker;
    }

    public function check($products): void
    {
        $this->arrayChecker->check($products, 'products');

        foreach ($products as $product) {
            $this->arrayKeysChecker->check($product, [
                'id',
                'quantity'
            ], 'products');

            $this->productIdExistChecker->check($product['id']);

            $this->moreThanZeroIntChecker->check($product['quantity'], 'quantity');
        }
    }
}
