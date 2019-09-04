<?php

namespace App;

interface SocketInterface
{
    /**
     * Get unix socket address
     *
     * @return string
     */
    public function getSocketAddress(): string;
}