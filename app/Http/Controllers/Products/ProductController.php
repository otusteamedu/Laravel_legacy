<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\Request\ProductsRequest;
use App\Models\Products;
use App\Services\Products\ProductsService;
use Illuminate\Support\Facades\Redirect;

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
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(ProductsRequest $request)
    {
        $data = $request->getFormData();

        $this->productsService->create($data);

        \Session::flash('message', 'Product successfully added!');

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Products $product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Products $product)
    {
        \View::share([
            'product' => $product
        ]);

        return view('product.detail');
    }

}
