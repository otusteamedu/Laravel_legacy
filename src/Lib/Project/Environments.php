<?php

/**
 * Хранит текущее окружение, в котором запущено приложение
 */

namespace Project;

class Environments {
    const WEB = 'web';
    const CLI = 'cli';
    const TEST = 'test';

    /**
     * @var \Project\Environment\Base
     */
    private static $Environment;

    /**
     * Get current environment
     * @return \Project\Environment\Base
     * @throws \RuntimeException
     */
    public static function getEnv() {
        if (self::$Environment instanceof \Project\Environment\Base) {
            return self::$Environment;
        } else {
            throw new \RuntimeException("Environment is not ready yet!");
        }
    }

    /**
     * @param Environment\Base $Environment
     * @void
     */
    public static function setCurrentEnvironment(\Project\Environment\Base $Environment) {
        self::$Environment = $Environment;
    }
}