#!/usr/bin/env php
<?php

use Socket\Raw\Factory;

error_reporting(-1);

require_once __DIR__.'/vendor/autoload.php';

$path = '/tmp/sct3.sock';

$factory = new Factory();
$socket = $factory->createClient('unix://' . $path);

echo 'Client connected to ' . $socket->getPeerName() . PHP_EOL . PHP_EOL;

//$socket->write("GET / HTTP/1.1\r\nHost: localhost:1337\r\n\r\n");

//var_dump($socket->read(8192));

//while (true){

    for($i=0; $i<3; $i++){
        $message =  $socket->read(8192);
        echo $message."\n";
        $socket->write("Принято");
    }
    $socket->close();


//}


