<?php

/**
 * Диспетчер веб-запросов
 */

namespace Project\Dispatcher;

class Web extends Base {
    private $controllerName;
    /**
     * @var \Page\Base
     */
    private $Controller;
    private $defaultHeaders = [
        'Content-Type' => 'text/html; charset=utf-8;',
        'Cache-control' => 'no-cache',
    ];

    /**
     * @var \Project\Environment\Web
     */
    protected $Environment;

    /**
     * @var \User\Model
     */
    public $currentUser;

    private $jsonHeaders = [
        'Content-Type' => 'application/json; charset=utf-8;',
        'Cache-control' => 'no-cache',
    ];

    /**
     * @param $scriptName string имя класса нужного скрипта
     * @throws \RuntimeException
     */
    public function setup($scriptName) {
        $this->controllerName = $scriptName;
        if (!class_exists($this->controllerName)) {
            throw new \RuntimeException("Can't find given script class '{$this->controllerName}'");
        }

        $this->Controller = new $this->controllerName();

        if (!$this->Controller instanceof \Page\Base) {
            throw new \RuntimeException("Controller must extend \\Page\\Base to be runnable in this environment");
        }
    }

    /**
     * @return \Project\Environment\Web
     */
    public function getEnvironment() {
        return $this->Environment;
    }

    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    public function dispatch() {

        try {
            $this->initUser();
            if ($this->Environment->getUtmData()) {
                $this->redirect($_SERVER['DOCUMENT_URI']);
                return;
            }

            if (!$this->currentUser->isLegit()) {
                \Sign\Manager::logoutUser($this->currentUser);
                $this->error(self::ERROR_TYPE_BLOCKED);
            }

            if ($this->currentUser->isVirtual() && $this->currentUser->isActive()) {
                if (!$this->Controller->allowedVirtual()) {
                    $this->error(self::ERROR_TYPE_UNAUTHORIZED);
                }
            } elseif ($this->currentUser->isReal() && !$this->currentUser->isCompletedRegistration()) {
                if (!$this->Controller->allowedIncompleteReg()) {
                    $this->error(self::ERROR_TYPE_INCOMPLETE_REG);
                }
            } elseif (!$this->currentUser->isRealActive() && !$this->Controller->allowedAnonymous()) {
                $this->error(self::ERROR_TYPE_UNAUTHORIZED);
            }

            if ($this->Controller->onlyForManager() &&
                (!$this->currentUser->isRealActive() || !$this->currentUser->isManager())) {
                $this->error(self::ERROR_TYPE_NO_ACCESS);
            }

            if ($this->Controller->onlyForAdmin() &&
                (!$this->currentUser->isRealActive() || !$this->currentUser->isAdmin())) {
                $this->error(self::ERROR_TYPE_NO_ACCESS);
            }

            $this->Controller->setDispatcher($this);

            if ($this->getEnvironment()->isPut()) {
                $this->Controller->put();
            } elseif ($this->getEnvironment()->isPost()) {
                $this->Controller->post();
            } elseif ($this->getEnvironment()->isDelete()) {
                $this->Controller->delete();
            } else {
                $this->Controller->get();
            }

            if ($this->Controller->isSendHeader()) {
                $this->sendHeaders();
            } elseif ($this->Controller->isSendJsonHeader()) {
                $this->sendJsonHeaders();
            }

            if ($this->Controller->isRenderEnabled()) {
                $this->standardRender();
            } elseif ($result = $this->Controller->getAjaxData()) {
                echo json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }
        } catch (\Helper\NotFoundException $E) {
            $this->error(self::ERROR_TYPE_404, $E);
        } catch (\Db\Shard\MaintenanceException $E) {
            $this->error(self::ERROR_TYPE_503, $E);
        } catch (\Helper\HumanException $E) {
            \Project\Logger::logException(\Project\Logger::LOGFILE_APOCALYPSE, $E);
            if ($this->Controller->isSendJsonHeader()) {
                echo json_encode(['success' => false, 'message' => $E->getMessage(), 'data' => $E->getData()], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                if (\Project\Platforms::getInstance()->displayExceptions and empty($_GET['no-ex'])) {
                    $this->getEnvironment()->addWhoopsData('Exception data:', $E->getData());
                    throw $E;
                } else {
                    $this->sendHeaders();
                    $dynamicBindData = [
                        'User' => $this->currentUser,
                        'platform' => \Project\Platforms::getInstance()->getConfig(),
                    ];
                    \Template\Smarty::getInstance()->assign(['errorMessage' => $E->getMessage()] + self::$defaultBindData + $dynamicBindData);
                    \Template\Smarty::getInstance()->display('basic_error.tpl');
                }
            }
        } catch (\Exception $E) {
            \Project\Logger::logException(\Project\Logger::LOGFILE_APOCALYPSE, $E);
            if ($this->Controller->isSendJsonHeader()) {
                echo json_encode(['success' => false, 'message' => 'Неизвестная ошибка'], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            } else {
                if (\Project\Platforms::getInstance()->displayExceptions and empty($_GET['no-ex'])) {
                    throw $E;
                } else {
                    header('Location: /error');
                }
            }
        }
    }

    const ERROR_TYPE_UNAUTHORIZED   = 1;
    const ERROR_TYPE_NO_ACCESS      = 2;
    const ERROR_TYPE_504            = 3;
    const ERROR_TYPE_404            = 4;
    const ERROR_TYPE_INCOMPLETE_REG = 5;
    const ERROR_TYPE_BLOCKED        = 6;
    const ERROR_TYPE_503            = 7;

    private static $errorTypes = [
        self::ERROR_TYPE_UNAUTHORIZED => [
            'message' => 'Не авторизован',
            'location' => '/login?returnUrl=%s',
        ],
        self::ERROR_TYPE_NO_ACCESS => [
            'message' => 'Ошибка доступа',
            'location' => '/denied',
        ],
        self::ERROR_TYPE_504 => [
            'message' => 'Ошибка сервера',
            'location' => '/error',
        ],
        self::ERROR_TYPE_504 => [
            'message' => 'Ведутся работы',
            'location' => '/error',
        ],
        self::ERROR_TYPE_404 => [
            'message' => 'Объект не найден',
            'location' => '/404notfound',
        ],
        self::ERROR_TYPE_INCOMPLETE_REG => [
            'message' => 'Регистрация не закончена',
            'location' => '/sign/person',
        ],
        self::ERROR_TYPE_BLOCKED => [
            'message' => 'Пользователь заблокирован',
            'location' => '/blocked',
        ],
    ];

    private function error($type, $E = null) {
        if (!array_key_exists($type, self::$errorTypes)) {
            $type = self::ERROR_TYPE_504;
        }
        $errorConfig = self::$errorTypes[$type];

        if ($this->Environment->isAjax()) {
            echo json_encode(['success' => false, 'message' => $errorConfig['message']], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
        } else {
            if (\Project\Platforms::getInstance()->displayExceptions and empty($_GET['no-ex'])) {
                if ($E instanceof \Exception) {
                    throw $E;
                } else {
                    throw new \RuntimeException($errorConfig['message']);
                }
            } else {
                $location = sprintf($errorConfig['location'], urlencode($_SERVER['REQUEST_URI']));
                header('Cache-control: no-cache');
                header('Location: '. $location, true, 302);
            }
        }

        $errorName = "UNKNOWN_ERROR";
        array_walk((new \ReflectionClass(__CLASS__))->getConstants(), function($value, $name) use($type, &$errorName) {
            if (strpos($name, "ERROR_") === 0 && $value === $type) {
                $errorName = $name;
            }
        });
        $string =  sprintf("%s userId: %d, method: %s from %s", $errorName, $this->currentUser->id(), $_SERVER['REQUEST_METHOD'], $_SERVER['REMOTE_ADDR']);
        \Project\Logger::logText(\Project\Logger::LOGFILE_DISPATCHER_ERRORS, $string);

        exit(0);
    }

    private static $defaultBindData = [
        'lang'      => PROJECT_LOCALE,
        'protocol'  => PROJECT_PROTOCOL,
        'host'      => PROJECT_HOST,
        'version'   => PROJECT_VERSION,
    ];

    private function standardRender() {
        $tplFile = $this->Controller->getCurrentTpl();
        $data = $this->Controller->getBindData();
        $dynamicBindData = [
            'User' => $this->currentUser,
            'platform' => \Project\Platforms::getInstance()->getConfig(),
        ];
        \Template\Smarty::getInstance()->assign($data + self::$defaultBindData + $dynamicBindData);
        \Template\Smarty::getInstance()->display($tplFile);
        \Template\Smarty::getInstance()->clearAllAssign();
    }

    private function sendHeaders() {
        foreach ($this->defaultHeaders as $headerName => $headerValue) {
            header($headerName . ': ' . $headerValue);
        }
    }

    private function sendJsonHeaders() {
        foreach ($this->jsonHeaders as $headerName => $headerValue) {
            header($headerName . ': ' . $headerValue);
        }
    }

    /**
     * @param array $headers
     *
     *
     */
    public function addHeaders(array $headers) {
        $this->defaultHeaders = $headers + $this->defaultHeaders;
    }

    private static $noCookieUserAgents = [
        'check_http',
        'Wget',
        'Googlebot',
        'YandexBot',
        'YandexMetrika',
        'OpenStat'
    ];

    private function isUserAgentBot($userAgent) {
        foreach (self::$noCookieUserAgents as $userAgentStart) {
            if (stripos($userAgent, $userAgentStart) !== false) {
                return true;
            }
        }
        return false;
    }

    private function initUser() {
        $User = false;
        $extraUserData = [];

        $utmData = $this->Environment->getUtmData();
        if ($utmData) {
            $extraUserData = ['utmData' => $utmData];
            if (!empty($utmData['campaign'])) {
                $extraUserData['adCampaign'] = $utmData['campaign'];
            }
        }

        if (array_key_exists('userId', $_COOKIE) && $_COOKIE['userId'] > 0 && array_key_exists('session', $_COOKIE)) {
            $Session = \Session\Manager::getSession($_COOKIE['userId'], $_COOKIE['session']);
            if ($Session && $Session->userId > 0) {
                $User = \User\Manager::getUserById($Session->userId, true);
            }
        }

        if (!$User && isset($this->Environment->getRawParams()['token'])) {
            $userId = \User\Manager::verifyUriLoginToken($this->Environment->getRawParams()['token']);
            if ($userId > 0) {
                \Sign\Manager::signUser($userId, $remember = true);
                $User = \User\Manager::getUserById($userId, true);
                \Project\Logger::logText(\Project\Logger::LOGFILE_USER, "authorized user #$userId via token, isManager={$User->isManager()}");
            } else {
                \Project\Logger::logText(\Project\Logger::LOGFILE_USER, 'failed to authorize user via token');
            }
        }

        if (!$User && array_key_exists('userId', $_COOKIE) && array_key_exists('data', $_COOKIE) && array_key_exists('sign', $_COOKIE)) {
            $User = \User\ManagerAnonymous::getAnonymousUserByCookieData($_COOKIE['userId'], $_COOKIE['data'], $_COOKIE['sign']);
            if ($extraUserData) {
                if ($utmData and !$User->get('utmData')) {
                    \UTM\Manager::createEntry($User->id(), $utmData);
                }

                foreach ($extraUserData as $k => $v) {
                    $User->set($k, $v);
                }
                \Sign\Manager::signAnonymousUser($User);
            }
        }

        if (!$User) {
            if (empty($_SERVER['HTTP_USER_AGENT']) || self::isUserAgentBot($_SERVER['HTTP_USER_AGENT'])) {
                $User = new \User\Model(['id' => \User\ManagerAnonymous::BOT_USER_ID, 'created' => time()], $isNew = true);
            } else {
                $User = \User\ManagerAnonymous::createAnonymousUser($extraUserData);
                if ($utmData) {
                    \UTM\Manager::createEntry($User->id(), $utmData);
                }
                \Sign\Manager::signAnonymousUser($User);
            }
        }

        $this->currentUser = $User;

        \Project\Logger::setContext('userId', $User->id());
    }
}