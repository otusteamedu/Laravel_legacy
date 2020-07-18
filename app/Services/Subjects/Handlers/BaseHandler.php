<?php

namespace App\Services\Subjects\Handlers;

use App\Services\Subjects\Repositories\SubjectRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Subjects\Handlers
 */
abstract class BaseHandler
{
    /** @var  SubjectRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param SubjectRepositoryInterface $repository
     */
    public function __construct(SubjectRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
