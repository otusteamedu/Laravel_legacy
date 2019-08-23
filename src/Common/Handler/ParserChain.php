<?php


namespace App\Common\Handler;


use App\Common\Worker\TaskManagerException;

class ParserChain {
    private $xmlParser;
    private $context;
    private $rootRule;
    private $rulesMap;
    private $rpathMap;

    public function __construct(XmlParser $xmlParser, string $xpath, \Closure $callbackIn, \Closure $callbackOut) {
        $this->xmlParser = $xmlParser;
        $this->context = new ParserContext($this);
        $this->rootRule = new ParserRule('', $xpath, $callbackIn, $callbackOut);
        $this->rulesMap = [];
        $this->rpathMap = [];
    }

    public function findRuleById(string $id): ?ParserRule {
        if(empty($id))
            return $this->rootRule;
        return
            (array_key_exists($id, $this->rulesMap)
                && $this->rulesMap[$id] instanceof ParserRule) ?
                $this->rulesMap[$id] : null;
    }

    public function findRuleByPath(string $rpath): ?ParserRule  {
        if(empty($rpath))
            return $this->rootRule;
        return
            (array_key_exists($rpath, $this->rpathMap)
                && $this->rpathMap[$rpath] instanceof ParserRule) ?
                $this->rpathMap[$rpath] : null;
    }

    /**
     * Объект ParserRule создаем внутри метода ParserChain,
     * запрещая тем самым его существование отдельно от ParserChain.
     * Излишек параметров и относительные селекторы объясняются необходимостью
     * исключения ошибок по невнимательности при создании правил обработки
     *
     * @param string $id - ID правила, уникально в рамках ParserChain
     * @param string $parentId - ID родительского правила
     * @param string $rpath - селектор относительно родительского правила
     * @param \Closure $callback - обработчик правила
     * @throws XmlParserException
     */
    public function AddRule(string $id, string $parentId, string $rpath, \Closure $callbackIn, \Closure $callbackOut = null)
    {
        // подобные исключения выкидываются на этапе отладки
        if(empty($id) || $this->findRuleById($id))
            throw new XmlParserException("Правило с ID = '".$id."' уже существует");

        $parent = empty($parentId) ? $this->rootRule : $this->findRuleById($parentId);
        if(!$parent)
            throw new XmlParserException("Родительского правила с ID = '".$parentId."' не найдено");

        $rule = new ParserRule($id, $rpath, $callbackIn, $callbackOut);
        $parent->addChild($rule);

        $this->rulesMap[$id] = $rule;
        $this->rpathMap[$rule->getPath()] = $rule;

        return $this;
    }

    public function applyRule(string $rpath, ParserData $data, $nPhase) {
        $rule = $this->findRuleByPath($rpath);
        $rule->apply($this->context, $data, $nPhase);
    }

    public function getAllRules(): array {
        return array_values($this->rulesMap);
    }

    public function getPath(): string {
        return $this->rootRule->getPath();
    }

    public function getContext(): ParserContext {
        return $this->context;
    }
}