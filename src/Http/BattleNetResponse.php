<?php

namespace Gerfey\BattleNet\Http;

use Psr\Http\Message\ResponseInterface;

class BattleNetResponse implements BattleNetResponseInterface
{
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getJson()
    {
        return json_decode($this->response->getBody()->getContents());
    }

    public function getStatusCode()
    {
        return $this->response->getStatusCode();
    }
}