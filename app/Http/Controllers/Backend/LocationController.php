<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LocationStoreFormRequest;
use App\Http\Requests\LocationUpdateFormRequest;
use App\Models\Location;
use App\Models\User;
use App\Services\Location\LocationService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Policies\Abilities;
use Illuminate\Support\Facades\Auth;

class LocationController extends Controller
{

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * LocationController constructor.
     *
     * @param  LocationService  $locationService
     * @param  UserService  $userService
     * @todo Использовать DI на уровне интерфейсов
     */
    public function __construct(LocationService $locationService, UserService $userService)
    {
        $this->locationService = $locationService;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize(Abilities::VIEW_ANY, Location::class);
        $filters = [
            'page' => $request->get('page'),
        ];
        return view('backend.pages.location.index', [
            'locations' => $this->locationService->getByUserCached(Auth::user(), $filters),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create()
    {
        $this->authorize(Abilities::CREATE, Location::class);
        return view('backend.pages.location.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LocationStoreFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(LocationStoreFormRequest $request)
    {
        $this->authorize(Abilities::CREATE, Location::class);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $this->locationService->create($data);
        // @todo Сообщение об успешном создании записи
        return redirect(route('backend.location.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Location  $location
     * @return Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Location  $location
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Location $location)
    {
        $this->authorize(Abilities::UPDATE, $location);
        return view('backend.pages.location.edit', [
            'location' => $location,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LocationUpdateFormRequest  $request
     * @param  Location  $location
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(LocationUpdateFormRequest $request, Location $location)
    {
        $this->authorize(Abilities::UPDATE, $location);
        $this->locationService->update($location, $request->all());
        // @todo Сообщение об успешном обновлении записи
        return redirect(route('backend.location.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Location  $location
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Location $location)
    {
        $this->authorize(Abilities::DELETE, $location);
        // @todo Промежуточная форма подтверждения
        $this->locationService->delete($location);
        // @todo Сообщение об успешном удалении записи
        return redirect(route('backend.location.index'));
    }
}
