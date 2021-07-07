<?php


namespace App\Services\Orthography\Repositories;


use App\Models\Orthography;

interface IOrthographyRepository
{
    public function list();
    public function detail(int $id);
    public function update(Orthography $orthography, Array $data):Orthography;
    public function insert(Array $data):Orthography;
}
