<?
define('PRODUCT_DEFAULT_RATING', 3);
define("BX_PULL_SKIP_INIT", true);

AddEventHandler("iblock", "OnBeforeIBlockElementUpdate",["IblockEvents", "OnBeforeIBlockElementUpdateHandler"]);
AddEventHandler("iblock", "OnBeforeIBlockSectionUpdate",["IblockEvents", "OnBeforeIBlockSectionUpdateHandler"]);
AddEventHandler("iblock", "OnAfterIBlockElementAdd", ["IblockEvents", "OnAfterIBlockElementAddHandler"]);
AddEventHandler("iblock", "OnBeforeIBlockSectionAdd", ["IblockEvents", "OnBeforeIBlockSectionAddHandler"]);
AddEventHandler("iblock", "OnBeforeIBlockSectionDelete", ["IblockEvents", "OnBeforeIBlockSectionDeleteHandler"]);
AddEventHandler("iblock", "OnBeforeIBlockElementDelete", ["IblockEvents", "OnBeforeIBlockElementDeleteHandler"]);

class IblockEvents
{
    const NA_SAYT_VYGRUZHAT_PROP_ID = 157;
    const NA_SAYT_VYGRUZHAT_PROP_VALUE = 699;

    public function OnBeforeIBlockElementUpdateHandler(&$arFields)
    {
        if ($_REQUEST['mode'] == 'import') {
            //Деактивировать товары, у которых отмечено свойство на сайт не выгружать
            if (current($arFields['PROPERTY_VALUES'][self::NA_SAYT_VYGRUZHAT_PROP_ID])['VALUE'] == self::NA_SAYT_VYGRUZHAT_PROP_VALUE) {
                $arFields['ACTIVE'] = 'N';
            }

            unset($arFields['CODE']);
            unset($arFields['PREVIEW_PICTURE']);
            unset($arFields['DETAIL_PICTURE']);
            unset($arFields['DETAIL_TEXT']);
            unset($arFields['PREVIEW_TEXT']);
            unset($arFields['NAME']);

            $arFields['DETAIL_TEXT_TYPE'] = 'html';
        }
    }

    function OnAfterIBlockElementAddHandler(&$arFields)
    {
        if ($_REQUEST['mode'] == 'import') {
            //Не выгружать на сайт товары, у которых отмечено свойство на сайт не выгружать
            if (current($arFields['PROPERTY_VALUES'][self::NA_SAYT_VYGRUZHAT_PROP_ID])['VALUE'] == self::NA_SAYT_VYGRUZHAT_PROP_VALUE) {
                unset($arFields);
            }
        }
    }

    public function OnBeforeIBlockSectionUpdateHandler(&$arFields)
    {
        if ($_REQUEST['mode'] == 'import') {
            unset($arFields['CODE']);
            unset($arFields['PREVIEW_TEXT']);
            unset($arFields['DETAIL_TEXT']);
            $arFields['ACTIVE'] = 'Y';
        }
    }

    function OnBeforeIBlockSectionAddHandler(&$arFields)
    {
        if ($_REQUEST['mode'] == 'import') {
            unset($arFields['CODE']);
        }
    }

    function OnBeforeIBlockSectionDeleteHandler($Id)
    {
        if ($_REQUEST['mode'] == 'import') {
            return false;
        }
    }

    function OnBeforeIBlockElementDeleteHandler($ID)
    {
        if ($_REQUEST['mode'] == 'import') {
            return false;
        }
    }
}