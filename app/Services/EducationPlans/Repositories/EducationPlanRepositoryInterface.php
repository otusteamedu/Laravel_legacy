<?php

namespace App\Services\EducationPlans\Repositories;

use Illuminate\Support\Collection;

interface EducationPlanRepositoryInterface
{
    /**
     * Вернуть учебную нагрузку по учебным планам
     * @param Collection $educationPlans
     * @return int
     */
    public function getHoursForEducationPlans(Collection $educationPlans): int;
}
