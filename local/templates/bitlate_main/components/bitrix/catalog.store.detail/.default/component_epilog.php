<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
Loader::includeModule('bitlate.apparelshop');
$APPLICATION->AddChainItem($arResult["NAV_NAME"]);
$arFile = array();
if (intval($arResult["IMAGE_ID"]))
    $arFile = array('ID' => $arResult["IMAGE_ID"]);
NLApparelshopUtils::getPreviewPage($arFile);
?>