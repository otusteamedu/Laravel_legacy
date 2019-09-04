<?php

namespace App;

use Illuminate\Support\Facades\Log;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

class TwilioClient implements CallOperatorClientInterface
{
    private $token;
    private $password;
    private $client;

    public function __construct(string $token, string $password)
    {
        $this->token    = $token;
        $this->password = $password;
    }

    public function connect(): void
    {
        try {
            $this->client = new Client($this->token, $this->password);
        } catch (TwilioException $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function call(string $from, string $to): void
    {
        try {
            return $this->client->account->calls->create(
                $to,
                $from,
                []
            );
        } catch (TwilioException $exception) {
            Log::error($exception->getMessage());
        }
    }

    public function getCallInfo(string $callId): array
    {
        try {
            return $this->client->calls($callId)->fetch();
        } catch (TwilioException $exception) {
            Log::error($exception->getMessage());
        }
    }
}