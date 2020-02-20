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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{

    /** @var ProductsService */
    protected $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->productsService = $productsService;
    }

    /**
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Products::class);

        return response()->json(new ProductsResource($this->productsService->index()));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function show($id)
    {
        $this->authorize(Abilities::VIEW_ANY, Products::class);

        $product = $this->productsService->getProductById($id);

        return response()->json(new ProductsResource($product));
    }

    /**
     * @param  ProductsRequest  $request
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function store(ProductsRequest $request)
    {
        $this->authorize(Abilities::CREATE, Products::class);

        $data = $request->getFormData();
        $product = $this->productsService->create($data);

        return response()->json(new ProductsResource($product));
    }


    /**
     * @param $id
     *
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy($id)
    {
        $this->authorize(Abilities::DELETE, Products::class);

        $this->productsService->deleteProduct($id);

        return response()->json(
            [
                'message' => 'OK',
            ]
        );
    }

}
