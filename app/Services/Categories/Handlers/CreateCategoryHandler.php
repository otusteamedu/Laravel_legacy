<?php

namespace App\Services\Categories\Handlers;

use App\Models\Category;
use App\Services\Categories\Repositories\EloquentCategoryRepository;

class CreateCategoryHandler
{

    private $categoryRepository;

    public function __construct(
        EloquentCategoryRepository $categoryRepository
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param array $data
     * @return Category
     */
    public function handle(array $data): Category
    {
        //$data['data'][app()->getLocale()] = ucfirst($data['name']);
        //unset($data['name']);

        return $this->categoryRepository->createFromArray($data);
    }

}
