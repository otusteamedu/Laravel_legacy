<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\Request\ProductsRequest;
use App\Services\Products\ProductsService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class ProductController extends Controller
{

    protected $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProductsRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(ProductsRequest $request)
    {
        $data = $request->getFormData();

        $this->productsService->create($data);

        \Session::flash('message', 'Product successfully added!');

        return Redirect::back();
    }

    /**
     * @param  Request  $request
     *
     * @return Factory|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        $productId = $request->route()->product;

        View::share([
            'product' => $this->productsService->getProductById($productId),
        ]);

        return view('product.detail');
    }

}
