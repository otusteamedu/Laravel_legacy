<?php

namespace App\Services\Repositories;

use App\Models\ActivityLog;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ActivityLogRepository
{
    /**
     * @param $id
     * @return ActivityLog|null
     */
    public function find($id)
    {
        return ActivityLog::find($id);
    }

    /**
     * @param array $columns
     * @return ActivityLog[]|Collection
     */
    public function getAll(array $columns = ['*'])
    {
        return ActivityLog::all($columns);
    }

    /**
     * @param array|null $options
     * @return LengthAwarePaginator
     */
    public function paginated(array $options = null)
    {
        return ActivityLog::paginate();
    }

    /**
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return ActivityLog[]|Collection|null
     */
    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {
        return ActivityLog::where($criteria)->get();
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return ActivityLog|null
     */
    public function findOneBy(array $criteria, array $orderBy = null)
    {
        //
    }

    /**
     * @param array $data
     * @return ActivityLog|Model
     */
    public function createFromArray(array $data)
    {
        return ActivityLog::create($data);
    }

    /**
     * @param ActivityLog $ActivityLog
     * @param array $data
     * @return ActivityLog|Model
     */
    public function updateFromArray(ActivityLog $ActivityLog, array $data)
    {
        $ActivityLog->update($data);

        return $ActivityLog;
    }

    /**
     * @param ActivityLog $ActivityLog
     * @param array|null $options
     * @return bool|null
     * @throws \Exception
     */
    public function delete(ActivityLog $ActivityLog, array $options = null)
    {
        return $ActivityLog->delete();
    }
}
