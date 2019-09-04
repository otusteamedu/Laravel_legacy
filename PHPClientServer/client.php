#!/usr/bin/env php
<?php

include_once('./app/Socket.php');

if (!$socket = (new Socket())->connectClient()) {
    die('Соединение не установлено');
}

(new Socket())->clientWorks($socket);

socket_close($socket);