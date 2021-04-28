<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->IncludeComponent(
	"bitrix:sale.personal.order.cancel",
	"",
	array(
		"PATH_TO_LIST" => "/personal/",
		"PATH_TO_DETAIL" => "/personal/order/#ID#/",
		"SET_TITLE" => "N",
		"ID" => (isset($_REQUEST['ID']) && $_REQUEST['ID'] > 0) ? $_REQUEST['ID'] : '',
	),
	false
);

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
?>