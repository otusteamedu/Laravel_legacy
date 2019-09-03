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
 * Get unix socket address
 *
 * @return string
 */
function getSocketAddress()
{
    return sprintf('unix://%s', getSocketFile());
}


/**
 * Get socket file path from .env
 *
 * @return string
 */
function getSocketFile()
{
    return getenv('SOCKET_FILE') ?: '/tmp/daemon.sock';
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

/**
 * Generate random message
 *
 * @return int
 */
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