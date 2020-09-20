<?php


namespace App\Services\Repositories;

use App\Models\Model;

class EloquentRepository implements RepositoryInterface
{

    /**
     * @var Model
     */
    private $model;

    public function setModel($modelName)
    {
        $modelName = 'App\Models\\'.$modelName;
        $this->model = new $modelName;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id)
    {
        return $this->model::find($id);
    }

    public function list()
    {
        return $this->model::with('town', 'user', 'division')->get();
    }

    /**
     * @param $qty
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateList($qty)
    {
        return $this->model::with('town', 'user', 'division')->paginate($qty);
    }

    /**
     * @param $qty
     * @param $division_id
     * @param $town_id
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filteredPaginateList($qty, $division_id, $town_id)
    {
        $advert = $this->model::query();
        $town_id!='all'
            ? $advert->where([['division_id', $division_id],['town_id', $town_id] ])
            : $advert->where('division_id', $division_id );
        $advert->with('town', 'user', 'division');

        return $advert->paginate($qty);
    }

    /**
     * @param int $limit
     * @param int $offset
     * @return Model[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function paginateListApi(int $limit, int $offset)
    {
        $advert = $this->model::query();
        if ($limit) $advert->take($limit);
        if($offset) $advert->skip($offset);

        $advert->with('town', 'user', 'division');
        return $advert->get(['adverts.*']); // ???
    }

    /**
     * @param array $data
     * @return object
     */
    public function createFromArray(array $data): object
    {
//        $advert = new Advert();
////        $advert->create($data);   $advert->save($data);  // если create то id в модели не проставится
////        return $advert;
            return $this->model::create($data);
    }

    /**
     * @param object $advert
     * @param array $data
     * @return object
     */
    public function updateFromArray(object $advert, array $data): object
    {
        $advert->update($data);
        return $advert;
    }

    public function destroyFromObj(object $advert)
    {
        $advert->delete();
    }

}
