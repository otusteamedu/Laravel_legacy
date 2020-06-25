<?php

namespace App\Services\Pages\Repositories;


use App\Models\Page;

interface PageRepositoryInterface
{

    public function find(int $id);

    public function search(array $filters = []);

    public function createFromArray(array $data): Page;

    public function updateFromArray(Page $page, array $data);

}
