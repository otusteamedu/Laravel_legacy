<?php
require_once '../vendor/autoload.php';

$ini = parse_ini_file("../settings.ini");
$port = $ini['port'];
$server_sock = $ini['server_sock'];
$client_sock = $ini['client_sock'];

$cliSock = new Socket\ClientSocket($port, $server_sock, $client_sock);

try {
    $cliSock->run();
} catch (Exception $e) {
    die($e->getMessage());
}
?>
