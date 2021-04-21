<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
Loader::includeModule('bitlate.apparelshop');
if (count($arResult) > 0) {
    NLApparelshopUtils::setLeftMenu();
}
?>