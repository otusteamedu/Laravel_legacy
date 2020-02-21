<?php
class CurrentAccount
{
    /** @var  CurrentAccount */
    protected static $instance;
    /** @var Account|bool|null */
    protected $account = false;
    /**
     * @return Account|null
     */
    public static function get()
    {
        $instance = self::getInstance();
        return $instance->getAccount();
    }
    /**
     * @param Account|null $account
     */
    public static function set($account)
    {
        $instance = self::getInstance();
        $instance->setAccount($account);
    }
    public static function reset()
    {
        $instance = self::getInstance();
        $instance->clear();
    }
    /**
     * @return static
     */
    protected static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }
    /**
     * @return Account|null
     */
    public function getAccount()
    {
        return $this->account;
    }
    /**
     * @param Account|null $account
     */
    public function setAccount($account)
    {
        $this->account = $account;
    }
    public function clear()
    {
        $this->account = false;
    }
}
