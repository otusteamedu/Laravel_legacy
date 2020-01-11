<?php


namespace App\Services\Tag;


use App\Services\SubCategory\SubCategoryService;
use App\Services\Tag\Repositories\TagRepository;

class TagService extends SubCategoryService
{
    /**
     * TagService constructor.
     * @param TagRepository $repository
     */
    public function __construct(TagRepository $repository)
    {
        parent::__construct($repository);
    }
}
