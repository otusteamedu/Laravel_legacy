<?php

namespace App\Services\Cms\Post;

use App\Models\Post\Rubric;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Class RubricsService
 * @package App\Services\Cms\Post
 */
class RubricsService
{
    /** @var RubricRepositoryInterface $rubricRepository */
    protected $rubricRepository;

    /**
     * RubricsService constructor.
     * @param RubricRepositoryInterface $rubricRepository
     */
    public function __construct(RubricRepositoryInterface $rubricRepository)
    {
        $this->rubricRepository = $rubricRepository;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function paginationList(): LengthAwarePaginator
    {
        return $this->rubricRepository->paginationList([
            'order' => ['column' => 'id', 'order' => 'asc']
        ]);
    }

    /**
     * @param array $data
     * @return string
     */
    public function store(array $data): string
    {
        try {
            $rubric = $this->rubricRepository->createFromArray($data);
            $url = route('cms.rubrics.show', ['rubric' => $rubric->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.rubrics.create');
        }
        return $url;
    }

    /**
     * @param Rubric $rubric
     * @param array $data
     * @return string
     */
    public function update(Rubric $rubric, array $data): string
    {
        try {
            $this->rubricRepository->updateFromArray($rubric, $data);
            $url = route('cms.rubrics.show', ['rubric' => $rubric->id]);
        } catch (\Throwable $exception) {
            $url = route('cms.rubrics.edit', ['rubric' => $rubric->id]);
        }
        return $url;
    }

    /**
     * @param Rubric $rubric
     * @return string
     */
    public function destroy(Rubric $rubric): string
    {
        try {
            $this->rubricRepository->delete($rubric);
            $url = route('cms.rubrics.index');
        } catch (\Throwable $exception) {
            $url = route('cms.rubrics.show', ['rubric' => $rubric->id]);
        }
        return $url;
    }

    /**
     * @return array
     */
    public function getArrayList(): array
    {
        return $this->rubricRepository->arrayList([
                 'order' => ['column' => 'id', 'order' => 'asc'],
             ]);
    }
}
