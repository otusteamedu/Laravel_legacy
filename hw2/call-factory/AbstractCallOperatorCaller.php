<?php

namespace App;

abstract class AbstractCallOperatorCaller
{
    abstract public function getCallOperatorClient(): CallOperatorClientInterface;

    public function call(string $from, string $to): void
    {
        $callOperatorClient = $this->getCallOperatorClient();
        $callOperatorClient->connect();
        $callOperatorClient->call($from, $to);
    }
}