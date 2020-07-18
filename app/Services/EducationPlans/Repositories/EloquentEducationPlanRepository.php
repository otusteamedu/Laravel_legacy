<?php

namespace App\Services\EducationPlans\Repositories;

use Illuminate\Support\Collection;

/**
 * Class EloquentEducationPlanRepository
 * @package App\Services\EducationPlans\Repositories
 */
class EloquentEducationPlanRepository implements EducationPlanRepositoryInterface
{
    /**
     * Вернуть учебную нагрузку по учебным планам
     * @param Collection $educationPlans
     * @return int
     */
    public function getHoursForEducationPlans(Collection $educationPlans): int
    {
        return $educationPlans->sum('hours');
    }
}
