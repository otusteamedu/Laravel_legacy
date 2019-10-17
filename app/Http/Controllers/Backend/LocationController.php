<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\LocationStoreFormRequest;
use App\Http\Requests\LocationUpdateFormRequest;
use App\Models\Location;
use App\Models\User;
use App\Services\Location\LocationService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
     * @return Response
     */
    public function index()
    {
        return view('backend.pages.location.index', [
            'locations' => $this->locationService->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $users = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->userService->all() as $user) {
            $users[$user->id] = $user->name;
        }
        return view('backend.pages.location.create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LocationStoreFormRequest  $request
     * @return Response
     */
    public function store(LocationStoreFormRequest $request)
    {
        $this->locationService->create($request->all());
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
     * @return Response
     */
    public function edit(Location $location)
    {
        $users = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->userService->all() as $user) {
            $users[$user->id] = $user->name;
        }
        return view('backend.pages.location.edit', [
            'location' => $location,
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LocationUpdateFormRequest  $request
     * @param  Location  $location
     * @return Response
     */
    public function update(LocationUpdateFormRequest $request, Location $location)
    {
        $this->locationService->update($location, $request->all());
        // @todo Сообщение об успешном обновлении записи
        return redirect(route('backend.location.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Location  $location
     * @return Response
     */
    public function destroy(Location $location)
    {
        // @todo Промежуточная форма подтверждения
        $this->locationService->delete($location);
        // @todo Сообщение об успешном удалении записи
        return redirect(route('backend.location.index'));
    }
}
