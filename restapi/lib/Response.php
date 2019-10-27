<?namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class Response{
    /*
    * Сформировать результат
    */
    public static function Result($result){
        if (!empty($result)){
            self::setHeaders();
            return json_encode($result,JSON_UNESCAPED_UNICODE);
        }
        return self::getResponseText(404);
    }
    /*
    * Сформировать заголовки
    */
    public static function setHeaders(){
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Methods: *");
		header('Content-Type: application/json;charset=utf-8');
	}
    /*
    * Коды ответов
    */
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

}
