<?php

namespace App\Services;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    /**
     * @param int  $id
     * @param bool $exception
     *
     * @return object
     */
    public function find(int $id, $exception = false);

    /**
     * @param $value
     *
     * @return object
     */
    public function bind($value);

    /**
     * @param array $filters
     *
     * @param array $columns
     * @return Collection
     */
    public function search(array $filters = [], array $columns = ['*']);

    public function paginate(array $filters = [], array $options = []);
}
