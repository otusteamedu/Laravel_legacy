<?php

namespace App\Http\Controllers\Favorites;

use App\Models\Favorite;
use App\Policies\Abilities;
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW_ANY, Favorite::class);

        return \view('favorites.list', [
            'favorites' => $this->favoriteService->searchFavorites()
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create() {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Favorite::class);

        return view('favorites.create', [
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(Request $request) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::CREATE, Favorite::class);

        $this->favoriteService->storeFavorite($request->all());
        return redirect(route('admin.favorites.index'), 301);
    }

    /**
     * @param Favorite $favorite
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Favorite $favorite) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::VIEW, $favorite);

        return view('favorites.show', [
            'favorite' => $favorite
        ]);
    }

    /**
     * @param Favorite $favorite
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Favorite $favorite) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $favorite);

        return view('favorites.edit', [
            'favorite' => $favorite,
            'users' => $this->userService->searchUsers(),
            'materials' => $this->materialService->searchMaterials(),
        ]);
    }

    /**
     * @param Request $request
     * @param Favorite $favorite
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Favorite $favorite) {

        /** @noinspection PhpUnhandledExceptionInspection */
        $this->authorize(Abilities::UPDATE, $favorite);

        $this->favoriteService->updateFavorite($favorite, $request->all());
        return redirect(route('admin.favorites.index'), 301);
    }

    /**
     * @param Favorite $favorite
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Favorite $favorite) {
        $this->authorize(Abilities::DELETE, $favorite);
        $this->favoriteService->destroyFavorites([$favorite->id]);
    }
}
