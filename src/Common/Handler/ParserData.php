<?php


namespace App\Common\Handler;

/**
 * Данные
 * Class ParserData
 * @package App\Common\Handler
 */
final class ParserData
{
    /**
     * Имя ноды
     * @var string
     */
    private $name;
    /**
     * Данные ноды
     * @var string
     */
    private $value;
    /**
     * Атрибуты ноды
     * @var array
     */
    private $attributes;

    public function __construct(string $name, string $value = "", array $attrs = []) {
        $this->name = $name;
        $this->value = $value;
        $this->attributes = $attrs;
    }

    public function getName(): string {
        return $this->name;
    }
    public function getValue(): string {
        return $this->value;
    }
    public function setValue(string $value): self {
        $this->value = $value;
        return $this;
    }
    public function getAttributes(): array {
        return $this->attributes;
    }
    public function setAttributes(array $value): self {
        $this->attributes = $value;
        return $this;
    }
    public function getAttribute(string $name): ?string {
        return array_key_exists($name, $this->attributes) ? $this->attributes[$name] : null;
    }
    public function setAttribute(string $name, string $value = null): self {
        if(is_null($value)) {
            if(array_key_exists($name, $this->attributes))
                unset($this->attributes[$name]);
        }
        else
            $this->attributes[$name] = $value;

        return $this;
    }
}