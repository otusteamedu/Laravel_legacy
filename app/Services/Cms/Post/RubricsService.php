<?php

namespace App\Services\Cms\Post;

use App\Models\Post\Rubric;
use App\Repositories\Post\Rubric\RubricRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

/**
 * Class RubricsService
 * @package App\Services\Cms\Post
 */
class RubricsService
{
    /** @var RubricRepositoryInterface $rubricRepository */
    protected $rubricRepository;

    /** @var string */
    protected $locale;

    /**
     * RubricsService constructor.
     * @param RubricRepositoryInterface $rubricRepository
     */
    public function __construct(RubricRepositoryInterface $rubricRepository)
    {
        $this->rubricRepository = $rubricRepository;
        $this->locale = \App::getLocale();
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
            Log::info(
                __('log.info.create.rubric'),
                [
                    'id' => $rubric->id,
                    'name' => $rubric->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.show', [
                'rubric' => $rubric->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notCreate.rubric'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.create', [
                'locale' => $this->locale,
            ]);
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
            Log::info(
                __('log.info.update.rubric'),
                [
                    'id' => $rubric->id,
                    'name' => $rubric->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.show', [
                'rubric' => $rubric->id,
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notUpdate.rubric'),
                [
                    'exception' => $exception->getMessage(),
                    'id' => $rubric->id,
                    'data' => $data,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.edit', [
                'rubric' => $rubric->id,
                'locale' => $this->locale,
            ]);
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
            Log::info(
                __('log.info.destroy.rubric'),
                [
                    'id' => $rubric->id,
                    'name' => $rubric->name,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.index', [
                'locale' => $this->locale,
            ]);
        } catch (\Throwable $exception) {
            Log::critical(
                __('log.critical.notDestroy.rubric'),
                [
                    'exception' => $exception->getMessage(),
                    'data' => $rubric->id,
                    'user' => Auth::user()->id,
                ]
            );
            $url = route('cms.rubrics.show', [
                'rubric' => $rubric->id,
                'locale' => $this->locale,
            ]);
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
