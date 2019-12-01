<?php

namespace App\Services\Events\Models\Category;

use App\Models\Category;

abstract class CategoryEvent {

    /** @var Category */
    private $category;

    public function __construct(Category $country) {
        $this->category = $country;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category {
        return $this->category;
    }
}
