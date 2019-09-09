<?php


namespace Solyaris\App;


final class Option {
    const T_STRING = 1;
    const T_NUMBER = 2;
    const T_LIST = 3;
    const T_BOOLEAN = 4;
    /**
     * @var string
     */
    private $id;
    /**
     * @var int
     */
    private $type;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $hint;
    private $default;
    /**
     * @var array
     */
    private $values; // map for T_LIST

    public function __construct(string $id, int $type, string $name, $default, string $hint, array $values = [])
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->hint = $hint;
        $this->default = $default;
        $this->values = $values;
    }

    public function getId() : string {
        return $this->id;
    }

    public function getType() : int {
        return $this->type;
    }

    public function getName() : string {
        return $this->name;
    }

    public function getHint() : string {
        return $this->hint;
    }

    public function getDefault() : string {
        if(self::T_LIST == $this->getType()) {
            if(!array_key_exists($this->default, $this->values)) {
                $keys = array_keys($this->values);
                $this->default = count($keys) ? $keys[0] : '';
            }
        }
        return $this->default;
    }

    public function getValues() : array {
        return $this->values;
    }

    public function check($value) {
        $value = (string) $value;
        $type = $this->getType();

        if(self::T_LIST == $type) {
            if(!array_key_exists($value, $this->values))
                $value = '';
        }
        else if(self::T_NUMBER == $type) {
            $value = (int) \preg_replace("/[^0-9]+/is", "", $value);
        }
        else if(self::T_BOOLEAN == $type) {
            $value = strtolower($value);
            $value = !(empty($value) || $value == 'n' || $value == 'no');
        }

        return $value;
    }
}