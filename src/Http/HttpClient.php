<?php

namespace Gerfey\BattleNet\Http;

use Gerfey\BattleNet\Regions\RegionInterface;

class HttpClient implements HttpClientInterface
{
    protected $client;

    protected $response;

    protected $verify = false;

    protected $options = [];

    public function createRequest(): BattleNetResponseInterface
    {
        // TODO: Implement createRequest() method.
    }

    public function setNamespace(string $namespace)
    {
        // TODO: Implement setNamespace() method.
    }
}