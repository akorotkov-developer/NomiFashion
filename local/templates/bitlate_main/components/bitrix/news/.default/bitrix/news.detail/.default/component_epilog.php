<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
Loader::includeModule('bitlate.apparelshop');
$arFile = array();
if (intval($arResult["DETAIL_PICTURE"]['ID']))
    $arFile = $arResult["DETAIL_PICTURE"];
elseif (intval($arResult["PREVIEW_PICTURE"]['ID']))
    $arFile = $arResult["PREVIEW_PICTURE"];
NLApparelshopUtils::getPreviewPage($arFile);?>