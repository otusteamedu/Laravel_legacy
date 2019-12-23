<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\WorkoutStoreFormRequest;
use App\Http\Requests\WorkoutUpdateFormRequest;
use App\Models\Workout;
use App\Models\User;
use App\Services\Location\LocationService;
use App\Services\Workout\WorkoutService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use App\Policies\Abilities;
use Illuminate\Support\Facades\Auth;

class WorkoutController extends Controller
{

    /**
     * @var WorkoutService
     */
    private $workoutService;

    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var LocationService
     */
    private $locationService;

    /**
     * WorkoutController constructor.
     *
     * @param  WorkoutService  $workoutService
     * @param  UserService  $userService
     * @param  LocationService  $locationService
     * @todo Использовать DI на уровне интерфейсов
     */
    public function __construct(
        WorkoutService $workoutService,
        UserService $userService,
        LocationService $locationService
    )
    {
        $this->workoutService = $workoutService;
        $this->userService = $userService;
        $this->locationService = $locationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index()
    {
        $this->authorize(Abilities::VIEW_ANY, Workout::class);
        return view('backend.pages.workout.index', [
            'workouts' => $this->workoutService->getByUserCached(Auth::user()),
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
        $this->authorize(Abilities::CREATE, Workout::class);
        $locations = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->locationService->getByUser(Auth::user()) as $location) {
            $locations[$location->id] = $location->name;
        }
        return view('backend.pages.workout.create', [
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  WorkoutStoreFormRequest  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(WorkoutStoreFormRequest $request)
    {
        $this->authorize(Abilities::CREATE, Workout::class);
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $this->workoutService->create($data);
        // @todo Сообщение об успешном создании записи
        return redirect(route('backend.workout.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Workout  $workout
     * @return Response
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Workout  $workout
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Workout $workout)
    {
        $this->authorize(Abilities::UPDATE, $workout);
        $locations = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->locationService->getByUser(Auth::user()) as $location) {
            $locations[$location->id] = $location->name;
        }
        return view('backend.pages.workout.edit', [
            'workout' => $workout,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WorkoutUpdateFormRequest  $request
     * @param  Workout  $workout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(WorkoutUpdateFormRequest $request, Workout $workout)
    {
        $this->authorize(Abilities::UPDATE, $workout);
        $this->workoutService->update($workout, $request->all());
        // @todo Сообщение об успешном обновлении записи
        return redirect(route('backend.workout.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Workout  $workout
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Workout $workout)
    {
        $this->authorize(Abilities::DELETE, $workout);
        // @todo Промежуточная форма подтверждения
        $this->workoutService->delete($workout);
        // @todo Сообщение об успешном удалении записи
        return redirect(route('backend.workout.index'));
    }
}
