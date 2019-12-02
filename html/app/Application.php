<?php

namespace app;

/**
 * Class Application
 * @package app
 */
class Application
{
    const SERVER_MODE_OPTION = 'server';

    /**
     * Получает параметры из командной строки
     * @return void
     */
    public function run(): void
    {
        $opt = getopt('m:', [self::SERVER_MODE_OPTION]);
        if ((isset($opt['m']) && ($opt['m'] === self::SERVER_MODE_OPTION)) || isset($opt[self::SERVER_MODE_OPTION])) {
            new Server();
        } else {
            new Client();
        }
    }
}