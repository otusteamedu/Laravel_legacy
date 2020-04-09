<?php


namespace App\Services\Category\Handlers;


use App\Services\Category\Repositories\ClientCategoryRepository;
use App\Services\Tag\Repositories\ClientTagRepository;
use Illuminate\Support\Arr;

class GetWishListFiltersHandler
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
     * @param array $ids
     * @return array
     */
    public function handle(array $ids): array
    {
        $categories = $this->repository->getFiltersByImageIds($ids)->groupBy('type');
        $tags = $this->tagRepository->getFiltersByImageIds($ids);

        return Arr::collapse([$categories->toArray(), ['tags' => $tags]]);
    }
}
