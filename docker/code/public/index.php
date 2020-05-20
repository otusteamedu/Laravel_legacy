<?php

require '../vendor/autoload.php';

try {
    (new \Core\Application())->run();
} catch (\Exception $Exception) {
    echo '<pre>';
    print_r([
        'error code' => $Exception->getCode(),
        'message' => $Exception->getMessage(),
        'file' => $Exception->getFile(),
        'line' => $Exception->getLine(),
        'trace' => $Exception->getTraceAsString(),
    ]);
}
