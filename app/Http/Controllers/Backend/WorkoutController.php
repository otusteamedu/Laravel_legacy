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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.workout.index', [
            'workouts' => $this->workoutService->paginate(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
        $locations = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->locationService->all() as $location) {
            $locations[$location->id] = $location->name;
        }
        return view('backend.pages.workout.create', [
            'users' => $users,
            'locations' => $locations,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkoutStoreFormRequest $request)
    {
        $this->workoutService->create($request->all());
        // @todo Сообщение об успешном создании записи
        return redirect(route('backend.workout.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function show(Workout $workout)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function edit(Workout $workout)
    {
        $users = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->userService->all() as $user) {
            $users[$user->id] = $user->name;
        }
        $locations = [
            // @todo Брать значение по умолчанию из конфига
            '' => '– Please select –'
        ];
        foreach ($this->locationService->all() as $location) {
            $locations[$location->id] = $location->name;
        }
        return view('backend.pages.workout.edit', [
            'workout' => $workout,
            'users' => $users,
            'locations' => $locations,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function update(WorkoutUpdateFormRequest $request, Workout $workout)
    {
        $this->workoutService->update($workout, $request->all());
        // @todo Сообщение об успешном обновлении записи
        return redirect(route('backend.workout.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workout  $workout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Workout $workout)
    {
        // @todo Промежуточная форма подтверждения
        $this->workoutService->delete($workout);
        // @todo Сообщение об успешном удалении записи
        return redirect(route('backend.workout.index'));
    }
}
