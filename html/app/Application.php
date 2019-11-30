<?php

namespace app;


class Application
{
    const SERVER_MODE_OPTION = 'server';

    public function run()
    {
        $opt = getopt('m:', [self::SERVER_MODE_OPTION]);
        if ((isset($opt['m']) && ($opt['m'] === self::SERVER_MODE_OPTION)) || isset($opt[self::SERVER_MODE_OPTION])) {
            new Server();
        } else {
            new Client();
        }
    }
}