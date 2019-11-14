<?
include_once 'class/autoload.php';

use Socket;

$ini = parse_ini_file("settings.ini");
$port = $ini['port'];
$server_sock = $ini['server_sock'];

$server = new Socket\ServerSocket($port, $server_sock);

try {
    $server->run();
}catch (Exception $e) {
    die($e->getMessage());
}