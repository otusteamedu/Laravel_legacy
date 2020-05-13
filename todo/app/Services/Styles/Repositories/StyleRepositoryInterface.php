<?php
/**
 */

namespace App\Services\Styles\Repositories;

use App\Models\Style;

interface StyleRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function createFromArray(array $data): Style;

    public function create(array $data): Style;

    public function updateFromArray(Style $style, array $data);

    public function delete(int $id);


}