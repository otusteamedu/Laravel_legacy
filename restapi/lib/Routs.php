<?namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class Routs{

	private static $get = [];
	private static $post = [];

	public static function get($route, $method){
		self::$get[$route]=$method;
	}
	public static function requestGet($route){
		return  self::getData(self::$get,$route);
	}
	public static function requestPost($route){
		return  self::getData(self::$post,$route);
	}
	private static function getData($method,$route){
		if(!empty($method[$route])){
			return ['method'   => $method[$route]];
		}
		$pos = strrpos($route, "/");
		$str =substr($route,0,$pos)."/+";
		if(!empty($method[$str])){
			$param=substr($route,$pos+1);
			return[
				'param'    =>    $param,
				'method'   =>    $method[$str]
			];
		}
		return "";
	}

	private function __construct() {}
   	private function __clone() {}
}
