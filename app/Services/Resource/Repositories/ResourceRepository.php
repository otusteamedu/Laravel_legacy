<?php

namespace App\Services\Resource\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ResourceRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return Collection
     */
    public function index(): Collection {
        return $this->model::all();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id) {
        return $this->model::findOrFail($id);
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function store(array $data) {
        return $this->model::create($data);
    }

    /**
     * @param array $data
     * @param $item
     * @return mixed
     */
    public function update(array $data, $item) {
        $item->update($data);

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
        $item->publish = !$item->publish;
        $item->save();

        return $item;
    }
}
