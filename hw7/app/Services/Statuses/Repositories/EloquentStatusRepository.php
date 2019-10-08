<?php
/**
 */

namespace App\Services\Statuses\Repositories;


use App\Models\Status;

class EloquentStatusRepository implements StatusRepositoryInterface
{

    public function find(int $id)
    {
        return Status::find($id);
    }

    public function search(array $filters = [])
    {
        return Status::paginate();
    }

    public function createFromArray(array $data): Status
    {
        $status = new Status();
        $status->create($data);
        return $status;
    }

    public function updateFromArray(Status $status, array $data)
    {

        $result = Status::where('name', $data['name'])->get();
        if ((count($result) > 1) || (count($result) == 1 && $result[0]->id != $status->id)) {

            return ['error' => 'Это имя уже успользуется'];
        }
        $status->update($data);
        return 1;
    }

    public function create(array $data): Status
    {
        return $this->createFromArray($data);
    }

    public function delete(int $id)
    {

        return Status::destroy($id);
    }

}