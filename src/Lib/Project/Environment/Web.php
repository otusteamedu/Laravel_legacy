<?php
/**
 * Веб-окружение
 */

namespace Project\Environment;

class Web extends Base {
    const CONTROLLER_NAME_TEMPLATE = '\\Page\\%s';
    private $controllerName;
    private $paramsRaw;
    private $serverData;
    /**
     * @var \Project\Dispatcher\Web
     */
    private $Dispatcher;

    /**
     * @var \Whoops\Handler\PrettyPageHandler
     */
    private $errorPage;

    /** @var array */
    protected $utmData = [];

    public function addWhoopsData($title, $data) {
        if ($this->errorPage) {
            $this->errorPage->addDataTable($title, $data);
        }
    }

    public function getCurrentEnvironment() {
        return \Project\Environments::WEB;
    }

    public function getRawParams() {
        return $this->paramsRaw;
    }

    public function isAjax() {
        return isset($this->serverData['HTTP_X_REQUESTED_WITH'])
                && !empty($this->serverData['HTTP_X_REQUESTED_WITH'])
                && strtolower($this->serverData['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public function isPut() {
        return $this->serverData['REQUEST_METHOD'] == 'PUT';
    }

    public function isPost() {
        return $this->serverData['REQUEST_METHOD'] == 'POST';
    }

    public function isDelete() {
        return $this->serverData['REQUEST_METHOD'] == 'DELETE';
    }

    /**
     * @param $serverData
     * @param $get
     * @param $post
     * @throws \RuntimeException
     */
    public function setup($serverData, $get, $post)
    {
        $this->serverData = $serverData;

        \Project\Logger::setContext('uri', substr($_SERVER['REQUEST_URI'], 0, 256));

        $page = !empty($serverData['PAGE']) ? $serverData['PAGE'] : '';
        $platform = !empty($serverData['PLATFORM']) ? $serverData['PLATFORM'] : '';
        $params = !empty($serverData['PARAMS']) ? $serverData['PARAMS'] : [];

        if (empty($page)) {
            throw new \RuntimeException("Page name must be specified");
        }

        $this->controllerName = sprintf(self::CONTROLLER_NAME_TEMPLATE, $page);

        if (!\Project\Platforms::getInstance()->isValidPlatform($platform)) {
            throw new \RuntimeException('Unknown platform: ' . $platform . '.' . PHP_EOL
            . 'Available platforms are: ' . PHP_EOL . implode(PHP_EOL, \Project\Platforms::getInstance()->getAvailablePlatforms()));
        }

        $this->currentPlatform = $platform;

        if (!$this->currentPlatform) {
            $this->currentPlatform = \Project\Platforms::getInstance()->getCurrentPlatform();
        }

        $this->paramsRaw = $params + $post + $get;

        if(($this->isDelete() || $this->isPut() || ($this->isPost() && empty($post))) && ($input = file_get_contents("php://input"))) {
            $data = (array)json_decode($input, true);
            $this->paramsRaw = $this->paramsRaw + $data;
        }

        if (\Project\Platforms::getInstance()->displayExceptions) {
            $whoops = new \Whoops\Run();
            $this->errorPage = new \Whoops\Handler\PrettyPageHandler();
            $this->addWhoopsData("Params", $this->paramsRaw);
            $whoops->pushHandler($this->errorPage);
            $whoops->register();
        }

        $this->utmData = $this->parseUtmData($get);
    }

    /**
     * @return \Project\Dispatcher\Web
     */
    protected function getDispatcher()
    {
        if (empty($this->Dispatcher)) {
            $this->Dispatcher = new \Project\Dispatcher\Web();
            $this->Dispatcher->setEnvironment($this);
            $this->Dispatcher->setup($this->controllerName);
        }

        return $this->Dispatcher;
    }

    public function getUtmData() {
        return $this->utmData;
    }

    /**
     * @param array $get
     * @return array
     */
    protected function parseUtmData($get) {
        $result = [];
        $utmKeys = array_flip(['campaign', 'source', 'medium', 'term', 'content']);

        foreach ($get as $key => $value) {
            if (substr($key, 0, 4) <> 'utm_') {
                continue;
            }

            $key = substr($key, 4);
            if (isset($utmKeys[$key])) {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}