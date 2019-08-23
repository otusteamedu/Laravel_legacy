<?php


namespace App\Common\Handler;

/**
 * Правило обработки элемента XML
 *
 * Class ParserRule
 * @package App\Common\Handler
 */
class ParserRule {
    const DELIMITER = '/';
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $rpath;
    /**
     * @var \Closure
     */
    private $callbackIn;
    /**
     * @var \Closure
     */
    private $callbackOut;
    /**
     * @var ParserRule
     */
    private $parent;
    /**
     * @var int
     */
    private $depth;
    /**
     * @var array
     */
    private $rules;

    /**
     * ParserRule constructor.
     * @param string $id
     * @param ParserRule $parent
     * @param string $rpath
     * @param \Closure $callback
     */
    public function __construct(string $id, string $rpath, \Closure $callbackIn, \Closure $callbackOut = null)
    {
        $this->id = $id;
        $this->rpath = self::normRPath($rpath);
        $this->callbackIn = $callbackIn;
        $this->callbackOut = $callbackOut;

        $this->parent = null;
        $this->depth = 0;
        $this->rules = [];
    }

    /**
     * @return string
     */
    public function getId(): string {
        return $this->id;
    }
    /**
     * @return string
     */
    public function getParentId(): string {
        return $this->parent ? $this->parent->getId() : '';
    }
    /**
     * Полный селектор
     * @return string
     */
    public function getPath(): string {
        $result = [  ];
        $rule = $this;
        do {
            array_unshift($result, $rule->rpath);
            $rule = $rule->getParent();
        }
        while($rule);

        return implode("", $result);
    }
    /**
     * Нормализовать относительный селектор.
     * Правильно /path/ro/xml/node
     * @return string
     */
    private static function normRPath(string $rpath) {
        $rpath = str_replace("\\", self::DELIMITER, $rpath);
        if(substr($rpath, 0, 1) != self::DELIMITER)
            $rpath = self::DELIMITER . $rpath;
        if(substr($rpath, -1, 1) == self::DELIMITER)
            $rpath = substr($rpath, 0, strlen($rpath) - 1);
        return $rpath;
    }

    /**
     *
     * @return ParserRule|null
     */
    public function getParent(): ?self {
        return $this->parent;
    }
    public function getDepth() : int {
        return $this->depth;
    }

    public function addChild(ParserRule $child) {
        $child->parent = $this;
        $child->depth = $this->depth + 1;

        $this->rules[] = $child;
    }

    public function hasChild(ParserRule $child) {
        return ($this == $child->getParent());
    }

    public function apply(ParserContext $ctx, ParserData $data, $nPhase) {
        $ctx->setRule($this);
        call_user_func_array($this->callback, [$data, $nPhase, $ctx]);
    }
}




/**
function ($context, $data, $nPhase) {
    $property = () $context->getObject('property', Property::class);
}



 */