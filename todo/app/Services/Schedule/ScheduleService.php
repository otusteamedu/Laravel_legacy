<?php
/**
 * Description of SchedulesService.php
 *
 *
 */
namespace App\Services\Schedules;

use App\Models\Schedule;

use App\Services\Schedule\Repositories\ScheduleRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ScheduleService
{

    /** @var ScheduleRepositoryInterface */
    private $scheduleRepository;

    private $createScheduleHandler;

    public function __construct(

        ScheduleRepositoryInterface $scheduleRepository
    )
    {
        $this->scheduleRepository = $scheduleRepository;
    }

    /**
     * @param int $id
     * @return Schedule|null
     */
    public function findSchedule(int $id)
    {
        // return $this->scheduleRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchSchedules()
    {
        return $this->scheduleRepository->search();

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchSchedulesToArray()
    {
        return $this->scheduleRepository->searchToArray();

    }

    /**
     * @param array $data
     * @return Schedule
     */
    public function storeSchedule(array $data): Schedule
    {
        $schedule = $this->scheduleRepository->create($data);
        return $schedule;
    }

    /**
     * @param Schedule $schedule
     * @param array $data
     * @return Schedule
     */
    public function updateSchedule(Schedule $schedule, array $data)
    {
        return $this->scheduleRepository->updateFromArray($schedule, $data);
    }

    public function deleteSchedule(int $id)
    {
        return $this->scheduleRepository->delete($id);
    }


}