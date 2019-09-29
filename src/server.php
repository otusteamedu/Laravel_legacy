<?php

try {
    include_once __DIR__ . '/lib/socket.php';
    $socket = createUnixSocket('/var/run/server_socket.sock');
    $clientPath = '/var/run/client_socket.sock';
    do {
        $message = "\"" . (string) rand(10,20) . "\"";
        sendResponse($socket,$clientPath,$message);
        echo date("d.m.Y h:i:s") . "|server: Message \"{$message}\" sent to \"{$clientPath}\"" . PHP_EOL;
        [$incomingMessage, $from] = listenUnixSocket($socket);
        echo date("d.m.Y h:i:s") . "|server: Message \"{$incomingMessage}\" received from \"{$from}\"" . PHP_EOL;
        sleep(rand(1,5));
    } while ($socket);
} catch (Throwable $exception) {
    echo date("d.m.Y h:i:s") . "|server: \"" . $exception->getMessage() . "\"" .PHP_EOL;
    exit(1);
}