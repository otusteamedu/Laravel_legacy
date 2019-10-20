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
     * @return mixed
     */
    public function bind($value);

    /**
     * @param array $filters
     *
     * @return Collection
     */
    public function search(array $filters = []);
}
