<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApiGETMethods {

	 public static function getList(){
		$ib=10;
		$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		$limit=$request->get('limit');
		$offset=$request->get('offset');
		if(!isset($limit)) $limit=10;
		if(!isset($offset)) $offset=0;
	 	$select = [
	 			"ID",
	 			"NAME",
	 			"PREVIEW_PICTURE",
	 			"DETAIL_TEXT"
	 	];
	 	$filter = [
	 			"ACTIVE" 		=> "Y",
	 			"IBLOCK_ID" 	=> $ib
	 	];

	 	$rsElements = \Bitrix\Iblock\ElementTable::getList(
	 			[
	 					'order' 	=> 	['SORT' => 'ASC'],
	 					'select' 	=> 	$select,
	 					'filter' 	=> 	$filter,
						 'limit' 	=> 	$limit,
	 					 'offset'	=> 	$offset
	 			]
	 			);
	 	$result=[];
	 	while ($item = $rsElements->fetch())
	 	{
	 		$text = substr($item['DETAIL_TEXT'], 0, 180);
	 		$result[]=
	 		[
	 				'id'	=>	$item['ID'],
	 				'name'	=>	$item['NAME'],
	 				'image' =>  \CFile::GetPath($item['PREVIEW_PICTURE']),
	 		];
	 	}


	 	if($result){
	 		$result=[
	 				'count'	=> self::getElementsCount($ib),
	 				'result'=> $result
	 		];
	 	}
		echo Response::Result($result);
	 }


	 /*
 	 *	Получить детальный элемент
 	 *	return @detail
 	 */
 	public static function getDetail($id){
		$ib=10;

 		$select = [
 				'ID',
 				"NAME",
 				"DETAIL_PICTURE",
 				"DETAIL_TEXT",
 		];

 		$rsElements = \Bitrix\Iblock\ElementTable::getList(
 				[
 						'order' 	=> 	['SORT' => 'ASC'],
 						'select' 	=> 	$select,
 						'filter' 	=> 	[
 								"ID"    	=> $id,
 								"IBLOCK_ID" => $ib,
 								"ACTIVE" 	=> "Y",
 						],
 				]
 				);
 		if ($item = $rsElements->fetch())
 		{
 			$result=[
 					'id'	=>	$item['ID'],
 					'name'	=>	$item['NAME'],
 					'image' 	=> \CFile::GetPath($item['DETAIL_PICTURE']),
 					'text' => 	$item['DETAIL_TEXT'],
 			];

 		}
		echo Response::Result($result);
 	}





	/*
	 *	список заведений кафе и ресторанов на территории Казань Экспо
	 *	return @list
	 */
	public static function getInstitutionsList(){
		$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
		$limit=$request->get('limit');
		$offset=$request->get('offset');
		if(!isset($limit)) $limit=10;
		if(!isset($offset)) $offset=0;
		$select = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_TEXT"
		];
		$filter = [
				"IBLOCK_ID" 	=> Setting::IBLOCK_INSTITUTIONS_RUS_ID,
				"ACTIVE" 		=> "Y"
		];
		$rsElements = \Bitrix\Iblock\ElementTable::getList(
				[
						'order' 	=> 	['SORT' => 'ASC'],
						'select' 	=> 	$select,
						'filter' 	=> 	$filter,
						'limit' 	=> 	$limit,
						'offset'	=> 	$offset
				]
				);
		$result=[];

		while ($item = $rsElements->fetch())
		{
			$result[]=
			[
					'id'	=>	$item['ID'],
					'name'	=>	$item['NAME'],
					'image' =>  \CFile::GetPath($item['PREVIEW_PICTURE']),
					'text' 	=> 	TruncateText(strip_tags($item['DETAIL_TEXT']),200),
			];
		}

		echo Response::Result($result);
	}

	/*
	 *	информация по заведения кафе
	 *	return @detail
	 */
	public static function getInstitutionsDetail($id){

		$arSelect = [
				'ID',
				"NAME",
				"DETAIL_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_TYPE",
				"PROPERTY_HREF_INFO",
				"PROPERTY_MAP",
				"PROPERTY_PLACE"
		];

		$arFilter	= 	[
				"ID"    	=> $id,
				"IBLOCK_ID" => Setting::IBLOCK_INSTITUTIONS_RUS_ID,
				"ACTIVE" 	=> "Y",
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
		$result=[];
		if($item = $res->fetch()){
			$result=[
					'id'	=>	$item['ID'],
					'name'	=>	$item['NAME'],
					'image'	=> \CFile::GetPath($item['DETAIL_PICTURE']),
					'text' 	=> 	$item['DETAIL_TEXT'],
					'coordinates'=> $item['PROPERTY_MAP_VALUE'],
					'type'=> $item['PROPERTY_TYPE_VALUE'],
					'link'=> $item['PROPERTY_HREF_INFO_VALUE'],

			];

			if(!empty($item['PROPERTY_PLACE_VALUE'])){
				$arPlaceSelect = [
					'ID',
					"NAME",
					"PROPERTY_MAP"
				];
				$arPlaceFilter	= 	[
						"ID"    	=> $item['PROPERTY_PLACE_VALUE'],
						"ACTIVE" 	=> "Y",
						"IBLOCK_ID"	=> $IBLOCK_LOCATIONS_ID,
				];
				$resPlace = \CIBlockElement::GetList(Array(), $arPlaceFilter, false, Array("nPageSize"=>1), $arPlaceSelect);
				if($itemPlace = $resPlace->fetch()){
					$place=[
						'id'			=>	$itemPlace['ID'],
						'name'			=>	$itemPlace['NAME'],
						'coordinates'	=>	$itemPlace['PROPERTY_MAP_VALUE'],
						];
					$result['place']	=	$place;
				}
			}

		}
		echo Response::Result($result);

	}
}
