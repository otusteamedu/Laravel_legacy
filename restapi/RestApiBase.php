<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

abstract class RestApiBase{

	protected $rest1;		// 	Тип Список/Детально
	protected $rest2;		//	Что надо получить
	protected $rest3;		//	Что надо получить
	protected $page;		//	Номер страницы / ID новости
	protected $limit;		//	Номер страницы / ID новости
	protected $language;	//	язык
	protected $iblockId; 	// 	id инфоблока с которого идетвыборка
	protected $method; 		// 	Определение метода запроса
	protected $requestData; // 	результат
	protected $cachePath;	//  Полный путь до кэша
	protected $cacheCode;	//	Код кэша
	protected $cacheTime;	//	Время хранения кэша
	protected $useCache;	// 	Используется ли кэш
	protected $init;		//  Если инициализация прошла
	private   $restPage;	//  Страница вызова
	protected $stateText =[
			200 => 'OK',
			400 => 'Bad Request',
			404 => 'Not Found',
			405 => 'Method Not Allowed',
			500 => 'Internal Server Error'
	];

	function __construct($restPage='restapi'){
		\Bitrix\Main\Loader::includeModule('Iblock');
		self::setHeaders();

		$this->restPage=$restPage;

		$this->init = self::initData();
		if($this->init){
			self::setLanguage();
		}
	
	}
	private function setHeaders(){		
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: *");
		header('Content-Type: application/json;charset=utf-8');
	}



	protected function initCache(){

		$rest3=(isset($this->rest3))?$this->rest3:"noval";
		$cacheDir 			=	Setting::REST_CACHE_DIR;
		$this->cacheCode	=	Setting::REST_CACHE_CODE;
		$this->cacheTime	=	Setting::REST_CACHE_TIME;
		$this->cachePath	=
		"/$cacheDir/{$this->iblockId}/{$this->rest1}/{$this->rest2}/{$this->rest3}/page{$this->page}/limit{$this->limit}/";
		 
	}

	/*
	 *	Инициализация метода POST GET ...
	 */
	public static function getMethod(){
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method == 'POST' && array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {
			if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
				$method = 'DELETE';
			} else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
				$method = 'PUT';
			} else {
				throw new Exception("Unexpected Header");
			}
		}
		return $method;
	}

	/*
	 *	Инициализация входных папрметров
	 */
	private function initData(){
		$fullUrl=$_SERVER['REQUEST_URI'];
		if(!empty($this->restPage)){
			$url=str_replace("/{$this->restPage}/","", $fullUrl);		
		}else{			
			$url=substr($fullUrl,1);	
		}
		$arr=explode("/", $url,-1);

		$this->rest1 	= 	$arr[0];
		$this->rest2 	=	$arr[1];
		switch($this->rest2){
			case 'detail':{
				$this->rest3 	=	$arr[2];
				return true;
			}
			case 'list':{
				$this->page 	=	(!isset($_GET['page'])) ?	1	:	trim($_GET['page']);
				$this->limit 	=	(!isset($_GET['limit']))?	10 	:	trim($_GET['limit']);
				if(isset($arr[2])){
					$this->rest3 	=	$arr[2];
				}
				return true;
			}
			default:{
				self::response(404);
				return false;
			}
		}
		return false;
	}
	/*
	 *	Установить язык
	 *	@language
	 */
	private function setLanguage(){
		$lang	=	apache_request_headers()['Accept-Language'];
		switch ($lang){
			case 'ru':{
				$this->language =	'ru';
				break;
			}
			case 'en':{
				$this->language =	'en';
				break;
			}
			default:{
				$this->language =	'ru';
			}
		}
	}

	/*
	 *	Сообщение об ошибке
	 */
	protected function response($code=200){
		if ($code===200){
			if(!empty($this->requestData)){
				header("HTTP/1.1 " . $code . " " . $this->stateText[$code]);
				echo json_encode($this->requestData,JSON_UNESCAPED_UNICODE);
				return;
			}
			$code=400;
		}
		self::getResponseText($code);
	}
	public static function getResponseText($code){
		$stateText =[
				200 => 'OK',
				400 => 'Bad Request',
				404 => 'Not Found',
				405 => 'Method Not Allowed',
				500 => 'Internal Server Error'
		];
		$result["status"]=$code;
		$result['error']=$stateText[$code];
		header("HTTP/1.1 " . $code . " " . $stateText[$code]);
		echo json_encode($result,JSON_UNESCAPED_UNICODE);
	}

	/*
	 *	Возвращает количество элементов в инфоблоке
	 *	return int @count
	 */
	protected function getElementsCount()
	{
		$arFilter = Array("IBLOCK_ID"=>$this->iblockId, "ACTIVE"=>"Y");
		return \CIBlockElement::GetList(Array(), $arFilter, Array(), false, Array());
	}
	abstract protected function getFunction();

}
