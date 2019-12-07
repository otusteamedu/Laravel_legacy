<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once  __DIR__ . '/config.php';

use App\Sockets\Server;
use App\Helpers\RandomMessageGenerator as RMG;

$socketPath = $config['socket_path'];
$messageGenerator = new RMG();

$server = new Server($socketPath, $messageGenerator);
$server->run();