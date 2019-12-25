<?php

namespace App\Services\Events\Models\Workout;

use App\Models\Workout;

abstract class WorkoutEvent
{
    /**
     * @var Workout
     */
    private $workout;

    public function __construct(Workout $workout)
    {
        $this->workout = $workout;
    }

    public function getWorkout() {
        return $this->workout;
    }
}
