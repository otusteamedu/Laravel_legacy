<?php

namespace Gerfey\BattleNet\Request;

use Gerfey\BattleNet\Http\BattleNetResponseInterface;
use Gerfey\BattleNet\Http\HttpClientInterface;

class Request implements RequestInterface
{
    /**
     * @var HttpClientInterface
     */
    private $client;

    /**
     * Request constructor.
     * @param HttpClientInterface $client
     */
    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
        $this->setNamespace();
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @return mixed
     */
    protected function createRequest(string $method = 'GET', string $uri, array $options = []): BattleNetResponseInterface
    {
        return $this->client->createRequest($method, $uri, $options);
    }

    /**
     * @param string $namespace
     */
    protected function setNamespace(string $namespace = 'dynamic'): void
    {
        $this->client->setNamespace($namespace);
    }
}