<?php

namespace App\Services\Subjects;

use App\Services\Helpers\DTOHelper;
use App\Services\Subjects\Handlers\WrapSubjectsByHrefHandler;
use App\Services\Subjects\Repositories\SubjectRepositoryInterface;
use Illuminate\Support\Collection;

class SubjectService
{
    /** @var  SubjectRepositoryInterface */
    protected $repository;
    protected $wrapSubjectsByHrefHandler;

    /**
     * SubjectService constructor.
     * @param SubjectRepositoryInterface $repository
     * @param WrapSubjectsByHrefHandler $wrapSubjectsByHrefHandler
     */
    public function __construct(
        SubjectRepositoryInterface $repository,
        WrapSubjectsByHrefHandler $wrapSubjectsByHrefHandler
    ) {
        $this->repository = $repository;
        $this->wrapSubjectsByHrefHandler = $wrapSubjectsByHrefHandler;
    }

    /**
     * Оборачивает предметы в тег a
     * Возвращает коллекцию {id => <a href="http://otus-laravel.test/dashboard/subjects/id">name</a>}
     * @param Collection $subjects
     * @return Collection
     */
    public function wrapGroupsByHref(Collection $subjects): Collection
    {
        return $this->wrapSubjectsByHrefHandler->handle($subjects);
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
