<?php

namespace App;

use Ixudra\Curl\Facades\Curl;

class SipgateClient implements CallOperatorClientInterface
{
    const API_AUTH_URL = 'https://api.sipgate.com/v1/authorization/token';
    const API_CALL_URL = 'https://api.sipgate.com/v1/sessions/calls';

    private $account_id;
    private $password;
    private $token;

    public function __construct(string $account_id, string $password)
    {
        $this->account_id = $account_id;
        $this->password   = $password;
        $this->token = sprintf('%s:%s', $this->account_id, $this->password);
    }

    public function connect(): void
    {
        $authData = [
            'username' => $this->account_id,
            'password' => $this->password
        ];
        $header = [
            'content-type: application/json',
            'accept: application/json'
        ];

        return Curl::to(self::API_AUTH_URL)
            ->withHeaders($header)
            ->withData($authData)
            ->returnResponseObject()
            ->post();
    }

    public function call(string $from, string $to): void
    {
        $callData = [
            'caller'   => $from,
            'callee'   => $to,
        ];
        $header = [
            'authorization: bearer ' . $this->token,
            'content-type: application/json'
        ];

        return Curl::to(self::API_CALL_URL)
            ->withHeaders($header)
            ->withData($callData)
            ->returnResponseObject()
            ->post();
    }

    public function getCallInfo(string $callId): array
    {
        $callData = [
            'callId'   => $callId
        ];
        $header = [
            'authorization: bearer ' . $this->token,
            'content-type: application/json'
        ];

        return Curl::to(self::API_CALL_URL)
            ->withHeaders($header)
            ->withData($callData)
            ->returnResponseObject()
            ->post();
    }
}