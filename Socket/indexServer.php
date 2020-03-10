<?php
require 'SocketServer.php';

header('Content-Type: text/plain;');
set_time_limit(0);
ob_implicit_flush();

(new SocketServer())->handle();
