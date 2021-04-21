<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
global $APPLICATION;
Loc::loadMessages(__FILE__);
Loader::includeModule('bitlate.apparelshop');?>
<?$APPLICATION->IncludeFile(
    SITE_DIR . "include/product_slider.php",
    Array(
        "TITLE" => Loc::GetMessage("MSG_PRODUCTS_TITLE"),
        "FILTER" => array("PROPERTY_MANUFACTURE" => $arResult['ID']),
        "SUB_SLIDER" => "Y",
    )
);?>
<?$arFile = array();
if (intval($arResult["DETAIL_PICTURE"]['ID']))
    $arFile = $arResult["DETAIL_PICTURE"];
elseif (intval($arResult["PREVIEW_PICTURE"]['ID']))
    $arFile = $arResult["PREVIEW_PICTURE"];
NLApparelshopUtils::getPreviewPage($arFile);?>