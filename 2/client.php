<?php

include_once 'class/autoload.php';

use Socket;

$ini = parse_ini_file("settings.ini");
$port = $ini['port'];
$server_sock = $ini['server_sock'];
$client_sock = $ini['client_sock'];

$servSock = new Socket\ClientSocket($port, $server_sock, $client_sock);

try {
    $servSock->run();
} catch (Exception $e) {
    die($e->getMessage());
}
?>
