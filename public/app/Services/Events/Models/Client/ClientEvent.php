<?php

namespace App\Services\Events\Models\Client;

use \App\Models\Clients\Client;

abstract class ClientEvent
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
    * @return \App\Models\Clients\Client
    */
    public function getClient(): Client
    {
        return $this->client;
    }
}
