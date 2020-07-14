<?php

namespace App\Services\Subjects;

use App\Services\Helpers\DTOHelper;
use App\Services\Subjects\Wrappers\SubjectsByHrefWrapper;
use App\Services\Subjects\Repositories\SubjectRepositoryInterface;
use App\Services\Traits\CacheClearable;
use Illuminate\Support\Collection;

class SubjectService
{
    use CacheClearable;

    const CACHE_TAG = 'SUBJECT';

    /** @var  SubjectRepositoryInterface */
    protected $repository;
    protected $subjectsByHrefwrapper;

    /**
     * SubjectService constructor.
     * @param SubjectRepositoryInterface $repository
     * @param SubjectsByHrefWrapper $subjectsByHrefwrapper
     */
    public function __construct(
        SubjectRepositoryInterface $repository,
        SubjectsByHrefWrapper $subjectsByHrefwrapper
    ) {
        $this->repository = $repository;
        $this->subjectsByHrefwrapper = $subjectsByHrefwrapper;
    }

    /**
     * Оборачивает предметы в тег a
     * Возвращает коллекцию {id => <a href="http://otus-laravel.test/dashboard/subjects/id">name</a>}
     * @param Collection $subjects
     * @return Collection
     */
    public function wrapGroupsByHref(Collection $subjects): Collection
    {
        return $this->subjectsByHrefwrapper->wrap($subjects);
    }

    /**
     * Возвращает список предметов вида [id => name]
     * @return array
     */
    public function subjectSelectList(): array
    {
        return $this->repository->selectList()->toArray();
    }

    /**
     * @param array $ids
     * @return Collection
     */
    public function getIdsFromArray(array $ids): Collection
    {
        return DTOHelper::getIdsDTOFromArray($ids);
    }
}
