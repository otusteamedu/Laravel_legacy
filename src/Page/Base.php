<?php
/**
 * Базовый контроллер веб-страницы
 */

namespace Page;

abstract class Base {
    const ALLOWED_INCOMPLETE_REGISTRATION = false;
    const ONLY_FOR_MANAGER = false;
    const ONLY_FOR_ADMIN = false;
    const ALLOW_ANONYMOUS = false;
    const ALLOW_VIRTUAL = false;

    const URL_TPL = '';

    const TYPE_INT  = 1;
    const TYPE_TEXT = 2;
    const TYPE_RAW  = 3;
    const TYPE_BOOL  = 4;

    /**
     * @var \Project\Dispatcher\Web
     */
    protected $Dispatcher;
    protected $currentTpl;
    protected $bindData = [];
    protected $sendJsonHeader = false;
    protected $sendHeaders = true;
    protected $render = true;
    protected $ajaxData = [];

    /**
     * @var \User\Model
     */
    protected $User;

    public function setDispatcher(\Project\Dispatcher\Web $Dispatcher) {
        $this->Dispatcher = $Dispatcher;
        $this->User = &$Dispatcher->currentUser;
    }

    public function getCurrentTpl() {
        return $this->currentTpl;
    }

    public function getBindData() {
        return $this->bindData;
    }

    public function isRenderEnabled() {
        return $this->render;
    }

    public function isSendJsonHeader() {
        return $this->sendJsonHeader;
    }

    public function isSendHeader() {
        return $this->sendHeaders;
    }

    protected function sendJsonHeader() {
        $this->render = false;
        $this->sendHeaders = false;
        $this->sendJsonHeader = true;
        return $this;
    }

    protected function noRender() {
        $this->sendHeaders = false;
        $this->render = false;
        return $this;
    }

    protected function redirect($location) {
        $this->render = false;
        $this->sendHeaders = true;
        $this->sendJsonHeader = false;
        $this->getDispatcher()->addHeaders(['Location' => $location]);
        return $this;
    }

    public function addBindData(array $data) {
        if (!is_array($this->bindData)) {
            $this->bindData = [];
        }

        $this->bindData = array_merge($this->bindData, $data);
    }

    protected function setCurrentTpl($file) {
        $this->currentTpl = $file;
    }

    protected function getClientIp() {
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * @return \Project\Dispatcher\Web
     */
    protected function getDispatcher() {
        return $this->Dispatcher;
    }

    /**
     * @return \Project\Environment\Web
     */
    protected function getEnvironment() {
        return $this->Dispatcher->getEnvironment();
    }

    public function getUrl($params) {
        return vsprintf(static::URL_TPL, $params);
    }

    public function delete() {
        $this->get();
    }

    public function post() {
        $this->get();
    }

    public function put() {
        $this->get();
    }

    const PARAM_NAME_ALL = '*';

    /**
     * @param $paramName
     * @param $defaultValue
     * @param $valueType
     * @return mixed
     * @throws \InvalidArgumentException
     */
    protected function p($paramName, $defaultValue, $valueType) {
        $rawParams = $this->getEnvironment()->getRawParams();

        if ($paramName ===  self::PARAM_NAME_ALL) {
            if ($valueType !== self::TYPE_RAW) {
                throw new \InvalidArgumentException('If you want all received parameters - you need to take it RAW');
            }

            return $rawParams;
        }

        if (!array_key_exists($paramName, $rawParams)) {
            return $defaultValue;
        }

        switch ($valueType) {
            case self::TYPE_RAW:
                return $rawParams[$paramName];
            case self::TYPE_BOOL:
                return (bool) $rawParams[$paramName];
            case self::TYPE_INT:
                return (int) (is_scalar($rawParams[$paramName]) ? $rawParams[$paramName] : $defaultValue);
            case self::TYPE_TEXT:
            default:
                return htmlspecialchars((string) (is_scalar($rawParams[$paramName]) ? $rawParams[$paramName] : $defaultValue));
        }
    }

    protected function ajaxSuccess($data = null) {
        $this->ajaxData = [
            'success' => true,
            'data'    => $data
        ];

    }

    protected function ajaxFailure($message, $data = []) {
        $this->ajaxData = [
            'success' => false,
            'message' => $message,
            'data'    => $data
        ];
    }

    public function generalAjaxFailure() {
        $this->ajaxFailure('Неизвестная ошибка');
    }

    public function getAjaxData() {
        return $this->ajaxData;
    }

    public function allowedIncompleteReg() {
        return static::ALLOWED_INCOMPLETE_REGISTRATION;
    }

    public function onlyForManager() {
        return static::ONLY_FOR_MANAGER;
    }

    public function allowedAnonymous() {
        return static::ALLOW_ANONYMOUS;
    }

    public function allowedVirtual() {
        return static::ALLOW_VIRTUAL || static::ALLOW_ANONYMOUS;
    }

    public function onlyForAdmin() {
        return static::ONLY_FOR_ADMIN;
    }

    abstract public function get();
}