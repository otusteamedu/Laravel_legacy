<?php

require_once __DIR__ . "/vendor/autoload.php";

use Socket\Logger;
use Socket\App;

$App = new App(new Logger());
$App->runServer();
