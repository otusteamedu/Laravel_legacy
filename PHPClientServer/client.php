#!/usr/bin/env php
<?php

include_once('./app/Socket.php');

$unixSocket = new Socket('/tmp/myserver.sock','Test',1);

if (!$socket = $unixSocket->connectClient()) {
    die('Соединение не установлено');
}

$unixSocket->clientReceivingSendingMessage($socket);

socket_close($socket);