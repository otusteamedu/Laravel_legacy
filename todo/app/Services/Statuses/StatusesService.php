<?php
/**
 * Description of StatusesService.php
 *
 *
 */

namespace App\Services\Statuses;


use App\Models\Status;

use App\Services\Statuses\Repositories\StatusRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class StatusesService
{

    /** @var StatusRepositoryInterface */
    private $statusRepository;

    private $createStatusHandler;

    public function __construct(

        StatusRepositoryInterface $statusRepository
    )
    {
        $this->statusRepository = $statusRepository;
    }

    /**
     * @param int $id
     * @return Status|null
     */
    public function findStatus(int $id)
    {
        // return $this->statusRepository->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function searchStatuses(): LengthAwarePaginator
    {
        return $this->statusRepository->search();

    }

    /**
     * @param array $data
     * @return Status
     */
    public function storeStatus(array $data): Status
    {
        $status = $this->statusRepository->create($data);
        return $status;
    }

    /**
     * @param Status $status
     * @param array $data
     * @return Status
     */
    public function updateStatus(Status $status, array $data)
    {
        return $this->statusRepository->updateFromArray($status, $data);
    }

    public function deleteStatus(int $id)
    {
        return $this->statusRepository->delete($id);
    }


}