<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

class RestApiGETMethods extends RestApiBase{

	private $currentFunction;
	function __construct(){
		parent::__construct();
		$this->method="GET";
		if($this->init){
			self::getFunction();
			if(!empty($this->currentFunction)){
				self::initCache();
				if($this->useCache==="Y"){
					self::getCacheData();
				}else{
					self::{$this->currentFunction}();
				}
				self::response();
			}
		}
	}

	private function getEventsExponenetsList(){
		$IBLOCK_EVENTS_ID 	=	($this->language==='en')?Setting::IBLOCK_EVENTS_EN_ID:Setting::IBLOCK_EVENTS_RUS_ID;
		$expSelect=[
				"ID",
				"NAME",
				"PROPERTY_ABOUT_PLACE",
				"PROPERTY_PHONE",
				"PROPERTY_ADDRESS",
				"PROPERTY_PLACE_IN_EXHIBITION",
				"PROPERTY_LOGO"
		];
		$expFilter=[
				"IBLOCK_ID" => $this->iblockId ,
				"ACTIVE" 	=> "Y",
				"ID" 		=> \CIBlockElement::SubQuery("PROPERTY_EXPONENTS", 
						["ID"=>$this->rest3, "IBLOCK_ID" => $IBLOCK_EVENTS_ID,"ACTIVE"=>"Y"]),
		];
		$rsExp = \CIBlockElement::GetList(
				["SORT" => "ASC"],
				$expFilter,
				false,
				["nPageSize"=>$this->limit,'iNumPage'=>$this->page],
				$expSelect
				);
		while($arExp = $rsExp->Fetch()){
			$result[]=[
					'id'	=>	$arExp['ID'],
					'name'	=>	$arExp['NAME'],
					'address'	=>	$arExp["PROPERTY_ADDRESS_VALUE"],
					'about_place'	=>	$arExp["PROPERTY_ABOUT_PLACE_VALUE"]['TEXT'],
					'phone'	=>	$arExp["PROPERTY_PHONE_VALUE"],
					'place_in_exhibition'	=>	$arExp["PROPERTY_PLACE_IN_EXHIBITION_VALUE"],
					'logo'	=>	\CFile::GetPath($arExp["PROPERTY_LOGO_VALUE"])
			];
		}
		
		$this->requestData=[
				'count'	=> \CIBlockElement::GetList([], $expFilter, [], false, []),
				'result'=> $result

		];

	}
	private function getExponenetsDetail(){
			
		$arSelect = [
				"IBLOCK_ID",
				"ID",
				"NAME",
				"PROPERTY_ADDRESS",
				"DETAIL_PICTURE",
				"DETAIL_TEXT",
				"DETAIL_PAGE_URL",
				"PROPERTY_LOGO",
				"PROPERTY_PHONE",
				"PROPERTY_ABOUT_PLACE",
				"PROPERTY_PLACE_IN_EXHIBITION",
		];

		$arFilter = ["IBLOCK_ID" 	=> $this->iblockId, "ID"=>$this->rest3,"ACTIVE" => "Y"];
			
		$res = \CIBlockElement::GetList(Array(), $arFilter, false,["nPageSize"=>1], $arSelect);
		$result=[];
		if ($item = $res->Fetch())
		{
			$result=[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'photo'		=>	$item['DETAIL_PICTURE'],
					'adderss'		=>	$item['PROPERTY_ADDRESS_VALUE'],
					'about_company'	=>	$item['DETAIL_TEXT'],
					'phone'			=>	$item['PROPERTY_PHONE_VALUE'],
					'about_place'	=>	$item['PROPERTY_ABOUT_PLACE_VALUE']['TEXT'],
					'place_in_exhibition'	=>	$item['PROPERTY_PLACE_IN_EXHIBITION_VALUE'],
					'logo'			=>	\CFile::GetPath($item['PROPERTY_LOGO_VALUE']),
					'link'			=>	$item['DETAIL_PAGE_URL']
			];
		}
		$this->requestData= $result;
			
	}

