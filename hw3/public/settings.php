<?php

error_reporting(E_ALL);

/* Позволить сценарию зависнуть вокруг ожидания подключений */
set_time_limit(0);

/* Включить неявный вывод, так что мы видим то, что мы получаем
 * когда это приходит . */
ob_implicit_flush();

$socketTransport = 'unix://';
$socketName = '/tmp/otus-hw3.sock';
$connectionTimeSeconds = 30;
$limitMessages = 15;