<?php

/**
 * Write message to console
 *
 * @param  string  $message
 * @param  string  $prefix
 *
 * @return string
 */
function consoleLog($message, $prefix = '')
{
    $prefixOutput = !empty($prefix) ? sprintf(' %s |', $prefix) : '';

    echo sprintf('%s |%s %s'.PHP_EOL, date('H:i:s'), $prefixOutput, $message);
}

/**
 * Get server address from .env
 *
 * @return string
 */
function getServerAddress()
{
    $serverIp   = getenv('SERVER_IP') ?: '127.0.0.1';
    $serverPort = getenv('SERVER_PORT') ?: '8000';

    return sprintf('tcp://%s:%s', $serverIp, $serverPort);
}

/**
 * Get ping-pong timeout from .env
 *
 * @return array|false|int|string
 */
function getPingPongTimeout()
{
    $pingPongTimeout = getenv('PING_PONG_TIMEOUT');

    if (!$pingPongTimeout || (int)$pingPongTimeout < 1) {
        return 1;
    }

    return $pingPongTimeout;
}

function generateRandomMessage()
{
    $randomMessage = time();

    try {
        $randomMessage /= random_int(2, 10);
    } catch (\Exception $exception) {
        consoleLog($exception->getMessage().PHP_EOL);
    }

    return (int)$randomMessage;
}