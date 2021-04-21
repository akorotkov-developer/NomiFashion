<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $templateData */
/** @var @global CMain $APPLICATION */
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
global $APPLICATION;
Loc::loadMessages(__FILE__);
Loader::includeModule('bitlate.apparelshop');?>
<?if ($arResult['ACTION_PRODUCTS_VALUE']):?>
    <?$APPLICATION->IncludeFile(
        SITE_DIR . "include/product_slider.php",
        Array(
            "TITLE" => Loc::GetMessage("MSG_ACTION_PRODUCTS_TITLE"),
            "FILTER" => array('ID' => $arResult['ACTION_PRODUCTS_VALUE']),
            "SUB_SLIDER" => "Y",
        )
    );?>
<?endif;?>
<?$arFile = array();
if (intval($arResult["DETAIL_PICTURE"]['ID']))
    $arFile = $arResult["DETAIL_PICTURE"];
elseif (intval($arResult["PREVIEW_PICTURE"]['ID']))
    $arFile = $arResult["PREVIEW_PICTURE"];
NLApparelshopUtils::getPreviewPage($arFile);?>