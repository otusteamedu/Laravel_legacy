<?php

namespace App\Http\Controllers\WishlistProduct;

use App\Http\Controllers\Controller;
use App\Models\WishlistProduct;
use App\Services\Products\ProductsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class WishlistProductController extends Controller
{

    protected $productsService;

    public function __construct(ProductsService $productsService)
    {
        $this->authorizeResource(WishlistProduct::class, 'wishlist_product');
        $this->productsService = $productsService;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WishlistProduct $wishlistProduct)
    {
        $this->productsService->delete($wishlistProduct);

        return Redirect::back();
    }
}
