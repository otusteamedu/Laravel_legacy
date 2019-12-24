<?php

namespace App\Services\Events\Models\Category;

use App\Models\Category;

abstract class CategoryEvent {

    /** @var Category */
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category {
        return $this->category;
    }
}