<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

// Получим мапинг для свойства цвет, для вставки картинок в фильтр
// Получим IblockId по коду инфоблока
$dbResult = \CIBlock::GetList(
    [],
    Array(
        'TYPE' => 'references',
        'SITE_ID' => SITE_ID,
        'ACTIVE' => 'Y',
        'CODE' => 'NL_MANUFACTURE_s1'
    ),
    true
);
if ($arRes = $dbResult->Fetch()) {
    $iIblockId = $arRes['ID'];
}

$arSelect = ['ID', 'NAME', 'PREVIEW_PICTURE'];
$arFilter = ['IBLOCK_ID' => $iIblockId, 'ACTIVE' => 'Y'];
$dbResult = CIBlockElement::GetList(
    [],
    $arFilter,
    false,
    false,
    $arSelect
);

$arProps = [];
while($arRes = $dbResult->Fetch())
{
    $arFile = \CFile::GetFileArray($arRes['PREVIEW_PICTURE']);

    $sFileSrc = '';
    if ($arRes['PREVIEW_PICTURE'] != '') {
        $sFileSrc = \CFile::GetFileArray($arRes['PREVIEW_PICTURE'])['SRC'];
    }

    $arProps[$arRes['ID']] = $sFileSrc;
}

$arResult['PROP_COLOR'] = $arProps;