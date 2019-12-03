<?php

namespace Hb;

use Hb\Socket\Exception;

class Application
{
    /**
     * Check can run app
     * @return bool
     */
    public static function canRun(){
        if (!extension_loaded('sockets')) {
            return false;
        }
        return true;
    }

    /**
     * Get application instance
     * @throws Exception
     * @return Hb\Socket\Application
     */
    public static function getAppInstance(){
        $options = getopt('m:', [ Server::MODE, Client::MODE ]);

        echo 'ckeck mode'.PHP_EOL;
        if (isset($options[Client::MODE]) || $options['m'] == Client::MODE){
            return new Client();
        } else {
            return new Server();
        }
    }
}