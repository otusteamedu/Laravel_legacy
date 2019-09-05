<?php

namespace App;

interface CallOperatorClientInterface
{
    public function connect(): void;

    public function call(string $from, string $to): void;

    public function getCallInfo(string $callId): array;
}