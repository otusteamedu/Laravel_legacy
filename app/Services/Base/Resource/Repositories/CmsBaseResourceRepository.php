<?php

namespace App\Services\Base\Resource\Repositories;


use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\ResourceCollection;

abstract class CmsBaseResourceRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return LengthAwarePaginator|Paginator|Collection|ResourceCollection
     */
    public function index() {
        return $this->model::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getItem(int $id) {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $storeData
     * @return mixed
     */
    public function store(array $storeData) {
        return $this->model::create($storeData);
    }

    /**
     * @param $item
     * @param array $updateData
     * @return mixed
     */
    public function update($item, array $updateData) {
        $item->update($updateData);

        return $item;
    }

    /**
     * @param $item
     * @return int
     */
    public function destroy($item): int {
        return $item->delete();
    }

    /**
     * @param $item
     * @return mixed
     */
    public function publish($item) {
        $item->publish = +!$item->publish;
        $item->save();

        return $item;
    }
}
