<?php


namespace App\Services\Subscriptions;


use App\Services\Subscriptions\Handlers\GetDataHandler;
use App\Services\Subscriptions\Handlers\WriteFileHandler;

class SublistService
{
    private $writeHandler;
    private $getDataHandler;

    public function __construct(
        WriteFileHandler $writeFileHandler,
        GetDataHandler $getDataHandler
    )
    {
        $this->writeHandler = $writeFileHandler;
        $this->getDataHandler = $getDataHandler;
    }

    public function SaveResult($data)
    {
        $this->writeHandler->handle($data);
    }

    public function GetResult()
    {
        return $this->getDataHandler->handle();
    }
}
