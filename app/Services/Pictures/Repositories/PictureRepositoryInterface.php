<?php

namespace App\Services\Pictures\Repositories;

use App\Models\Picture;

/**
 * Interface PictureRepositoryInterface
 * @package App\Services\Pictures\Repositories
 */
interface PictureRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Picture;

    public function updateFromArray(Picture $user, array $data);

    public function delete(int $id);
}
