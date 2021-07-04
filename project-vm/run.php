<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = require_once __DIR__ . '/config.php';

use App\Helpers\RandomMessageGenerator as RMG;
use App\Sockets\Client;
use App\Sockets\Server;

$socketPath = $config['socket_path'];
$messageGenerator = new RMG();

$options = getopt('', [
    'client',
    'server'
]);

if (isset($options['client']) && !isset($options['server'])) {
    $server = new Client($socketPath);
    $server->run();
} elseif (!isset($options['client']) && isset($options['server'])) {
    $server = new Server($socketPath, $messageGenerator);
    $server->run();
} else {
    exit('Unknown parameters');
}
