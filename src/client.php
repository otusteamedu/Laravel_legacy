<?php

try {
    include_once __DIR__ . '/lib/socket.php';
    $socket = createUnixSocket('/var/run/client_socket.sock');
    echo date("d.m.Y h:i:s") . "|client: ready to receive messages" . PHP_EOL;
    do {
        [$incomingMessage, $from] = listenUnixSocket($socket);
        echo date("d.m.Y h:i:s") . "|client: Message \"{$incomingMessage}\" received from \"{$from}\"" . PHP_EOL;
        sendResponse($socket,$from,$incomingMessage);
        echo date("d.m.Y h:i:s") . "|client: Message \"{$incomingMessage}\" sent to \"{$from}\"" . PHP_EOL;
    } while ($socket);
} catch (Throwable $exception) {
    echo date("d.m.Y h:i:s") . "|client: \"" . $exception->getMessage() . "\"" .PHP_EOL;
    exit(1);
}