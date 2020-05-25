<?php
/**
 */

namespace App\Services\Schedules\Repositories;

use App\Models\Schedule;

interface ScheduleRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function createFromArray(array $data): Schedule;

    public function create(array $data): Schedule;

    public function updateFromArray(Schedule $schedule, array $data);

    public function delete(int $id);


}