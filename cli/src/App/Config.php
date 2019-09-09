<?php

namespace Solyaris\App;

class Config implements \ArrayAccess, \Serializable
{
	private $data;
	
	public function __construct(array $data = []) {
		$this->data = $data;
    }
    
	public function has($name) : bool {
		return array_key_exists($name, $this->data);
	}    
	
	public function get($name, $default = null) {
		return $this->has($name) ? $this->data[$name] : $default;
	}
	
	public function set($name, $value = null) : self {
        if(is_null($value)) {
            if($this->has($name))
                unset($this->data[$name]);
        }
        else
            $this->data[$name] = $value;
            
		return $this;
    }

    public function getData() : array {
        return $this->data;
    }

    public function merge(Config $newConfig) : self {
	    $config = new Config($this->getData());
        $newData = $newConfig->getData();
        foreach($newData as $key => $value)
            $config->set($key, $value);

        return $config;
    }

    public function __toString() {
        return (string)\print_r($this->data, TRUE);
    }
    
    // \ArrayAccess
    public function offsetSet($offset, $value) {
        if (!is_null($offset)) {
            $this->set($offset, $value);
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        $this->set($offset);
    }

    public function offsetGet($offset) {
        return $this->get($offset);
    }

    // \Serializable
    public function serialize() {
        return \serialize($this->data);
    }
    public function unserialize($data) {
        $this->data = \unserialize($data);
        if(!$this->data || !\is_array($this->data))
            $this->data = [];
    }
}

