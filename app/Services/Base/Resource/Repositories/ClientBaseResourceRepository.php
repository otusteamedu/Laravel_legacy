<?php

namespace App\Services\Base\Resource\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ClientBaseResourceRepository
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * @return Collection
     */
    public function index(): Collection
    {
        return $this->model::where('publish', 1)->get();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function show(int $id)
    {
        return $this->model::findOrFail($id);
    }
}
