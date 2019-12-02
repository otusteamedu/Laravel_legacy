<?php

namespace app;

/**
 * Class Socket
 * Общие параметры для сокетов
 * @package app
 */

class Socket
{
    const LOCAL_SOCKET = '/tmp/mysocket.sock';
    const SOCKET_TIMEOUT = 3;
    protected $socket;
}