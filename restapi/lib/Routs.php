<?namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class Routs{

	private $get = [];
	private $post = [];
    /*
    * Добавить GET метод
    */
	public function addGet($route, $method){
		$this->get[$route]=$method;
	}
	/*
    *  Получить метод по GET запросу
    */
	public function getMethod($route){
		return self::getData($this->get,$route);

	}
    /*
    * Добавить POST метод
    */
	public function addPost($route, $method){
		$this->post[$route]=$method;
	}
	/*
    *  Получить метод по POST запросу
    */
	public function postMethod($route){
		return self::getData($this->post,$route);
	}
	private function getData($method,$route){
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
}
