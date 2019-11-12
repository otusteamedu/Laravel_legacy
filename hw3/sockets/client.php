#!/usr/bin/env php
<?php

include("config.php");

if( ($unixSocket = stream_socket_client(sprintf('%s%s', 'unix://', $soket_file), $errno, $errstr, 30)) === false) {
    die('Соединение не установлено');
}else {
    echo "Соединение установлено". "\n";;
}

while (true) {
    while (!feof($unixSocket)) {
        $msg = stream_socket_recvfrom($unixSocket, 1024);
        echo sprintf('Принято %s', $msg);
        stream_socket_sendto($unixSocket, $msg);
    }
}

socket_close($unixSocket);