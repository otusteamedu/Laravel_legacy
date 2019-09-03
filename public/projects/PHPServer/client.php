#!/usr/bin/env php
<?php

$params = getopt('', ['address::', 'port::', 'message::']);

$address = $params['address'] ?? '127.0.0.1';
$port = $params['port'] ?? 9999;
$message = $params['message'] ?? "GET /";
$message .= '\n';

while (true) {

    usleep(100000);
    $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
    if ($socket === false)
        die("Socket create failed: " . socket_strerror(socket_last_error()) . "\n");

    $connect = socket_connect($socket, $address, $port);
    if ($connect === false)
        die("Socket create failed: " . socket_strerror(socket_last_error()) . "\n");

    socket_write($socket, $message, strlen($message));

    $answer = "";
    while (($line = socket_read($socket, 2048)) !== "")
        $answer .= $line . "сообщение - принято";

    echo $answer . "\n";

    socket_close($socket);
}