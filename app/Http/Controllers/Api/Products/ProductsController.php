<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Http\Controllers\Api\Products;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Products\Request\ProductsRequest;
use App\Http\Resources\ProductsResource;
use App\Models\Products;
use App\Policies\Abilities;
use App\Services\Products\ProductsService;
use Facade\FlareClient\Api;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    /** @var ProductsService */
    protected $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function index()
    {
        return $this->productsService->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Products
     */
    public function show($id)
    {
        return $this->productsService->getProductById($id);
    }

    /**
     * @param  Request  $request
     *
     * @return array
     * @throws AuthorizationException
     */
    public function store(ProductsRequest $request)
    {
        $this->authorize(Abilities::CREATE, Products::class);

        $data = $request->getFormData();
        $this->productsService->create($data);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return ['foo ok'];
    }
}
