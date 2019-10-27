<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApi{
	// Обработка маршрутов
	function __construct($routs){
		\Bitrix\Main\Loader::includeModule('Iblock');
		$method=self::getMethod();
		$path=parse_url($_SERVER['REQUEST_URI']);
		if (!SRP::get()) return false;
		switch ($method){
			case 'GET':
				$mt=$routs->getMethod($path['path']);
				if((!empty($mt))&&(!empty($mt['param']))){
					RestApiGETMethods::{$mt['method']}($mt['param']);
					break;
				}
				if((!empty($mt))&&(empty($mt['param']))){
					RestApiGETMethods::{$mt['method']}();
					break;
				}
					Response::getResponseText(404);
				break;
			case 'POST'	:

			$mt=$routs->postMethod($path['path']);
			if((!empty($mt))&&(!empty($mt['param']))){
				RestApiPOSTMethods::{$mt['method']}($mt['param']);
				break;
			}
			if((!empty($mt))&&(empty($mt['param']))){
				RestApiPOSTMethods::{$mt['method']}();
				break;
			}
			Response::getResponseText(404);
			break;
			default:
				self::getResponseText(404);
		}
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
}
