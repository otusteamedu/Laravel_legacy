<?php

use Hw7\Server;
use Illuminate\Support\Str;

require_once __DIR__ . '/vendor/autoload.php';
$config = require __DIR__ . '/config.php';

(new Server($config['socket']))
    ->listen(
        function () {
            return Str::random();
        },
        function ($message) {
            return sprintf('Message  %s received by client', $message);
        });