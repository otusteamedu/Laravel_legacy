<?php

namespace App;

class TwilioCaller extends AbstractCallOperatorCaller
{
    private $token;
    private $password;

    public function __construct(string $token, string $password)
    {
        $this->token = $token;
        $this->password = $password;
    }

    public function getCallOperatorClient(): CallOperatorClientInterface
    {
        return new TwilioClient($this->token, $this->password);
    }
}