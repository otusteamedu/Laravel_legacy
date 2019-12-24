<?php

namespace App\Listeners\Cache\Workout;

use App\Services\Events\Models\Workout\WorkoutEvent;
use App\Services\Workout\Repositories\WorkoutCachedRepository;

class ClearWorkoutCache
{

    /** @var WorkoutCachedRepository */
    private $workoutCachedRepository;

    /**
     * ClearCountryCache constructor.
     * @param  WorkoutCachedRepository  $workoutCachedRepository
     */
    public function __construct(WorkoutCachedRepository $workoutCachedRepository) {
        $this->workoutCachedRepository = $workoutCachedRepository;
    }

    /**
     * Handle the event.
     *
     * @param  WorkoutEvent  $event
     * @return void
     */
    public function handle(WorkoutEvent $event)
    {
        $this->workoutCachedRepository->clearSearchCache([
            'user_id' => $event->getWorkout()->user->id,
        ]);
    }
}
