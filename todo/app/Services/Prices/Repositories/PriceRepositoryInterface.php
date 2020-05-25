<?php
/**
 */

namespace App\Services\Prices\Repositories;

use App\Models\Price;

interface PriceRepositoryInterface
{
    public function find(int $id);

    public function search(array $filters = []);

    public function searchToArray(array $filters = []);

    public function createFromArray(array $data): Price;

    public function create(array $data): Price;

    public function updateFromArray(Price $price, array $data);

    public function delete(int $id);


}