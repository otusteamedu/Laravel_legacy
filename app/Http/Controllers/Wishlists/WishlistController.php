<?php
/**
 * @copyright Copyright (c) Archvile <info@0x25.ru>
 * @link https://0x25.ru
 */

namespace App\Http\Controllers\Wishlists;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wishlists\Requests\StoreWishlistRequest;
use App\Models\Wishlist;
use App\Services\Wishlists\WishlistsService;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{

    protected $wishlistService;

    public function __construct(WishlistsService $wishlistService)
    {
        $this->authorizeResource(Wishlist::class);

        $this->wishlistService = $wishlistService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|\Illuminate\View\View
     */
    public function index()
    {
        View::share(
            [
                'wishlists' => $this->wishlistService->index(),
            ]
        );

        return view('wishlist.index');
    }

    /**
     * @param  StoreWishlistRequest  $request
     *
     * @return RedirectResponse
     */
    public function store(StoreWishlistRequest $request)
    {
        $data = $request->getFormData();

        $this->wishlistService->create($data);

        return redirect(localize_route('wishlists.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Wishlist  $wishlist
     *
     * @return Factory|\Illuminate\View\View
     */
    public function show(Wishlist $wishlist)
    {
        View::share([
            'wishlist' => $wishlist,
            'products' => $this->wishlistService->products($wishlist),
        ]);

        return view('wishlist.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Wishlist  $wishlist
     *
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Wishlist $wishlist)
    {
        if ($wishlist->delete()) {
            \Session::flash('message', 'Wishlist successfully deleted!');
        }

        return Redirect::back();
    }
}
