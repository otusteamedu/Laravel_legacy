<?php

use Hw7\Client;
use Hw7\Server;

require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';

(new Client($config['socket']))->read(function (){
    return Server::ACCEPTED;
});

