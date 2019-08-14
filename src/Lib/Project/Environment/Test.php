<?php
/**
 * Окружение для запуска тестов
 */

namespace Project\Environment;

class Test extends Base{
    public function getCurrentEnvironment() {
        return \Project\Environments::TEST;
    }

    /**
     * @throws \RuntimeException
     */
    public function setup() {
        $this->currentPlatform = \Project\Platforms::getInstance()->getCurrentPlatform();
        if (!$this->currentPlatform) {
            throw new \RuntimeException('Unable to determine platform. Run "./build setDefaultPlatform platform=..." to set default platform');
        }

        if (!\Project\Platforms::getInstance()->isValidPlatform($this->currentPlatform)) {
            throw new \RuntimeException('Unknown platform: ' . $this->currentPlatform . '.' . PHP_EOL
                . 'Available platforms are: ' . PHP_EOL . implode(PHP_EOL, \Project\Platforms::getInstance()->getAvailablePlatforms()));
        }
    }

    /**
     * Required
     */
    public function initialize() {
        parent::initialize();
    }

    protected function getDispatcher()
    {
        throw new \LogicException('Turn your logic on! There is no dispatcher in test environment!');
    }
}