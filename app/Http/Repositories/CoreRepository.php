<?php

namespace App\Http\Repositories;

use Illuminate\Database\Eloquent\Model;
/**
 * 
 * Может выдавать наборы данных.
 * Не может создавать/изменять данные
 */
abstract class CoreRepository{

    protected $model;

    public function __construct()
    {
        $this->model = app($this->getModelClass());
    }

    abstract protected function getModelClass();

    protected function startConditions(){
        return clone $this->model;
    }
}