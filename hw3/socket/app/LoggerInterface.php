<?php

namespace App;

interface LoggerInterface
{
    /**
     * Echo message to console
     *
     * @param  string  $message
     * @param  string  $prefix
     */
    public function message($message, $prefix = '');
}