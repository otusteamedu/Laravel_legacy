<?php

namespace App;

class Logger implements LoggerInterface
{
    public function message($message, $prefix = ''): void
    {
        $prefixOutput = !empty($prefix) ? sprintf(' %s |', $prefix) : '';

        echo sprintf('%s |%s %s'.PHP_EOL, date('H:i:s'), $prefixOutput, $message);
    }
}