<?php


namespace App\Services\Repositories;

use Illuminate\Http\Request;

interface RepositoryInterface
{
    public function index();

    public function store(array $data);

    public function update(array $data, $model);

    public function destroy($id);
}

