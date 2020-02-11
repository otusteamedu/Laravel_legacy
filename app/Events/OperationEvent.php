<?php


namespace App\Events;


use App\Models\Operation;

abstract class OperationEvent
{
    private $operation;

    public function __construct(Operation $operation)
    {
        $this->operation = $operation;
    }

    public function getOperation() : Operation
    {
        return $this->operation;
    }
}