	/*
	 *	Получить список фотографий события
	 *	return @photo list
	 */
	private function getEventsPhotosList(){

		$arSelect = [
				"ID",
				"NAME",
				"IBLOCK_ID",
				"DETAIL_PAGE_URL",
				"PROPERTY_LINK_PHOTOGALLERY"
		];
		$arFilter = ["IBLOCK_ID" 	=> $this->iblockId, "ACTIVE" => "Y"];
			

		$res = \CIBlockElement::GetList(Array(), $arFilter, false,["nPageSize"=>$this->limit,'iNumPage'=>$this->page], $arSelect);
		$result=[];
		if ($item = $res->GetNextElement())
		{
			$fields 	=	$item->GetFields();
			$prop 		=	$item->GetProperties();
			$photos 	=	$prop['PHOTO']['VALUE'];
			$count=0;
			foreach($photos as $p){
				$photosPath[]=	\CFile::GetPath($p);
				$count++;
			}


			$photogalleryElementId 	=	$prop['LINK_PHOTOGALLERY']['VALUE'];

			if(!empty($photogalleryElementId)){
				$arSelect = [
						"ID",
						"NAME",
						"IBLOCK_ID",
						"PROPERTY_PHOTOS"
				];

				$arFilter = ["ID"	=> $photogalleryElementId, "ACTIVE" => "Y"];
				$resPhotos = \CIBlockElement::GetList(Array(), $arFilter, false,[] , $arSelect);
				if ($itemPhotos = $resPhotos->GetNextElement()){
					$photosGallerty = $itemPhotos->GetProperties()['PHOTOS']['VALUE'];
					foreach($photosGallerty as $p){
						$photosPath[]	=	\CFile::GetPath($p);
						$count++;
					}
				}
			}


			$photoList=[
					'count'		=>$count,
					'list'=>$photosPath,
			];
			$result[]	=
			[
					'id'		=>	$fields['ID'],
					'name'		=>	$fields['NAME'],
					'link'		=>	$fields['DETAIL_PAGE_URL'],
					'photo'		=>	$photoList,
			];
		}


		$this->requestData=$result;
			
			
	}

