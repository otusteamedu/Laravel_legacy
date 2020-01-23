<?php

namespace App\Http\Controllers\WishlistProduct;

use App\Http\Controllers\Controller;
use App\Models\WishlistProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;

class WishlistProductController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(WishlistProduct::class, 'wishlist_product');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WishlistProduct  $wishlistProduct
     *
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy(WishlistProduct $wishlistProduct)
    {
        $wishlistProduct->delete();

        \Cache::flush();

        return Redirect::back();
    }
}
