<?php

namespace App\Services\SubCategory\Repositories;


use Illuminate\Database\Eloquent\Collection;

abstract class SubCategoryRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::withCount('images')->get();
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
     * @return mixed
     */
    public function destroy($item) {
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