	/*
	 *	Получить список организаторов
	 *	return @list
	 */
	private function getOrganizersList(){
		$arSelect = [
				"ID",
				"NAME",
				"PROPERTY_EMAIL",
				"PROPERTY_PHONE",
				"PROPERTY_CONTACT_FOR_ALL",
				"PROPERTY_CONTACT_FOR_PRESS",
				"PROPERTY_CONTACT_FOR_PARTNERS",
				"PROPERTY_COMMENT_CONTACT_FOR_ALL",
				"PROPERTY_COMMENT_CONTACT_FOR_PRESS",
				"PROPERTY_COMMENT_CONTACT_FOR_PARTNERS",
		];
		$arFilter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];
			
		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$this->limit,'iNumPage'=>$this->page), $arSelect);
		$result=[];
		while ($item = $res->GetNext())
		{
			$result[]=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'email'		=>	$item['PROPERTY_EMAIL_VALUE'],
					'phone'		=>	$item['PROPERTY_PHONE_VALUE'],
					'contact_for_all'			=>	$item['PROPERTY_CONTACT_FOR_ALL_VALUE'],
					'comment_contact_for_all'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_ALL_VALUE']['TEXT'],
					'contact_for_press'			=>	$item['PROPERTY_CONTACT_FOR_PRESS_VALUE'],
					'comment_contact_for_press'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_PRESS_VALUE']['TEXT'],
					'contact_for_partners'		=>	$item['PROPERTY_CONTACT_FOR_PARTNERS_VALUE'],
					'comment_contact_for_partners'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_PARTNERS_VALUE']['TEXT'],

			];
		}


		$this->requestData=[
				'count'	=> self::getElementsCount(),
				'result'=> $result
		];

	}

	private function getEventsOrganizersList(){
		$IBLOCK_EVENTS_ID 	=	($this->language==='en')?Setting::IBLOCK_EVENTS_EN_ID:Setting::IBLOCK_EVENTS_RUS_ID;
		$orgSelect=[
				"ID",
				"NAME",
				"PROPERTY_EMAIL",
				"PROPERTY_PHONE",
				"PROPERTY_CONTACT_FOR_ALL",
				"PROPERTY_CONTACT_FOR_PRESS",
				"PROPERTY_CONTACT_FOR_PARTNERS",
				"PROPERTY_COMMENT_CONTACT_FOR_ALL",
				"PROPERTY_COMMENT_CONTACT_FOR_PRESS",
				"PROPERTY_COMMENT_CONTACT_FOR_PARTNERS",
		];
		$orgFilter=[
				"IBLOCK_ID" => $this->iblockId ,
				"ACTIVE" 	=> "Y",
				"ID" 		=> \CIBlockElement::SubQuery("PROPERTY_ORGANIZERS", ["ID"=>$this->rest3, "IBLOCK_ID" => $IBLOCK_EVENTS_ID,"ACTIVE"=>"Y"]),
		];
		$rsOrg = \CIBlockElement::GetList(
				["SORT" => "ASC"],
				$orgFilter,
				false,
				["nPageSize"=>$this->limit,'iNumPage'=>$this->page],
				$orgSelect
				);
		while($item = $rsOrg->Fetch()){
			$result[]=[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'email'		=>	$item['PROPERTY_EMAIL_VALUE'],
					'phone'		=>	$item['PROPERTY_PHONE_VALUE'],
					'contact_for_all'			=>	$item['PROPERTY_CONTACT_FOR_ALL_VALUE'],
					'comment_contact_for_all'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_ALL_VALUE']['TEXT'],
					'contact_for_press'			=>	$item['PROPERTY_CONTACT_FOR_PRESS_VALUE'],
					'comment_contact_for_press'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_PRESS_VALUE']['TEXT'],
					'contact_for_partners'		=>	$item['PROPERTY_CONTACT_FOR_PARTNERS_VALUE'],
					'comment_contact_for_partners'	=>	$item['PROPERTY_COMMENT_CONTACT_FOR_PARTNERS_VALUE']['TEXT'],
			];
		}
		$this->requestData=[
				'count'	=> \CIBlockElement::GetList([], $orgFilter, [], false, []),
				'result'=> $result

		];

	}


	/*
	 *	список заведений Vr зон
	 *	return @list
	 */
	private function getVrZoneList(){

		$arSelect = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_MAP",
				"PROPERTY_FILE"
		];
		$arFilter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$this->limit,'iNumPage'=>$this->page), $arSelect);
		$result=[];
		while ($item = $res->fetch())
		{
			$result[]=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'text'		=>	$item['DETAIL_TEXT'],
					'image' 	=>  \CFile::GetPath($item['PREVIEW_PICTURE']),
					'coordinate'=>	$item['PROPERTY_MAP_VALUE'],
					'file' 		=> 	\CFile::GetPath($item['PROPERTY_FILE_VALUE']),
			];
		}


		$this->requestData=[
				'count'	=> self::getElementsCount(),
				'result'=> $result
		];

	}

	/*
	 *	список мероприятий
	 *	return @list
	 */
	private function getEventsList(){
		$arSelect = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"PROPERTY_DATE_BEGIN",
				"PROPERTY_DATE_END",
		];
		$arFilter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$this->limit,'iNumPage'=>$this->page), $arSelect);
		$result=[];
		while ($item = $res->fetch())
		{
			$result[]=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'image' 	=>  \CFile::GetPath($item['PREVIEW_PICTURE']),
					'date_begin'=>	$item['PROPERTY_DATE_BEGIN_VALUE'],
					'date_end' 	=> 	$item['PROPERTY_DATE_END_VALUE']
			];
		}

			
		$this->requestData=[
				'count'	=> self::getElementsCount(),
				'result'=> $result
		];

	}


	/*
	 *	Инормация оероприятии
	 *	return @list
	 */
	private function getEventsDetail(){

		$IBLOCK_FORUM_PROGRAM_ID 	=	($this->language==='en')?Setting::IBLOCK_FORUM_PROGRAM_EN_ID:Setting::IBLOCK_FORUM_PROGRAM_RUS_ID;
		$IBLOCK_LOCATIONS_ID 		=	($this->language==='en')?Setting::IBLOCK_LOCATIONS_EN_ID:Setting::IBLOCK_LOCATIONS_RUS_ID;
		$IBLOCK_SPEAKERS_ID 		=	($this->language==='en')?Setting::IBLOCK_SPEAKERS_EN_ID:Setting::IBLOCK_SPEAKERS_RUS_ID;


		$arSelect = [
				'ID',
				"NAME",
				"DETAIL_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_HREF_INFO",
				"PROPERTY_MAP",
				"PROPERTY_ADDRESS",
				"PROPERTY_PRICE",
				"DETAIL_PAGE_URL",
				"PROPERTY_FORUM_PROGRAM",
				"PROPERTY_PRICE",
				"PROPERTY_LINK_PHOTOGALLERY"
		];

		$arFilter	= 	[
				"ID"    	=> $this->rest3,
				"IBLOCK_ID" => $this->iblockId,
				"ACTIVE" 	=> "Y",
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1),$arSelect);
		$result=[];
		if($item = $res->GetNext())
		{
			// получить список фотогалерей
			if(!empty($item["PROPERTY_LINK_PHOTOGALLERY_VALUE"])){
				$photoSelect = ["PROPERTY_PHOTOS",];
				$photoFilter = [
						'ID' =>$item["PROPERTY_LINK_PHOTOGALLERY_VALUE"],
				];
				$photoSect = \CIBlockElement::GetList([],$photoFilter,false,false, $photoSelect);
				$photoCount=0;
				while ($photoItem = $photoSect->Fetch())
				{
					$photosList[]=\CFile::GetPath($photoItem['PROPERTY_PHOTOS_VALUE']);
					$photoCount++;
				}
				$photos=[
						'count'	=>	$photoCount,
						'photosList'=> $photosList
				];

			}


			$forums=[];

			// Получить список форумов
			if(!empty($item['PROPERTY_FORUM_PROGRAM_VALUE'])){
				$sectionId=$item['PROPERTY_FORUM_PROGRAM_VALUE'];
				$arSelect = [
						"ID",
						"NAME",
						"PROPERTY_LOCATION",
						"PROPERTY_DATE_TIME_END",
						"PROPERTY_DATE_TIME_BEGIN",
						"PROPERTY_SPEAKERS"
				];
				$arFilter = [
						'IBLOCK_ID' => $IBLOCK_FORUM_PROGRAM_ID,
						'ACTIVE' 	=> "Y",
						'SECTION_ID'=> $sectionId
				];

				$rsSect = \CIBlockElement::GetList([],$arFilter,false,false, $arSelect);
				$forumsCount=0;
				while ($arSect = $rsSect->GetNext())
				{
					$forums[$arSect["ID"]]	=
					[
							'id'		=> $arSect["ID"],
							"name"		=> $arSect["NAME"],
							"date_begin"=> $arSect["PROPERTY_DATE_TIME_BEGIN_VALUE"],
							"date_end"	=> $arSect["PROPERTY_DATE_TIME_END_VALUE"],
							'location' 	=> $arSect["PROPERTY_LOCATION_VALUE"],
							'speakers'	=> $arSect["PROPERTY_SPEAKERS_VALUE"],
					];
					$locations[$arSect["ID"]]	=	$arSect["PROPERTY_LOCATION_VALUE"];
					$speakers[$arSect["ID"]]	=	$arSect["PROPERTY_SPEAKERS_VALUE"];
					$forumsCount++;
				}

				// Получить координаты
				$arLocationSelect=[
						"ID",
						"NAME",
						"PROPERTY_MAP"
				];
				$arLocationFilter=[
						'IBLOCK_ID' => $IBLOCK_LOCATIONS_ID,
						'ACTIVE' 	=> "Y",
						'ID'		=> $locations
				];
					
				$rsLocSect = \CIBlockElement::GetList([],$arLocationFilter,false,false, $arLocationSelect);
				while ($arLocSect = $rsLocSect->GetNext())
				{
					$locationsData[$arLocSect["ID"]]=	[
							'id'		=> $arLocSect["ID"],
							"name"		=> $arLocSect["NAME"],
							"coordinates"=> $arLocSect["PROPERTY_MAP_VALUE"],
					];
				}

				// Получить спикеров
				$arSpeakerSelect=[
						"ID",
						"NAME",
						"PREVIEW_PICTURE",
						"PROPERTY_POSITION"
				];
				$arSpeakerFilter=[
						'IBLOCK_ID' => $IBLOCK_SPEAKERS_ID,
						'ACTIVE' 	=> "Y",
						'ID'		=> $speakers
				];
					
				$rsSpeakSect = \CIBlockElement::GetList([],$arSpeakerFilter,false,false, $arSpeakerSelect);
				while ($arSpeakSect = $rsSpeakSect->GetNext())
				{
					$speakersData[$arSpeakSect["ID"]]=	[
							'id'		=> $arSpeakSect["ID"],
							"name"		=> $arSpeakSect["NAME"],
							"position"	=> $arSpeakSect["PROPERTY_POSITION_VALUE"],
							"photo"		=> \CFile::GetPath($arSpeakSect["PREVIEW_PICTURE"]),
							
					];
				}

				foreach($forums as $key=>$f){
					$allForums[$key]=	$f;
					$allForums[$key]['location']	=	$locationsData[$f['location']];
					foreach ($f['speakers'] as $key1=>$sp){
						$allForums[$key]['speakers'][$key1]=$speakersData[$sp];
					}
				}

			}
			$result=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'image'		=>  \CFile::GetPath($item['DETAIL_PICTURE']),
					'text' 		=> 	$item['DETAIL_TEXT'],
					'coordinates'	=> $item['PROPERTY_MAP_VALUE'],
					'link'		=> 	$item['DETAIL_PAGE_URL'],
					'price'		=>	$item["PROPERTY_PRICE_VALUE"],
					'photo_gallery'	=>	$photos,
					'forum_program'	=> [
							'count'		=>	$forumsCount,
							'result'	=>	$allForums
					],

			];
		}
		$this->requestData=$result;

	}

	/*
	 *	список заведений кафе и ресторанов на территории Казань Экспо
	 *	return @list
	 */
	private function getWhereToGoList(){
		$arSelect = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_MAP",
				"PROPERTY_CATEGORY",
				"PROPERTY_DATE_BEGIN",
				"PROPERTY_DATE_END"
		];
		$arFilter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$this->limit,'iNumPage'=>$this->page), $arSelect);
		$result=[];
		while ($item = $res->fetch())
		{
			$result[]=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'image' 	=>  \CFile::GetPath($item['PREVIEW_PICTURE']),
					'text' 		=> 	TruncateText(strip_tags($item['DETAIL_TEXT']),200),
					'coordinate'=>	$item['PROPERTY_MAP_VALUE'],
					'category' 	=>  $item['PROPERTY_CATEGORY_VALUE'],
					'date_begin'=>	$item['PROPERTY_DATE_BEGIN_VALUE'],
					'date_end' 	=> 	$item['PROPERTY_DATE_END_VALUE']
			];
		}

			
		$this->requestData=[
				'count'	=> self::getElementsCount(),
				'result'=> $result
		];

	}

	/*
	 *	информация по заведения кафе
	 *	return @detail
	 */
	private function getWhereToGoDetail(){

		$arSelect = [
				'ID',
				"NAME",
				"DETAIL_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_CATEGORY",
				"PROPERTY_HREF_INFO",
				"PROPERTY_MAP",
				"PROPERTY_TIME",
				"PROPERTY_PHONE",
				"PROPERTY_ADDRESS",
				"PROPERTY_PRICE",
		];

		$arFilter	= 	[
				"ID"    	=> $this->rest3,
				"IBLOCK_ID" => $this->iblockId,
				"ACTIVE" 	=> "Y",
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1), $arSelect);
		$result=[];
		if($item = $res->fetch())
		{
			$result=[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'image'		=>  \CFile::GetPath($item['DETAIL_PICTURE']),
					'text' 		=> 	$item['DETAIL_TEXT'],
					'coordinates'=> $item['PROPERTY_MAP_VALUE'],
					'category'	=> 	$item['PROPERTY_CATEGORY_VALUE'],
					'link'		=> 	$item['PROPERTY_HREF_INFO_VALUE'],
					'work_time'	=>	$item["PROPERTY_TIME_VALUE"],
					'phone'		=>	$item["PROPERTY_PHONE_VALUE"],
					'address'	=>	$item["PROPERTY_ADDRESS_VALUE"],
					'price'		=>	$item["PROPERTY_PRICE_VALUE"],
			];
				
		}
		$this->requestData=$result;

	}

	/*
	 *	список заведений кафе и ресторанов на территории Казань Экспо
	 *	return @list
	 */
	private function getInstitutionsList(){

		$select = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_TEXT"
		];
		$filter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];
		$rsElements = \Bitrix\Iblock\ElementTable::getList(
				[
						'order' 	=> 	['SORT' => 'ASC'],
						'select' 	=> 	$select,
						'filter' 	=> 	$filter,
						'limit' 	=> 	$this->limit,
						'offset'	=> 	($this->page-1)*$this->limit
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

		if($result){
			$this->requestData=[
					'count'	=> self::getElementsCount(),
					'result'=> $result
			];
		}
	}

	/*
	 *	информация по заведения кафе
	 *	return @detail
	 */
	private function getInstitutionsDetail(){
		$IBLOCK_LOCATIONS_ID 		=	($this->language==='en')?Setting::IBLOCK_LOCATIONS_EN_ID:Setting::IBLOCK_LOCATIONS_RUS_ID;
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
				"ID"    	=> $this->rest3,
				"IBLOCK_ID" => $this->iblockId,
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

		$this->requestData=$result;
	}



	private function getList(){

		$select = [
				"ID",
				"NAME",
				"PREVIEW_PICTURE",
				"DETAIL_TEXT"
		];
		$filter = [
				"IBLOCK_ID" 	=> $this->iblockId,
				"ACTIVE" 		=> "Y"
		];
		if($this->page<1){
			self::response(400);
			return;
		}

		$rsElements = \Bitrix\Iblock\ElementTable::getList(
				[
						'order' 	=> 	['SORT' => 'ASC'],
						'select' 	=> 	$select,
						'filter' 	=> 	$filter,
						'limit' 	=> 	$this->limit,
						'offset'	=> 	($this->page-1)*$this->limit
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

		if($result){
			$this->requestData=[
					'count'	=> self::getElementsCount(),
					'result'=> $result
			];
		}
	}

	/*
	 *	Получить детальный элемент
	 *	return @detail
	 */
	private function getDetail(){


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
								"ID"    	=> $this->rest3,
								"IBLOCK_ID" => $this->iblockId,
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
		$this->requestData=$result;
	}

	private function getEventsLectionsList(){

		if(empty($this->rest3)) return;

		$IBLOCK_FORUM_PROGRAM_ID 	=	($this->language==='en')?Setting::IBLOCK_FORUM_PROGRAM_EN_ID:Setting::IBLOCK_FORUM_PROGRAM_RUS_ID;
		$IBLOCK_LOCATIONS_ID 		=	($this->language==='en')?Setting::IBLOCK_LOCATIONS_EN_ID:Setting::IBLOCK_LOCATIONS_RUS_ID;
		$IBLOCK_SPEAKERS_ID 		=	($this->language==='en')?Setting::IBLOCK_SPEAKERS_EN_ID:Setting::IBLOCK_SPEAKERS_RUS_ID;
		$IBLOCK_REPORTS_ID 			=	($this->language==='en')?Setting::IBLOCK_REPORTS_EN_ID:Setting::IBLOCK_REPORTS_RUS_ID;
		$IBLOCK_MODERATORS_ID 			=	($this->language==='en')?Setting::IBLOCK_MODERATORS_EN_ID:Setting::IBLOCK_MODERATORS_RUS_ID;


		$arSelect = [
				'ID',
				"NAME",
				"DETAIL_PICTURE",
				"DETAIL_TEXT",
				"PROPERTY_HREF_INFO",
				"PROPERTY_MAP",
				"PROPERTY_ADDRESS",
				"PROPERTY_PRICE",
				"DETAIL_PAGE_URL",
				"PROPERTY_FORUM_PROGRAM",
				"PROPERTY_PARTICIPANTS_MANAGER_PHOTO",

		];

		$arFilter	= 	[
				"ID"    	=> $this->rest3,
				"IBLOCK_ID" => $this->iblockId,
				"ACTIVE" 	=> "Y",
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>1),$arSelect);
		$result=[];
		if($item = $res->GetNext())
		{
			$forums=[];

			// Получить список форумов
			if(!empty($item['PROPERTY_FORUM_PROGRAM_VALUE'])){
				$sectionId=$item['PROPERTY_FORUM_PROGRAM_VALUE'];
				$arSelect = [
						"ID",
						"NAME",
						"PROPERTY_LOCATION",
						"PROPERTY_DATE_TIME_END",
						"PROPERTY_DATE_TIME_BEGIN",
						"PROPERTY_SPEAKERS",
						"PROPERTY_REPORTS",
						"PROPERTY_MODERATORS",
						

				];
				$arFilter = [
						'IBLOCK_ID' => $IBLOCK_FORUM_PROGRAM_ID,
						'ACTIVE' 	=> "Y",
						'SECTION_ID'=> $sectionId
				];

				$rsSect = \CIBlockElement::GetList([],$arFilter,false,false, $arSelect);
				$forumsCount=0;
				while ($arSect = $rsSect->GetNext())
				{
					$forums[$arSect["ID"]]	=
					[
							'id'		=> $arSect["ID"],
							"name"		=> $arSect["NAME"],
							"date_begin"=> $arSect["PROPERTY_DATE_TIME_BEGIN_VALUE"],
							"date_end"	=> $arSect["PROPERTY_DATE_TIME_END_VALUE"],
							'location' 	=> $arSect["PROPERTY_LOCATION_VALUE"],
							'reports'	=> $arSect["PROPERTY_REPORTS_VALUE"],
							'moderators'=> $arSect["PROPERTY_MODERATORS_VALUE"],
					];
					$locations[$arSect["ID"]]	=	$arSect["PROPERTY_LOCATION_VALUE"];
					$reports[$arSect["ID"]]		=	$arSect["PROPERTY_REPORTS_VALUE"];
					$moderators[$arSect["ID"]]		=	$arSect["PROPERTY_MODERATORS_VALUE"];
					
					
					$forumsCount++;
				}
				// Получить координаты
				$arLocationSelect=[
						"ID",
						"NAME",
						"PROPERTY_MAP"
				];
				$arLocationFilter=[
						'IBLOCK_ID' => $IBLOCK_LOCATIONS_ID,
						'ACTIVE' 	=> "Y",
						'ID'		=> $locations
				];
					
				$rsLocSect = \CIBlockElement::GetList([],$arLocationFilter,false,false, $arLocationSelect);
				while ($arLocSect = $rsLocSect->GetNext())
				{
					$locationsData[$arLocSect["ID"]]=	[
							'id'		=> $arLocSect["ID"],
							"name"		=> $arLocSect["NAME"],
							"coordinates"=> $arLocSect["PROPERTY_MAP_VALUE"],
					];
				}

				
				
				// Получить модераторов
				$arModerSelect=[
						"ID",
						"NAME",
						"PROPERTY_POSITION",
						"PREVIEW_PICTURE"
				];
				$arModerFilter=[
						'IBLOCK_ID' => $IBLOCK_MODERATORS_ID,
						'ACTIVE' 	=> "Y",
 						'ID'		=> $moderators
				];
					
				$rsModerSect = \CIBlockElement::GetList([],$arModerFilter,false,false, $arModerSelect);
				while ($arModerSect = $rsModerSect->GetNext())
				{
					$moderData[$arModerSect["ID"]]=	[
						'id'		=> $arModerSect["ID"],
						"name"		=> $arModerSect["NAME"],
						"position"	=> $arModerSect["PROPERTY_POSITION_VALUE"],
						"photo"		=> \CFile::GetPath($arModerSect["PREVIEW_PICTURE"]),
				
					];
				}
				// Получить доклады
				$arReportsSelect=[
						"ID",
						"NAME",
						"PROPERTY_FILE",
						"PROPERTY_SPEAKER",
				];
				$arReportsFilter=[
						'IBLOCK_ID' => $IBLOCK_REPORTS_ID,
						'ACTIVE' 	=> "Y",
						'ID'		=> $reports
				];					
				$rsReportsSect = \CIBlockElement::GetList([],$arReportsFilter,false,false, $arReportsSelect);
				while ($arReportsSect = $rsReportsSect->GetNext())
				{
					$reportsData[$arReportsSect["ID"]]=	[
						'id'		=> $arReportsSect["ID"],
						"name"		=> $arReportsSect["NAME"],
						"file"		=> \CFile::GetPath($arReportsSect["PROPERTY_FILE_VALUE"]),
						"speaker"	=> $arReportsSect["PROPERTY_SPEAKER_VALUE"],
					];
					$speakers[$arSect["ID"]]	=	$arReportsSect["PROPERTY_SPEAKERS_VALUE"];
				}

				// Получить спикеров
				$arSpeakerSelect=[
						"ID",
						"NAME",
						"PROPERTY_POSITION",
						"PREVIEW_PICTURE"
				];
				$arSpeakerFilter=[
						'IBLOCK_ID' => $IBLOCK_SPEAKERS_ID,
						'ACTIVE' 	=> "Y",
						'ID'		=> $speakers
				];
					
				$rsSpeakSect = \CIBlockElement::GetList([],$arSpeakerFilter,false,false, $arSpeakerSelect);
				while ($arSpeakSect = $rsSpeakSect->GetNext())
				{
					$speakersData[$arSpeakSect["ID"]]=	[
							'id'		=> $arSpeakSect["ID"],
							"name"		=> $arSpeakSect["NAME"],
							"position"	=> $arSpeakSect["PROPERTY_POSITION_VALUE"],		
							"photo"		=> \CFile::GetPath($arSpeakSect["PREVIEW_PICTURE"]),
					];
				}

				foreach($forums as $key=>$f){
					$allForums[$key]=	$f;
					$allForums[$key]['location']	=	$locationsData[$f['location']];				
					foreach ($f['reports'] as $key2=>$rp){
						$reportsData[$rp]['speaker']		=	$speakersData[$reportsData[$rp]['speaker']];
						$allForums[$key]['reports'][$key2]	=	$reportsData[$rp];
					}
					foreach ($f['moderators'] as $key3=>$md){
						$allForums[$key]['moderators'][$key3]=$moderData[$md];
					}
				}

			}
			$result=
			[
					'id'		=>	$item['ID'],
					'name'		=>	$item['NAME'],
					'image'		=>  \CFile::GetPath($item['DETAIL_PICTURE']),
					'text' 		=> 	$item['DETAIL_TEXT'],
					'coordinates'	=> $item['PROPERTY_MAP_VALUE'],
					'link'		=> 	$item['DETAIL_PAGE_URL'],
					'manager_photo'	=> \CFile::GetPath($item['PROPERTY_PARTICIPANTS_MANAGER_PHOTO_VALUE']),
					'forum_program'	=> [
							'count'		=>	$forumsCount,
							'result'	=>	$allForums
					],

			];
				
				
		}
		$this->requestData=$result;
	}

	private function getAboutDetail(){
		$result=[
			"introductory_text"	=> file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_text_1.php', true),
			"youtube_link" 		=> file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_youtube_link.php', true),
			"mission_mvc"		=> file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_mission_mvc.php', true),
			"goals_and_objectives"		=> file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_goals_and_objectives.php', true),
			"introducton"=>[
				"photo"		=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_photo.php', true),
				"text"		=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_speech.php', true),
				"fio"		=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_name.php', true),
				"position"	=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/about-us/sect_position.php', true),
			]
		];
		$this->requestData=$result;	
	}

	private function getContactsList(){
		$result['text']=	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/contacts/sect_text.php', true);
		$result['spravochnaya-slujba']=[
					"phone"	=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/contacts/sect_phone.php', true),
					"mail"	=>	file_get_contents($_SERVER['DOCUMENT_ROOT'].'/contacts/sect_email.php', true),
				];


		$arSelect = [
				 'ID',
				 "NAME",
				 "IBLOCK_ID",	
				 "IBLOCK_SECTION_ID",
				 "PROPERTY_EMAIL",
				 "PROPERTY_PHONE"				
		];

		$arFilter	= 	[				
				"IBLOCK_ID" => $this->iblockId,
				"ACTIVE" 	=> "Y",
		];

		$res = \CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);		
		$sections=[];
		while ($item = $res->GetNext())
		{
			
			$items[$item['IBLOCK_SECTION_ID']][]= [
					'id'	=>	$item['ID'],
					'name'	=>	$item['NAME'],
					'email' => $item['PROPERTY_EMAIL_VALUE'],
					'phone' => $item['PROPERTY_PHONE_VALUE'],
			];
			$sections[]=$item['IBLOCK_SECTION_ID'];
				
		}	
		$arSectionFilter = ["ID"=>$section, "IBLOCK_ID" => $this->iblockId, 'GLOBAL_ACTIVE'=>'Y'];
		$arSectionSelect = ["ID","NAME","CODE"];
		$db_list = \CIBlockSection::GetList([], $arSectionFilter, true,$arSectionSelect);
		while($ar_result = $db_list->GetNext())
		{		   
		   $sectionCodes[$ar_result['ID']]=$ar_result['CODE'];
		}
		
		
		foreach($sectionCodes as $key=>$sect){
			foreach($items[$key] as $itm){
				$result[$sectionCodes[$key]][]=$itm;
			}
		}
		


		$this->requestData=$result;		
	}
	/*
	 *	Возвращает название необходимого метода для GET запроса
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
						'useCache'	=>	"Y",
				],
				'institutions'=>[
						'method'	=>	[
								'list'	=>'getInstitutionsList',
								'detail'=>'getInstitutionsDetail',
						],
						'iblockId'	=>	[
								'ru' => Setting::IBLOCK_INSTITUTIONS_RUS_ID,
								'en' =>	Setting::IBLOCK_INSTITUTIONS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'wheretogo'=>[
						'method'	=>	[
								'list'	=>'getWhereToGoList',
								'detail'=>'getWhereToGoDetail',
						],
						'iblockId'	=>	[
								'ru' => Setting::IBLOCK_WHERE_TO_GO_RUS_ID,
								'en' =>	Setting::IBLOCK_WHERE_TO_GO_EN_ID
						],
						'useCache'	=>	"N",
				],
				'vrzone'=>[
						'method'	=>	[
								'list'	=>'getVrZoneList',
						],
						'iblockId'	=>	[
								'ru' => Setting::IBLOCK_VR_ZONE_LIST_RUS_ID,
								'en' =>	Setting::IBLOCK_VR_ZONE_LIST_EN_ID
						],
						'useCache'	=>	"N",
				],
				'exponents'=>[
						'method'	=>	[
								'detail' =>'getExponenetsDetail',
						],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_EXPONENETS_RUS_ID,
								'en'  => Setting::IBLOCK_EXPONENETS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'organizers'=>[
						'method'	=>	[
								'list' =>'getOrganizersList',
						],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_EVENTS_RUS_ID,
								'en'  => Setting::IBLOCK_EVENTS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'events'=>[
						'method'	=>	[
								'list'	=>'getEventsList',
								'detail'=>'getEventsDetail',
						],
						'iblockId'	=>	[
								'ru' => Setting::IBLOCK_EVENTS_RUS_ID,
								'en' =>	Setting::IBLOCK_EVENTS_EN_ID
						],
						'useCache'	=>	"Y",
				],
					
				'events_organizers'=>[
						'method'	=>	[
								'list'	=>'getEventsOrganizersList',
						],
						'iblockId'	=>	[
								'ru' => Setting::IBLOCK_ORGANIZERS_RUS_ID,
								'en' =>	Setting::IBLOCK_ORGANIZERS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'events_photos'=>[
						'method'	=>	[
								'list' =>'getEventsPhotosList',
						],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_EVENTS_RUS_ID,
								'en'  => Setting::IBLOCK_EVENTS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'events_exponents'=>[
						'method'	=>	[
								'list'	 =>'getEventsExponenetsList',
						],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_EXPONENETS_RUS_ID,
								'en'  => Setting::IBLOCK_EXPONENETS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'events_lections'=>[
								'method'	=>	[
											'list'	 =>'getEventsLectionsList',
									],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_EVENTS_RUS_ID,
								'en'  => Setting::IBLOCK_EVENTS_EN_ID
						],
						'useCache'	=>	"N",
				],
				'about'=>[
								'method'	=>	[
										'detail' =>'getAboutDetail',
								],
						// 'iblockId'	=>	[
						// 		'ru'  => Setting::IBLOCK_ABOUT_RUS_ID,
						// 		'en'  => Setting::IBLOCK_ABOUT_EN_ID
						// ],
						'useCache'	=>	"N",
				],
				'contacts'=>[
							'method'	=>	[
								'list' =>'getContactsList',
							],
						'iblockId'	=>	[
								'ru'  => Setting::IBLOCK_CONTACTS_RUS_ID,
								'en'  => Setting::IBLOCK_CONTACTS_EN_ID
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
		$this->currentFunction=$rest[$this->rest1]['method'][$this->rest2];
		if(empty($this->currentFunction)){
			self::response(400);
			return false;
		}
		return $this->currentFunction;

	}

	public function getCacheData(){
		$cache = \Bitrix\Main\Data\Cache::createInstance();
		if ($cache->initCache($this->cacheTime, $this->cacheCode, $this->cachePath))
		{
			$this->requestData=$cache->getVars();
		}
		elseif($cache->startDataCache())
		{
			self::{$this->currentFunction}();
			$cache->endDataCache($this->requestData);
			return $result;
		}
	}

}
