<?php

namespace App\Http\Controllers\API\Products;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }

    public function getList(int $page = 1, int  $perPage = 20, string $search = null)
    {
        return response()->json(
            $this->productService->getPage($page, $perPage, $search)
        );
    }
}
