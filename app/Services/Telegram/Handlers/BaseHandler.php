<?php

namespace App\Services\Telegram\Handlers;

use App\Services\Telegram\Repositories\TelegramRepositoryInterface;

/**
 * Class BaseHandler
 * @package App\Services\Telegram\Handlers
 */
abstract class BaseHandler
{
    /** @var  TelegramRepositoryInterface*/
    protected $repository;

    /**
     * BaseHandler constructor.
     * @param TelegramRepositoryInterface $repository
     */
    public function __construct(TelegramRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
}
