<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

$routs = new Routs();

$routs->addGet('/restapi/services/list','getList');
$routs->addGet('/restapi/services/detail/+','getDetail');
$routs->addGet('/restapi/institutions/list','getInstitutionsList');
$routs->addGet('/restapi/institutions/detail/+','getInstitutionsDetail');


new \AV\RestApi($routs);
