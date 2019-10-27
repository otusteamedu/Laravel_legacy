<?
namespace Rest;
require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");

Routs::get('/restapi/services/list','getList');
Routs::get('/restapi/services/detail/+','getDetail');
Routs::get('/restapi/institutions/list','getInstitutionsList');
Routs::get('/restapi/institutions/detail/+','getInstitutionsDetail');

new \AV\RestApi();
