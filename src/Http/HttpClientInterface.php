<?php

namespace Gerfey\BattleNet\Http;

interface HttpClientInterface
{
    public function createRequest(): BattleNetResponseInterface;

    public function setNamespace(string $namespace);
}