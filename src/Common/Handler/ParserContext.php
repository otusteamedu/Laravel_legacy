<?php


namespace App\Common\Handler;

/**
 * Объект передается в качестве аргумента в конечную функию-обработчик
 * Назначение - упростить написание самой функции обработчика.
 *
 * Class ParserContext
 * @package App\Common\Handler
 */
class ParserContext
{
    /**
     * @var ParserChain
     */
    private $chain;
    /**
     * @var array
     */
    private $objStack;
    /**
     * @var ParserRule
     */
    private $rule;
    /**
     * @var array
     */
    public function __construct(ParserChain $chain)
    {
        $this->chain = $chain;
        $this->objStack = [];
    }

    /**
     * @param ParserRule $rule
     */
    public function setRule(ParserRule $rule)
    {
        $this->rule = $rule;
        $index = $rule->getDepth();
        $this->objStack[$index] = null;
    }

    public function setObj(mixed $object) {
        $index = $this->rule->getDepth();
        $this->objStack[$index] = $object;
    }

    /**
     * Получить дата-объект текущего правила
     * @return mixed
     */
    public function getObj(): mixed {
        $index = $this->rule->getDepth();
        return $this->objStack[$index];
    }
    /**
     * Получить дата-объект родительского правила
     * @return mixed
     */
    public function parentObj(): mixed {
        $index = $this->rule->getDepth() - 1;
        return ($index >= 0) ? $this->objStack[$index] : null;
    }

    /**
     * Получить дата-объект по Id правила
     * @param string $ruleId
     * @return mixed
     */
    public function findObj(string $ruleId): mixed {
        $depth = $this->rule->getDepth();
        $rule = $this->chain->findRuleById($id);
        if(!$rule || ($depth <= $rule->getDepth()))
            return null;

        return $this->objStack[$rule->getDepth()];
    }
}