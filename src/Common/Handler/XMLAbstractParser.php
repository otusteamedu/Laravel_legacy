<?php

namespace App\Common\Handler;

use App\Common\File;

/**
 * Парсер XML потокового типа, отличается от xml_parser тем, что может останавливаться и возобновляться в любом месте
 * Регистрируем события входа в элемент addNewHandler, выхода из элемента addPostHandler
 * При обходе файла будут вызываться обработчики событий с именем do$Name
 * Можно задать начальное смещение в анализируемом файле для дальнейшей цели пошаговой обработки для больших файлов.
 */

abstract class XMLAbstractParser
{
    /**
     * объект открытого файла
     * @var File
     */
	private $file;	
	
    /**
     * Анализируемый файл
     * @var string
     */
	private $filePath;
	
    /**
     * Смещение относительно начала файла
     * @var int
     */
	private $nOffset;
	
    /**
     * Текущий тег, содержит имя тега - name, аттрибуты - attributes, текстовое содержимое - text
     * @var ParserData
     */
	private $currentTag;
	
    /**
     * Путь к текущему, меняется при событиях входа в тег и выхода из тега
     * @var array
     */
	private $tagStack;
	

    /**
     * Массив массивов обработчиков
     * @var array
     */
	protected $handlers;

    /**
     * Фазы для сохранения обработчиков
     */
	const PHASE_NEW = 0;	// вход элемент
	const PHASE_POST = 1;	// выход из элемента

    /**
     * Количество анализируемых данных за раз
     */
	const BUFFER_SIZE = 4096; // 65536;	// по 64 килобайта норм.
	
	const CHARSET_OUT = "utf-8";
	
    /**
     * Пошаговое чтение
     */
	private $buf;
	private $buf_position;
	private $buf_len;
	private $charset;	
	
    /**
     * Constructor
     * @param string $path
	 * @param int $offset
     */
	public function __construct(string $path) 
	{
		$this->filePath = $path;
		$this->file = null;
		$this->nOffset = 0;
		
		$this->currentTag = null;
		$this->tagStack = array();
		
		$this->buf = "";
		$this->buf_position = 0;
		$this->buf_len = 0;
		$this->charset = "";		
		
		$this->arData = array();
		
		$this->handlers = array(
			self::PHASE_NEW => array(), 
			self::PHASE_POST => array()
		);
	}
	
    /**
     * Два параметра - nOffset и tagStack при пошаговом выполнении должны  
	 * восстанавливаться из сессии, бд или файла - зависит от реализации XMLParser
	 *
	 * @return void 
     */
	public function setState(array $state = []) {
		$this->nOffset = array_key_exists('offset', $state) ? intval($state['offset']) : 0;
		$this->tagStack = array_key_exists('stack', $state) && is_array($state['stack']) ? $state['stack'] : [];
	}
	
	public function getState() : array {
		return [
			'offset' => $this->nOffset,
			'stack' => $this->tagStack
		];
	}
	
    /**
     * При пошаговом выполнении мы должны знать когда хватит выполнять анализ. 
	 * Эта проверка в наследнике XMLParser будет выполняться всегда при закрытии тега.
	 * По-умолчанию возвращается false - это значит файл будет считываться за один проход
	 *
	 * @return boolean 
     */
	public function isMustInterrupt() : bool {
		return false;
	}
	 

    /**
     * Получаем текущую позицию
	 
	 * @return int 
     */
	public function getOffset() {
		return $this->nOffset;
	}

    /**
     * Конвертация кодировки charset в CHARSET_OUT
	 *
     * @param string $text
	 * @return string 
     */
	private function convertCharset($text) {
		if(strlen($text) <= 0)
			return $text;

		if(($this->charset != "") && ($this->charset != self::CHARSET_OUT))
			$text = iconv($this->charset, self::CHARSET_OUT, $text);
		
		return $text;
	}

    /**
     * Начинает анализ документа
	 *
	 * @throws App\Common\FileOpenException
	 * @throws \Exception
     */
	public function start() {
		$this->file = new File($this->filePath);
	
		$fstream  = $this->file->open("r");
		if($this->getOffset() > 0)
			$this->file->seek($this->getOffset());
		
		while(($xmlChunk = $this->_get_xml_chunk($fstream)) !== false)
		{
			$xmlChunk = $this->convertCharset($xmlChunk);

			if($xmlChunk[0] == "/") {
				$this->__element_close($xmlChunk);
				if($this->isMustInterrupt())
					break;
			}
			elseif($xmlChunk[0] == "!" || $xmlChunk[0] == "?") {
				if(substr($xmlChunk, 0, 4) === "?xml")
					if(preg_match('#encoding[\s]*=[\s]*"(.*?)"#i', $xmlChunk, $arMatch))
						$this->charset = strtolower($arMatch[1]);
			}
			else {
				$this->__element_open($xmlChunk);
			}		
		}
		
		$this->end();
	}
	
    /**
     * Заканчивает анализ документа, освобождает ресурс
	 *
	 * @throws App\Common\FileOpenException
	 * @throws \Exception
     */
	public function end() {
		$this->file->close();
	}

    /**
     * Путь к текущему элементу
	 *
	 * @return string 
     */
	public function getPath() {
		return implode('/', $this->tagStack);
	}

