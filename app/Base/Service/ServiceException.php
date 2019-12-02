<?php


namespace App\Base\Service;

use Throwable;

/**
 * Class ServiceException
 * @package App\Base\Service
 */
class ServiceException extends \LogicException
{
    private $errors = [];

    public function __construct($message = "", $code = 0 , Throwable $previous = null) {
        if(!empty($message))
            $this->add($message , $code);
        parent::__construct($message , $code , $previous);
    }
    /**
     * Ошибки можно копить, например если в сервисе, обрабатывается агрегат связанных
     * с базовой сущностью объектов, каждый из которых может дать ошибку, но ее не хочется выкидывать сразу.
     *
     * @param $message
     * @param int $code
     */
    public function add($message, $code = 0) {
        array_push($this->errors, [
            'code' => $code,
            'message' => $message
        ]);
    }
    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
    /**
     * @return string
     */
    public function getMessages(): string
    {
        $result = [];
        foreach($this->errors as $error)
            $result .= "[".$error['code']."] " . $error['message'];

        $glue = php_sapi_name() == 'cli' ? "\n" : "<br />";
        return implode($glue, $result);
    }
    /**
     * В случае, если ошибки накапливаются методом add(), проверка есть ли ошибки и выбрасывание
     * исключения создается тут. Это противоречит SOLID, но я не буду дробить этот мелкий класс еще на 2
     */
    public function assert() {
        if(count($this->errors) > 0)
            throw $this;
    }
}
