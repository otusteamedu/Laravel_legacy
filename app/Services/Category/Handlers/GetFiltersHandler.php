<?php


namespace App\Services\Category\Handlers;


use App\Services\Category\Repositories\ClientCategoryRepository;
use App\Services\Tag\Repositories\ClientTagRepository;
use Illuminate\Support\Arr;

class GetFiltersHandler
{
    private ClientCategoryRepository $repository;
    private ClientTagRepository $tagRepository;

    /**
     * GetFiltersHandler constructor.
     * @param ClientCategoryRepository $repository
     * @param ClientTagRepository $tagRepository
     */
    public function __construct(
        ClientCategoryRepository $repository,
        ClientTagRepository $tagRepository
    )
    {
        $this->repository = $repository;
        $this->tagRepository = $tagRepository;
    }

    /**
     * @param int $categoryId
     * @return array
     */
    public function handle(int $categoryId): array
    {
        $categories = $this->repository->getFilters($categoryId)->groupBy('type');
        $tags = $this->tagRepository->getFiltersByCategoryId($categoryId);

        return Arr::collapse([$categories->toArray(), ['tags' => $tags]]);
    }
}
