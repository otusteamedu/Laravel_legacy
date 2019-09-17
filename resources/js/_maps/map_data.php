<?
use Sigma\Provider;
use Sigma\Config;
use Sigma\Location;

define("NO_KEEP_STATISTIC", "Y");
define("NO_AGENT_STATISTIC","Y");
define("NOT_CHECK_PERMISSIONS", true);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
include($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/calculator/include.php");

$locationProvider = Provider::getProvider(
	'location', 
	new Config(['iblock_id' => 9])
);
$pointProvider = Provider::getProvider(
	'point', 
	new Config(['iblock_id' => 10])
);

$arData = array();
$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
	
if($cmd == 'list') 
{
	$points = $pointProvider->getList();
	foreach($points as $point)
	{
		$arData[] = array(
			"ID" => $point->getId(),
			"NAME" => $point->getName(),
			"POINT" => $point->getGeo()
		);
	}
}

if($cmd == 'item') 
{
	$point = $pointProvider->getObject($id);
	$location_id = $point->getRegionId();
	$region = '';
	$region_id = 0;
	$district = '';
	$district_id = 0;
	
	$location = $locationProvider->getObject($location_id); 
	if($location && 
		($location->getType() == Location::TYPE_DISTRICT)) {
		$district = $location->getName();
		$district_id = $location->getId();
		if($location = $location->getParent()) {
			$region = $location->getName();
			$region_id = $location->getId();
		}	
	}
	else {
		$region = $location->getName();
		$region_id = $location->getId();
	}

	$arData = array(
		'id' => $point->getId(),
		'name' => html_entity_decode($point->getName()),
		'text' => $point->getText(),
		'picture' => $point->getImage(),
		'region' => $region,
		'regionId' => $region_id,
		'district' => $district,
		'districtId' => $district_id,
		'pointId' => $point->getId()
	);
}

header("Content-type: application/json");
echo json_encode($arData);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>