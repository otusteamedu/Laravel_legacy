<?php

namespace App\Common\Handler;

class CsvParser {

}
/*
abstract class CSVParser extends ProviderParser {
	//private $column;
	
	public function __construct($config) {
		parent::__construct($config);
		//$this->column = $this->getColumn();
	}
	
	public function getColumn() {
		$result = $this->getGlobal()->session('column');
		if(is_null($result)) {
			$result = array();
			$re = "/^column_([a-z0-9A-Z]+)$/i";
			$settings = $this->getConfig(); 
			foreach($settings as $key => $value) 
				if(preg_match($re, $key, $ms)) {
					$key = strtolower($ms[1]);
					$result[$key] = intval($value);
				}
		}
		return $result;
	}
	public function getFilePath() {
		$directory = $this->getGlobal()->getTmpDir();
		if(!Util::checkDir($directory))
			throw new Exception("Не удалось создать временный файл");
			
		return $directory.'/csv.tmp';
	}
	
	public function buildRow($row) 
	{
		$this->arData = array(); 
		$column = $this->getColumn();
		foreach($column as $code => $index) {
			$this->arData[$code] = null;
			if($index > 0) {
				$index = $index - 1;
				if(isset($row[$index]))
					$this->arData[$code] = Trim($row[$index]);
			}
		}
		
		$this->arData['price'] = intval(str_replace(array(",", " ", "'", "`", "\""), array(".", "", "", ""), $this->arData['price']));
		$this->arData['price'] = number_format($this->arData['price'], 2, '.', '');
		if(is_null($this->arData['quantity'])) 
			$this->arData['quantity'] = 1;
		else {
			$this->arData['quantity'] = intval(preg_replace("/[^0-9\.\-,]/", "", $this->arData['quantity']));
			$this->arData['quantity'] = intval(str_replace(",", ".", $this->arData['quantity']));
			if($this->arData['quantity'] < 0) $this->arData['quantity'] = 0;
		}
	}
	
	public function parse() {
		$handle = fopen($this->getFilePath(), "r");
		if(!$handle)
			throw new Exception("Не могу открыть файл ".$this->getFilePath());
			
		$this->nRow = 0;
		while (($row = fgetcsv($handle, 1024, ";")) !== FALSE) 
		{
			$this->nRow++;
			foreach($row as $k => $v) {
				$v = str_replace("\n", " ", $v);
				$v = iconv("windows-1251", "utf-8", $v);
				$row[$k] = $v;
			}	
			
			$this->buildRow($row); 
			if($this->validData())
				$this->addRow();
		}
		fclose($handle);
	}
	
	abstract public function getColumnNames();
	
	public function moveFile($file) {
		if(!is_array($file) || ($file['error'] > 0))
			throw new Exception("Не найден файл для загрузки");
		$fname = $this->getFilePath();
		@copy($file['tmp_name'], $fname);
	}
} */