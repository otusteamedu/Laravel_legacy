<?php
namespace App\Repositories\Interfaces;


interface UserRepositoryInterface
{
    public function get(array $filters);
    public function getById(int $id);
    public function create(array $data);
    public function change(int $id, array $data);
    public function changePassword(int $id, string $newPassword);
    public function changeStatus(int $id, string $newStatus);
    public function delete(int $id);
}