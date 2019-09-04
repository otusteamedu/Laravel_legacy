<?php

namespace App;

class SipgateCaller extends AbstractCallOperatorCaller
{
    private $account_id;
    private $password;

    public function __construct(string $account_id, string $password)
    {
        $this->account_id = $account_id;
        $this->password = $password;
    }

    public function getCallOperatorClient(): CallOperatorClientInterface
    {
        return new SipgateClient($this->account_id, $this->password);
    }
}