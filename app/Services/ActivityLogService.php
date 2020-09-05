<?php

namespace App\Services;

use App\Models\ActivityLog;
use App\Services\Repositories\ActivityLogRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ActivityLogService
 * @package App\Services
 */
class ActivityLogService
{
    /**
     * @var ActivityLogRepository
     */
    private $activityLogRepository;

    /**
     * ActivityLogService constructor.
     * @param ActivityLogRepository $activityLogRepository
     */
    public function __construct(ActivityLogRepository $activityLogRepository)
    {
        $this->activityLogRepository = $activityLogRepository;
    }

    /**
     * @param array|null $options
     * @return ActivityLog[]|Collection
     */
    public function all(array $options = null)
    {
        return $this->activityLogRepository->getAll($options);
    }

    /**
     * @param array|null $options
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function allPaginated(array $options = null)
    {
        return $this->activityLogRepository->paginated($options);
    }

}
