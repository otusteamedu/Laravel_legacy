<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once  __DIR__ . '/config.php';

use App\Sockets\Client;

$socketPath = $config['socket_path'];

$server = new Client($socketPath);
$server->run();