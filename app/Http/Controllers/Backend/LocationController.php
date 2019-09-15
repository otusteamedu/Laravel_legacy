<?php

namespace App\Http\Controllers\Backend;

use App\Models\Location;
use App\Models\User;
use App\Services\Locations\LocationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationController extends Controller
{

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * LocationController constructor.
     *
     * @param  LocationService  $locationService
     */
    public function __construct(LocationService $locationService)
    {
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // @todo Использовать UserService
        $users = [
            -1 => '– Please select –'
        ];
        foreach (User::all() as $user) {
            $users[$user->id] = $user->name;
        }
        return view('backend.pages.location.create', [
            'users' => $users,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // @todo Валидация запроса
        $this->locationService->create($request->all());
        // @todo Сообщение об успешном создании записи
        return redirect(route('backend.location.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        // @todo Использовать UserService
        $users = [
            -1 => '– Please select –'
        ];
        foreach (User::all() as $user) {
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        // @todo Валидация запроса
        $this->locationService->update($location, $request->all());
        // @todo Сообщение об успешном обновлении записи
        return redirect(route('backend.location.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        // @todo Промежуточная форма подтверждения
        $this->locationService->delete($location);
        // @todo Сообщение об успешном удалении записи
        return redirect(route('backend.location.index'));
    }
}
