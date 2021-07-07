<?php


namespace App\Services\Orthography\Repositories;


use App\Models\Orthography;

interface IOrthographyRepositoryCache
{
    public function list();
    public function detail(int $id);

}
