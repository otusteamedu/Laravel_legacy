#!/usr/bin/env php
<?php

$params = getopt('', ['address::', 'port::']);

$address = $params['address'] ?? '127.0.0.1';
$port = $params['port'] ?? 9999;
$threads = $params['threads'] ?? 1;


$acceptor = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($acceptor === false)
    die("Socket create failed: " . socket_strerror(socket_last_error()) . "\n");

socket_set_option($acceptor, SOL_SOCKET, SO_REUSEADDR, 1);

if (!socket_bind($acceptor, $address, $port))
    die("Socket bind failed: " . socket_strerror(socket_last_error()) . "\n");

if (!socket_listen($acceptor, 1))
    die("Socket listen failed: " . socket_strerror(socket_last_error()) . "\n");

for ($i = 0; $i < $threads; $i++) {

    $pid = pcntl_fork();
    if ($pid == 0) {
        while (true) {
            $socket = socket_accept($acceptor);
            echo "Accept connection $socket\n";

            $pid = posix_getpid();
            $message = "Hello from $pid process\t\t$pid\n";
            socket_write($socket, $message);

            $command = trim(socket_read($socket, 2048));
            echo "Сообщение $command" . " принято клиентом\n";
            $message = "[ $command ] \n";
            socket_write($socket, $message);

            socket_close($socket);
        }
    }
}
while (($cid = pcntl_waitpid(0, $status)) != -1) {
    $exitcode = pcntl_wexitstatus($status);
    echo "Child $cid exited with status $exitcode\n";
}
socket_close($acceptor);