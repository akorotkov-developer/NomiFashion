<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

CModule::IncludeModule('bitlate.apparelshop');
$_POST = NLApparelshopUtils::prepareRequest($_POST);
$_REQUEST = NLApparelshopUtils::prepareRequest($_REQUEST);
$APPLICATION->IncludeFile(
	SITE_DIR . "include/popup/subscribe_small.php"
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?> 