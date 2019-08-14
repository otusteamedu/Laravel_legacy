<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApiPOSTMethods extends RestApiBase{
	private $currentFunction;
	function __construct(){
		parent::__construct();
		$this->method="POST";
		if($this->init){
			$function=self::getFunction();
			if(!empty($function)){		
				$this->currentFunction=$function;								
				self::{$this->currentFunction}();
			}
		}		
	}

	/*
	*	Возвращает название необходимого метода для POST запроса		
	*/
	protected function getFunction(){
		$rest=[
					'services'	=>[
									'method'	=>	[	'list'	=>'getList',
														'detail'=>'getDetail',
													],
									'iblockId'	=>	[
														'ru' => 21,
														'en' =>	69
													],
									'useCache'	=>	"N",
								],					
					];

					


		if(empty($rest[$this->rest1])){
			self::response(400);
			return false;
		}		

		$this->useCache	=	$rest[$this->rest1]['useCache'];		
		$this->iblockId =	$rest[$this->rest1]['iblockId'][$this->language];				
		return $rest[$this->rest1]['method'][$this->rest2];		

	}

}