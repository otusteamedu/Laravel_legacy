<?php
$address = '/tmp/mysock.sock';
$serverSocket = socket_create(AF_UNIX, SOCK_STREAM, 0);

$conn = socket_connect($serverSocket, $address);

while (true) {
    if($response = socket_read($serverSocket, 1024)){
        echo $response.PHP_EOL;
        $msg = 'Принято';
        $length = strlen($msg);
        $sendMessage = socket_write($serverSocket, $msg, $length);
    }
}