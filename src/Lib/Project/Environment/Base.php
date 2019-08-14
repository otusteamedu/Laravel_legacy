<?php

/**
 * Абстрактный класс окружения для приложения
 */

namespace Project\Environment;

abstract class Base {
    const DEFAULT_HOST_FILE_TPL = "%s/dynamic/host.php";

    protected $currentPlatform;
    protected $currentHost;

    /**
     * @var int текущий номер выкладки
     */
    protected static $version;

    abstract public function getCurrentEnvironment();

    public function getCurrentPlatform() {
        return $this->currentPlatform;
    }
    public function getCurrentHost() {
        if (!$this->currentHost) {
            $hostFile = sprintf(self::DEFAULT_HOST_FILE_TPL, PROJECT_PATH);
            if (file_exists($hostFile)) {
                $this->currentHost = require($hostFile);
            } else {
                $this->currentHost = gethostname();
            }
        }
        return $this->currentHost;
    }
    public function getCurrentVersion() {
        if (!static::$version) {
            if (!\Project\Platforms::getInstance()->dynamicVersion && is_numeric($basename = basename(PROJECT_PATH))) {
                static::$version = (int) $basename;
            } else {
                static::$version = mt_rand(1, 99999);
            }
        }
        return static::$version;
    }

    protected function initialize() {
        $platform = $this->getCurrentPlatform();
        $environment = $this->getCurrentEnvironment();
        $host = $this->getCurrentHost();
        $version = $this->getCurrentVersion();
        if (!$platform) {
            throw new \RuntimeException("Can't determine current platform");
        }
        if (!$environment) {
            throw new \RuntimeException("Can't determine current environment");
        }
        define('PROJECT_PLATFORM', $platform);
        define('PROJECT_ENVIRONMENT', $environment);
        define('PROJECT_PROTOCOL', \Project\Platforms::getInstance()->protocol);
        define('PROJECT_HOST', $host);

        define('PROJECT_VERSION', $version);
        define('PROJECT_LOCALE', 'ru'); //@todo написать локали

        \Project\Environments::setCurrentEnvironment($this);
    }

    public function runDispatcher() {
        $this->initialize();
        $this->getDispatcher()->dispatch();
    }

    /**
     * @return \Project\Dispatcher\Base
     */
    abstract protected function getDispatcher();

    public function isTest() {
        return (strpos($this->getCurrentPlatform(), \Project\Platforms::PLATFORM_TEST) === 0);
    }
}