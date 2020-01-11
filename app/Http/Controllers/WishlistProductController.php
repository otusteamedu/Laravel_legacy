<?php

namespace App\Http\Controllers;

use App\Models\WishlistProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WishlistProductController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WishlistProduct  $wishlistProduct
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(WishlistProduct $wishlistProduct)
    {
        $wishlistProduct->delete();

        return Redirect::back();
    }
}
