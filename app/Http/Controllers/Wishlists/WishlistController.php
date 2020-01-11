<?php

namespace App\Http\Controllers\Wishlists;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Wishlists\Requests\StoreWishlistRequest;
use App\Models\Wishlist;
use App\Services\Wishlists\WishlistsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class WishlistController extends Controller
{

    protected $wishlistService;

    public function __construct(WishlistsService $wishlistService)
    {
        $this->wishlistService = $wishlistService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        View::share(
            [
                'wishlists' => $this->wishlistService->index()
            ]
        );

        return view('wishlist.index');
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function store(StoreWishlistRequest $request)
    {
        $data = $request->getFormData();

        $this->wishlistService->create($data);

        return redirect(route('wishlists.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Wishlist $wishlist
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Wishlist $wishlist)
    {
        View::share([
            'wishlist' => $wishlist,
            'products' => $this->wishlistService->products($wishlist)
        ]);

        return view('wishlist.products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Wishlist $wishlist
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Wishlist $wishlist)
    {
        $wishlist->delete();

        \Session::flash('message', 'Wishlist successfully deleted!');

        return Redirect::back();
    }
}
