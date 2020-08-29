<?php

namespace App\Services\Lessons;

use App\Models\Group;
use App\Services\Interfaces\CacheService;
use App\Services\Lessons\Repositories\LessonRepositoryInterface;
use App\Services\Traits\CacheClearable;
use Carbon\Carbon;
use Illuminate\Support\Collection;

/**
 * Class LessonService
 * @package App\Services\Lessons
 */
class LessonService implements CacheService
{
    use CacheClearable;

    const CACHE_TAG = 'LESSON';
    /**
     * @var LessonRepositoryInterface
     */
    private $repository;

    /**
     * LessonService constructor.
     * @param LessonRepositoryInterface $repository
     */
    public function __construct(
        LessonRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function cacheWarm(): void
    {
        //
    }

    /**
     * @param Carbon $date
     * @param Group $group
     * @return Collection
     */
    public function getLessonsByDateAndGroup(Carbon $date, Group $group): Collection
    {
        return $this->repository->getLessonsByDateAndGroup($date, $group);
    }
}
