<?php

namespace App\Services\Settings\Handlers;

use App\Services\Settings\Repositories\SettingRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Settings\Handlers
 */
abstract class BaseHandler
{
    /**
     * @var SettingRepositoryInterface
     */
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param SettingRepositoryInterface $repository
     */
    public function __construct(SettingRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
