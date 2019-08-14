<?php


namespace App\Common\Config;


final class Option {
    const T_STRING = 1;
    const T_NUMBER = 2;
    const T_LIST = 3;
    const T_BOOLEAN = 4;

    private $id;
    private $type;
    private $name;
    private $default;
    private $values; // map for T_LIST

    /**
     * Option constructor.
     * @param $id
     * @param $type
     * @param $name
     * @param $default
     * @param array $values
     */
    public function __construct($id, $type, $name, $default, array $values = [])
    {
        $this->id = $id;
        $this->type = $type;
        $this->name = $name;
        $this->default = $default;
        $this->values = $values;
    }

    /**
     * @return string
     */
    public function getId() : string {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getType() : int {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDefault() : string {
        if(self::T_LIST == $this->getType()) {
            if(!array_key_exists($this->default, $this->values)) {
                $keys = array_keys($this->values);
                $this->default = count($keys) ? $keys[0] : '';
            }
        }
        return $this->default;
    }

    /**
     * @return array
     */
    public function getValues() : array {
        return $this->values;
    }

    /**
     * @param $value
     * @return bool|int|string
     */
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