<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApi{
	private $method;
	function __construct(){
		$this->method 	=	\Rest\RestApiBase::getMethod();
		self::getRestMethod();
	}
	/*
	 *	Выбор необходимого метода
	 */
	private function getRestMethod(){
		switch ($this->method){
			case 'GET':{
				new \Rest\RestApiGETMethods();
				break;
			}
			case 'POST':{
				new \Rest\RestApiPOSTMethods();
				break;
			}
			default:{
				\Rest\RestApiBase::getResponseText();
			}
		}
	}

	/*
		Очистка кэша приобновлении элемента
		*/
	function OnAfterIBlockRestElementUpdateHandler(&$arFields)
	{
        $cacheFullPath	=	$_SERVER['DOCUMENT_ROOT']."/bitrix/cache/restapi_cache/";
		BXClearCache(true, "/restapi_cache/");
		if(file_exists($cacheFullPath)){
			BXClearCache(true, "/restapi_cache/");
		}
	}
}