    /**
     * Добавить обработчики входа-выхода из элемента. Вход - как правило что-то инициализируется. Выход - сохраняется.
	 * 
	 * @param string $name в наследнике XMLParser должен быть определен метод on<Name>(ParserData $currentTag)
	 * @param string $path путь до ноды по шаблону <root_element>/<sub_element_1>/../<sub_element_n>
     */
	public function onNewElement($name, $path)
	{
		$methodName = 'do'.strtoupper($name[0]).strtolower(substr($name, 1));
		if(method_exists($this, $methodName)) {
			if(array_key_exists($path, $this->handlers[self::PHASE_NEW]))
				return;
			$this->handlers[self::PHASE_NEW][$path] = array($methodName, $this);
		}
	}
	public function onEndElement($name, $path) 
	{
		$methodName = 'do'.strtoupper($name[0]).strtolower(substr($name, 1)); 
		if(method_exists($this, $methodName))
		{
			if(array_key_exists($path, $this->handlers[self::PHASE_POST]))
				return;
			$this->handlers[self::PHASE_POST][$path] = array($methodName, $this);
		}
	}
	public function onElement($name, $path)
	{
		$this->onNewElement($name, $path);
		$this->onEndElement($name, $path);
	}
	private function _exec_handlers($nPhase) 
	{
		if(!array_key_exists($nPhase, $this->handlers))
			return;
		
		$path = $this->getPath(); 
		if(array_key_exists($path, $this->handlers[$nPhase])) {
			$f = $this->handlers[$nPhase][$path];
			call_user_method($f[0], $f[1], $this->currentTag, $nPhase, $path);
		}
	}
	
	private function _get_xml_chunk($handle)
	{
		if($this->buf_position >= $this->buf_len)
		{
			if(!feof($handle))
			{
				$this->buf = fread($handle, self::BUFFER_SIZE);
				$this->buf_position = 0;
				$this->buf_len = strlen($this->buf);
			}
			else
				return false;
		}

		//Skip line delimiters (ltrim)
		$xml_position = strpos($this->buf, "<", $this->buf_position);
		while($xml_position === $this->buf_position)
		{
			$this->buf_position++;
			$this->nOffset++;
			//Buffer ended with white space so we can refill it
			if($this->buf_position >= $this->buf_len)
			{
				if(!feof($handle))
				{
					$this->buf = fread($handle, self::BUFFER_SIZE);
					$this->buf_position = 0;
					$this->buf_len = strlen($this->buf);
				}
				else
					return false;
			}
			$xml_position = strpos($this->buf, "<", $this->buf_position);
		}

		//Let's find next line delimiter
		while($xml_position===false) {
			$next_search = $this->buf_len;
			//Delimiter not in buffer so try to add more data to it
			if(!feof($handle)) {
				$this->buf .= fread($handle, self::BUFFER_SIZE);
				$this->buf_len = strlen($this->buf);
			}
			else
				break;

			//Let's find xml tag start
			$xml_position = strpos($this->buf, "<", $next_search);
		}
		if($xml_position===false)
			$xml_position = $this->buf_len+1;

		$len = $xml_position-$this->buf_position;
		$this->nOffset += $len;
		$result = substr($this->buf, $this->buf_position, $len);
		$this->buf_position = $xml_position;

		return $result;
	}
	
	/*
	Internal function.
	Stores an element into xml database tree.
	*/
	function __element_open($xmlChunk)
	{
		static $search = array(
			"'&(quot|#34);'i",
			"'&(lt|#60);'i",
			"'&(gt|#62);'i",
			"'&(amp|#38);'i"
		);

		static $replace = array(
			"\"", "<", ">", "&"
		);

		$elementName = "";
		$elementAttrs = array();
		$elementValue = "";
		
		$bAndClose = false;
		$p = strpos($xmlChunk, ">");
		if($p !== false) {
			if(substr($xmlChunk, $p - 1, 1)=="/") {
				$elementName = substr($xmlChunk, 0, $p-1);
				$bAndClose = true;
			}
			else {
				$elementName = substr($xmlChunk, 0, $p);
				$elementValue = substr($xmlChunk, $p+1);
				if(!preg_match("/^\s*$/", $elementValue)) {
					if(strpos($elementValue, "&") !== false)
						$elementValue = preg_replace($search, $replace, $elementValue);
				}
			}
			if(($ps = strpos($elementName, " ")) !== false)
			{
				//Let's handle attributes
				$elementAttr = substr($elementName, $ps+1);
				$elementName = substr($elementName, 0, $ps);
				preg_match_all("/(\\S+)\\s*=\\s*[\"](.*?)[\"]/su", $elementAttr, $attrs_tmp);
				if(strpos($elementAttr, "&")===false)
				{
					foreach($attrs_tmp[1] as $i=>$attrs_tmp_1)
						$elementAttrs[$attrs_tmp_1] = $attrs_tmp[2][$i];
				}
				else
				{
					foreach($attrs_tmp[1] as $i=>$attrs_tmp_1)
						$elementAttrs[$attrs_tmp_1] = preg_replace($search, $replace, $attrs_tmp[2][$i]);
				}
			}

			array_push($this->tagStack, $elementName);
			$this->currentTag = new ParserData($elementName, $elementValue, $elementAttrs);

			$this->_exec_handlers(XMLParser::PHASE_NEW);
			if($bAndClose)
				$this->__element_close($xmlChunk);
		}
	}

	/*
	Internal function.
	Winds tree stack back. Modifies (if neccessary) internal tree structure.
	*/
	function __element_close($xmlChunk)
	{
		$this->_exec_handlers(XMLParser::PHASE_POST);
		$child = array_pop($this->tagStack);
	}	
}