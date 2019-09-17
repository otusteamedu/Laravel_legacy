<?php
namespace App\Repositories\Interfaces;


interface RoleRepositoryInterface
{
    public function get(array $filter);
    public function getById(int $id);
    public function change(int $id, array $filter);
    public function delete(int $id);
}