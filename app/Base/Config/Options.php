<?php

namespace App\Common\Config;

class Options {
	private $data;
	
	public function __construct(array $data) {
        $this->data = [];

        foreach($data as $item)
            if($item instanceof Option) {
                if($item->has($item->getId()))
                    $this->data[$item->getId()] = $item;
            }
	}
    
    public function has($id) {
        return array_key_exists($id, $this->data);
    }

	public function getData() : array {
        return $this->data;
    }

	public function getDefault() : Config {
        $result = new Config;
        foreach($this->data as $item) {
            $result[$item->getId()] = $item->getDefault();
        }

        return $result;
    }

	public function check(array $values = []) : array {
        $result = [];
        foreach($values as $key => $value) {
            if($this->has($key))
                $result[$key] = $item->check($value);
        }

        return $result;
    }
}
