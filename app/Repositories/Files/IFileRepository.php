<?php


namespace App\Repositories\Files;


use App\Models\File;

interface IFileRepository
{
    public function find(int $id);
    public function createFromArray(array $data): File;
    public function updateFromArray(File $file, array $data);
    public function remove(File $file);
}
