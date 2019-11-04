<?php

namespace App\Http\Controllers\Favorites;

use App\Models\Favorite;
use App\Services\Favorites\FavoriteService;
use App\Services\Materials\MaterialService;
use App\Services\Users\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritesController extends Controller {

    protected $favoriteService;
    protected $userService;
    protected $materialService;

    public function __construct(FavoriteService $favoriteService, UserService $userService, MaterialService $materialService) {
        $this->favoriteService = $favoriteService;
        $this->userService = $userService;
        $this->materialService = $materialService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return \view('favorites.list', [
            'favorites' => $this->favoriteService->searchFavorites()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('favorites.create', [
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->favoriteService->storeFavorite($request->all());
        return redirect(route('admin.favorites.index'), 301);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Favorite $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(Favorite $favorite) {
        return view('favorites.show', [
            'favorite' => $favorite
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Favorite $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(Favorite $favorite) {
        return view('favorites.edit', [
            'favorite' => $favorite,
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Favorite $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Favorite $favorite) {
        $this->favoriteService->updateFavorite($favorite, $request->all());
        return redirect(route('admin.favorites.index'), 301);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Favorite $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Favorite $favorite) {
        $this->favoriteService->destroyFavorites([$favorite->id]);
    }
}
