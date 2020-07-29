<?php

namespace App\Services\Posts\Handlers;

use App\Services\Posts\Exceptions\PostException;
use App\Services\Posts\Repositories\PostRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Posts\Handlers
 */
abstract class BaseHandler
{
    /** @var  PostRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param PostRepositoryInterface $repository
     */
    public function __construct(PostRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $groups
     */
    protected function checkGroupsId(array $groups): void
    {
        collect($groups)->each(function (int $group): void {
            if ($group <= 0) {
                throw new PostException($group . ' must be greater 0.');
            }
        });

        if (count($groups) === 0) {
            throw new PostException('Groups id is empty.');
        }
    }
}
