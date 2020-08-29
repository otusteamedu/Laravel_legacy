<?php

namespace App\Services\Lessons\Repositories;

use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Interface LessonRepositoryInterface
 * @package App\Services\Lessons\Repositories
 */
interface LessonRepositoryInterface
{
    /**
     * @param Carbon $date
     * @param Group $group
     * @return Collection
     */
    public function getLessonsByDateAndGroup(Carbon $date, Group $group): Collection;
}
