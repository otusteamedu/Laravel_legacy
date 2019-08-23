<?php

namespace App\Common\Handler;

class SiteParser {

}

/*
require_once(ROOT_DIR."lib/providerParser.php");

abstract class SiteParser extends ProviderParser {
	private $expressions;
	
	public function __construct($config) { 
		parent::__construct($config); 
		$this->getExpressions();
	}
	
	private function getExpressions() {
		$this->expressions = array();
		$config = $this->getGlobal()->get('expressions');

		if(empty($this->expressions)) {
			foreach($config as $key => $value) 
				self::assignExpr($this->expressions, $key, $value);
		}

		return $this->expressions;
	}
	
	private static function assignExpr(&$result, $name, $value) {
		$pos = strpos($name, ".");
		if(strlen($name) <= 0)
			return;
		if(strlen($value) <= 0)
			return;
		if($pos === 0)
			return;
		if($pos > 0) {
			$key = substr($name, 0, $pos);
			$name = substr($name, $pos + 1);
			if(!array_key_exists($key, $result))
				$result[$key] = array();
			self::assignExpr($result[$key], $name, $value);
		}
		else {
			$reb = $rei = $keys = "";
			$values = explode("::", $value);
		
			if(count($values) >= 1) {
				if(count($values) == 2) {
					$rei = $values[0];
					$keys = $values[1];
				}
				else if(count($values) == 1) {
					$rei = $values[0];
				}
				else {
					$reb = $values[0];
					$rei = $values[1];
					$keys = $values[2];
				}
				
				if(strlen($reb)) $reb = "/".$reb."/is";
				if(strlen($rei)) $rei = "/".$rei."/is";
				$keys = strlen($keys) ? explode(",", $keys) : array();
				foreach($keys as &$key) $key = trim($key);
				$result[$name] = array(
					"#" => array("n" => $name, "b" => $reb, "i" => $rei, "k" => $keys)
				);
			}
		}
	}
	private static function findExpression($data, $var1/*, ...* /) {
		$args = func_get_args();
		if(count($args) < 2) return false;
		$data = array_shift($args);
		$key = array_shift($args);
		if(!array_key_exists($key, $data))
			return false;
		if(count($args) == 0)
			return $data[$key];
		
		return call_user_func_array(array(self, 'findExpression'), array_merge(array($data[$key]), $args));
	}
	
	public function reExec($text, $var1/*, ...* /) {
		// 1. Только #, 2. без #, 3. и# иНе# 
		$args = func_get_args();
		if(count($args) < 2) return null;
		$text = array_shift($args);

		$exp = call_user_func_array(
			array($this, 'findExpression'), 
			array_merge(array($this->expressions), $args)
		);

		return $this->_reExec($text, $exp);
	}
	
	private function _reExec($text, $exp) {
		$cnt_exp = count($exp);
		$sin_yes = array_key_exists("#", $exp);

		$result = false;
		if($sin_yes) {
			$value = $this->_reExec0($text, $exp["#"]);
			if($cnt_exp == 1)
				$result = $value; 
			else if(!empty($value)) {
				$name = $exp['#']['n'];
				$bMulti = (substr($name, strlen($name)-1, 1) == 's');
				unset($exp['#']);
				if($bMulti) {
					if(!array_key_exists('text', $value[0]))
						$result = $value;
					else {
						$result = array();
						foreach($value as $i => $row)
							$result[$i] = $this->_reExec($row['text'], $exp);
					}
				}
				else { 
					if(!array_key_exists('text', $value))
						$result = $value;
					else {
						$result = $this->_reExec($value['text'], $exp);
					}
				}
			}
		}
		else {
			$result = array();
			foreach($exp as $key => $item)
				if(array_key_exists("#", $item)) {
					$result[$key] = $this->_reExec0($text, $item["#"]);
				}	
		}
		
		return $result;
	}
	
	private function _reExec0($text, $exp) {
		$name = $exp['n'];
		$bMulti = (int)(substr($name, strlen($name)-1, 1) == 's');
		$result = Util::re_items($text, $exp['b'], $exp['i'], $exp['k']);
		if(empty($result)) return false;
		return $bMulti ? $result : $result[0];
	}
	
	public function parse(&$step) {
		$step += 1;
	}
} */