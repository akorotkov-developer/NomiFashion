<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule('bitlate.apparelshop');
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
$templateLibrary = array('popup');
$currencyList = '';
if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}
$templateData = array(
	'TEMPLATE_THEME' => $this->GetFolder().'/themes/'.$arParams['TEMPLATE_THEME'].'/style.css',
	'TEMPLATE_CLASS' => 'bx_'.$arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList
);
unset($currencyList, $templateLibrary);

$strMainID = $this->GetEditAreaId($arResult['ID']);
$arItemIDs = array(
	'ID' => $strMainID,
	'PICT' => $strMainID.'_pict',
	'PICT_SUB' => $strMainID.'_pict_sub',
	'DISCOUNT_PICT_ID' => $strMainID.'_dsc_pict',
	'STICKER_ID' => $strMainID.'_sticker',
	'BIG_SLIDER_ID' => $strMainID.'_big_slider',
	'BIG_IMG_CONT_ID' => $strMainID.'_bigimg_cont',
	'SLIDER_CONT_ID' => $strMainID.'_slider_cont',
	'SLIDER_LIST' => $strMainID.'_slider_list',
	'SLIDER_LEFT' => $strMainID.'_slider_left',
	'SLIDER_RIGHT' => $strMainID.'_slider_right',
	'OLD_PRICE' => $strMainID.'_old_price',
	'PRICE' => $strMainID.'_price',
	'DISCOUNT_PRICE' => $strMainID.'_price_discount',
	'SLIDER_CONT_OF_ID' => $strMainID.'_slider_cont_',
	'SLIDER_LIST_OF_ID' => $strMainID.'_slider_list_',
	'SLIDER_LEFT_OF_ID' => $strMainID.'_slider_left_',
	'SLIDER_RIGHT_OF_ID' => $strMainID.'_slider_right_',
	'QUANTITY' => $strMainID.'_quantity',
	'QUANTITY_DOWN' => $strMainID.'_quant_down',
	'QUANTITY_UP' => $strMainID.'_quant_up',
	'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
	'QUANTITY_LIMIT' => $strMainID.'_quant_limit',
	'QUANTITY_MAX' => $strMainID.'_quant_max_',
	'BASIS_PRICE' => $strMainID.'_basis_price',
	'BUY_LINK' => $strMainID.'_buy_link',
	'ADD_BASKET_LINK' => $strMainID.'_add_basket_link',
	'LIKED_COMPARE_ID' => $strMainID.'_add_liked_compare_',
	'BUY_1_CLICK_ID' => $strMainID.'_buy_1_click_',
	'BASKET_ACTIONS' => $strMainID.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
	'ACTION_ECONOMY_ID' => $strMainID.'_action_economy',
	'COMPARE_LINK' => $strMainID.'_compare_link',
	'PROP' => $strMainID.'_prop_',
	'PROP_TABLE' => $strMainID.'_prop_table_',
	'ARTNUMBER_DIV' => $strMainID.'_articul_',
	'PROP_DIV' => $strMainID.'_skudiv',
	'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
	'OFFER_GROUP' => $strMainID.'_set_group_',
	'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
);
$arItemHtml = array(
    'ECONOMY_HTML' => GetMessage("CT_BCS_TPL_MESS_ECONOMY") . ': <span>#ECONOMY_PRICE#</span>',
);
$strObName = 'ob'.preg_replace("/[^a-zA-Z0-9_]/", "x", $strMainID);
$templateData['JS_OBJ'] = $strObName;

$strTitle = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
	: $arResult['NAME']
);
$strAlt = (
	isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
	? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
	: $arResult['NAME']
);
$minPrice = false;
$minPriceValue = 0;
$maxPriceValue = 0;
$minBasisPriceValue = 0;
$maxBasisPriceValue = 0;
if (isset($arResult['OFFERS'][0]['CATALOG_MEASURE_RATIO'])) {
    $arResult['CATALOG_MEASURE_RATIO'] = $arResult['OFFERS'][0]['CATALOG_MEASURE_RATIO'];
}
if (isset($arResult['MIN_PRICE']) || isset($arResult['RATIO_PRICE'])) {
    $minPrice = (isset($arResult['RATIO_PRICE']) ? $arResult['RATIO_PRICE'] : $arResult['MIN_PRICE']);
    $minPriceValue = $minPrice["DISCOUNT_VALUE"];
    $maxPriceValue = $minPrice["VALUE"];
    $minBasisPriceValue = (isset($arResult['MIN_PRICE'])) ? $arResult['MIN_PRICE']["DISCOUNT_VALUE"] : $minPriceValue;
    $maxBasisPriceValue = (isset($arResult['MIN_PRICE'])) ? $arResult['MIN_PRICE']["VALUE"] : $maxPriceValue;
}
if ($arResult['PROPERTIES']['OLD_PRICE']['VALUE'] > 0 && $arResult['PROPERTIES']['OLD_PRICE']['ACTIVE'] == 'Y') {
    $oldPrice = $arResult['PROPERTIES']['OLD_PRICE']['VALUE'] * $arResult['CATALOG_MEASURE_RATIO'];
    if ($oldPrice > $maxPriceValue) {
        $maxPriceValue = $oldPrice;
        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
            $maxBasisPriceValue = $oldPrice;
        } else {
            $maxBasisPriceValue = $arResult['PROPERTIES']['OLD_PRICE']['VALUE'];
        }
    }
}
$discount = ($maxPriceValue > 0 && $minPriceValue > 0) ? ($maxPriceValue - $minPriceValue) : 0;
$discountBasis = ($maxBasisPriceValue > 0 && $minBasisPriceValue > 0) ? ($maxBasisPriceValue - $minBasisPriceValue) : 0;
if ($arResult['CATALOG_MEASURE_RATIO'] === 1) {
    $arResult['MIN_BASIS_PRICE']['VALUE'] = $maxPriceValue;
    $arResult['MIN_BASIS_PRICE']['ECONOMY'] = $discount;
} else {
    $arResult['MIN_BASIS_PRICE']['VALUE'] = $maxBasisPriceValue;
    $arResult['MIN_BASIS_PRICE']['ECONOMY'] = $discountBasis;
}
$itemType = array();
$payed = 0;
$quantity = 0;
if (!empty($arResult['PROPERTIES']['DISCOUNT']['VALUE'])) {
    $itemType[] = 'discount';
}
if (!empty($arResult['PROPERTIES']['NEWPRODUCT']['VALUE']))
    $itemType[] = 'new';
    
if (!empty($arResult['PROPERTIES']['SALELEADER']['VALUE'])) {
    $itemType[] = 'hit';
}

if (intval($arResult['PROPERTIES']['PRODUCT_ACTION']['VALUE'])) {
    $itemType = array('action');
    $quantity = intval($arResult['PROPERTIES']['PRODUCT_ACTION']['VALUE']);
}
if (!empty($arResult['PROPERTIES']['PRODUCT_OF_DAY']['VALUE']) && intval($arResult['PROPERTIES']['ALREADY_PAYED']['VALUE']) > 0 && $discount > 0) {
    $itemType = array('prodday');
    $payed = intval($arResult['PROPERTIES']['ALREADY_PAYED']['VALUE']);
}
$isPriceComposite = ($arParams["REQUEST_LOAD"] == "Y") ? "N" : COption::GetOptionString("bitlate.apparelshop", "NL_CATALOG_PRICE_COMPOSITE", false, SITE_ID);
$isPriceMulty = ($arParams["PRICE_MULTY"] == "Y");
$typePict = NLApparelshopUtils::getSkuPictType($arResult);
$isShowPreviewPict = false;
if ($typePict == 'square' || $typePict == 'dropdown') {
    $isShowPreviewPict = NLApparelshopUtils::isShowPreviewPict($arResult);
}
$previewOfferPicCode = COption::GetOptionString("bitlate.apparelshop", 'NL_CATALOG_OFFER_PIC_CODE', false, SITE_ID);
$dropdownSelect = (COption::GetOptionString("bitlate.apparelshop", 'NL_CATALOG_OFFERS_DROPDOWN_SELECT', false, SITE_ID) == 'Y');
$notAvailableMessage = ($arParams['MESS_NOT_AVAILABLE'] != '' ? $arParams['MESS_NOT_AVAILABLE'] : GetMessageJS('CT_BCE_CATALOG_NOT_AVAILABLE'));
$h1 = (isset($arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] != '') ? $arResult["IPROPERTY_VALUES"]["ELEMENT_PAGE_TITLE"] : $arResult["NAME"];
?>
<meta itemprop="category" content="<?=$arResult['SECTION']['NAME']?>">
<div class="product-preview relative" id="<? echo $arItemIDs['ID']; ?>">
    <?if (in_array('prodday', $itemType) && $discount > 0):?>
        <div class="product-action-label best-day left"><?=GetMessage("CT_BCS_TPL_MESS_PRODDAY")?></div>
    <?endif;?>
    <?if (in_array('action', $itemType)):?>
        <div class="product-action-label time-buy left"><?=GetMessage("CT_BCS_TPL_MESS_ACTION")?></div>
    <?endif;?>
    <?reset($arResult['MORE_PHOTO']);
    $arFirstPhoto = current($arResult['MORE_PHOTO']);?>
    <div class="product-preview-main relative">
        <img src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>" class="zoom show-for-xlarge" id="<? echo $arItemIDs['PICT']; ?>">
        <img src="<? echo $arFirstPhoto['SRC']; ?>" alt="<? echo $strAlt; ?>" title="<? echo $strTitle; ?>" class="hide-for-xlarge" id="<? echo $arItemIDs['PICT_SUB']; ?>" itemprop="image">
    </div>
    <?if ($arParams["REQUEST_LOAD"] != "Y"):?>
        <a href="javascript:;" class="product-preview-zoom show-for-xlarge">
            <svg class="icon">
                <use xlink:href="#svg-icon-search"></use>
            </svg>
            <?=getMessage('CT_BCS_INCREASE')?>
        </a>
    <?endif;?>
    <?if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])):?>
        <div class="owl-carousel product-slider">
            <?foreach ($arResult['MORE_PHOTO'] as $i => &$arOnePhoto):
                $pic = NLApparelshopUtils::getResizeImg($arOnePhoto['ID'], array('width' => 61, 'height' => 61), BX_RESIZE_IMAGE_EXACT);
                if ($pic['src']):?>
                    <a href="<?=$arOnePhoto['SRC']?>" class="item<?if ($i == 0):?> active<?endif;?>" data-value="<? echo $arOnePhoto['ID']; ?>"><img src="<?=$pic['src']?>" alt=""></a>
                <?endif;
            endforeach;
            unset($arOnePhoto);?>
        </div>
    <?else:?>
        <?foreach ($arResult['OFFERS'] as $key => $arOneOffer):
            if (!isset($arOneOffer['MORE_PHOTO_COUNT']) || 0 >= $arOneOffer['MORE_PHOTO_COUNT']) {
                continue;
            }
            $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
            <div class="owl-carousel product-slider" id="<? echo $arItemIDs['SLIDER_CONT_OF_ID'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
                <?foreach ($arOneOffer['MORE_PHOTO'] as $i => &$arOnePhoto):
                    $pic = NLApparelshopUtils::getResizeImg($arOnePhoto['ID'], array('width' => 61, 'height' => 61), BX_RESIZE_IMAGE_EXACT);
                    if ($pic['src']):?>
                        <a href="<?=$arOnePhoto['SRC']?>" class="item<?if ($i == 0):?> active<?endif;?>" data-value="<? echo $arOneOffer['ID'].'_'.$arOnePhoto['ID']; ?>"><img src="<?=$pic['src']?>" alt=""></a>
                    <?endif;
                endforeach;
                unset($arOnePhoto);?>
            </div>
        <?endforeach;?>
    <?endif;?>
</div>
<div class="product-info vertical-top">
    <div class="product-info-block">
        <?/*
        $brand = $arResult['DISPLAY_PROPERTIES']['MANUFACTURE'];
        $manufacProp = 'arrFilter_' . $brand['ID'] . '_'.abs(crc32(htmlspecialcharsbx($brand['VALUE'])));
        $fileId = ($brand['LINK_ELEMENT_VALUE'][$brand['VALUE']]['PREVIEW_PICTURE']) ? $brand['LINK_ELEMENT_VALUE'][$brand['VALUE']]['PREVIEW_PICTURE'] : $brand['LINK_ELEMENT_VALUE'][$brand['VALUE']]['DETAIL_PICTURE'];
        $pic = false;
        if ($fileId > 0) {
            $pic = NLApparelshopUtils::getResizeImg($fileId, array('width' => 100, 'height' => 40));
        }
        if ($pic !== false):?>
            <a href="<?=$brand['LINK_ELEMENT_VALUE'][$brand['VALUE']]['DETAIL_PAGE_URL']?>" class="float-right hide-for-small-only hide-for-medium-only"><img src="<?=$pic['src']?>" alt="<?=$brand['LINK_ELEMENT_VALUE'][$brand['VALUE']]['NAME']?>"></a>
        <?endif;*/?>
        <h1 itemprop="name"><?=$h1?></h1>
        <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):
            foreach ($arResult['OFFERS'] as $key => $arOneOffer):
                $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
                <div class="product-info-code" id="<? echo $arItemIDs['ARTNUMBER_DIV'].$arOneOffer['ID'] ?>" style="display: <? echo $strVisible; ?>;">
                    <?if (!empty($arOneOffer['PROPERTIES']['ARTNUMBER']['VALUE']) && $arOneOffer['PROPERTIES']['ARTNUMBER']['ACTIVE']=="Y"):?>
                        <?=getMessage('CT_BCS_ARTICUL')?>: <?=$arOneOffer['PROPERTIES']['ARTNUMBER']['VALUE']?>
                    <?else:?>
                        &nbsp;
                    <?endif;?>
                </div>
            <?endforeach;
        elseif (!empty($arResult['PROPERTIES']['ARTNUMBER']['VALUE']) && $arResult['PROPERTIES']['ARTNUMBER']['ACTIVE']=="Y"):?>
            <div class="product-info-code"><?=getMessage('CT_BCS_ARTICUL')?>: <?=$arResult['PROPERTIES']['ARTNUMBER']['VALUE']?></div>
        <?endif;?>
        <?$canBuy = (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) ? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['CAN_BUY'] : $arResult['CAN_BUY'];?>
        <div class="row small-up-2 large-up-3">
            <div class="column">
                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                    <meta itemprop="ratingValue" content="<?=$arResult['RATING']?>">
                    <meta itemprop="ratingCount" content="<?=$arResult['VOTE_COUNT']?>">
                    <meta itemprop="bestRating" content="5">
                    <meta itemprop="worstRating" content="0">
                    <div class="rating-star">
                        <div class="rating-star-active" style="width: <?=($arResult['RATING']/5 * 100)?>%;"></div>
                    </div>
                    <span class="rating-count hide-for-small-only" title="<?=getMessage('CT_BCS_COUNT_RATE', array('COUNT' => $arResult['VOTE_COUNT']))?>"><?=$arResult['VOTE_COUNT']?></span>
                </div>
            </div>
            <div class="column products_count_info">
                <?if ($arParams['SHOW_MAX_QUANTITY'] !== 'N'):
                    if (!isset($arResult['OFFERS']) || empty($arResult['OFFERS'])):
                        $quantityInfo = NLApparelshopUtils::getProductAmount($arResult['CATALOG_QUANTITY'], $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
                        $quantityText = ($arParams['USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];?>
                        <div class="column existence <?=$quantityInfo['class']?>" title="<?=$quantityText?>">
                            <div class="existence-icon">
                                <div class="existence-icon-active"></div>
                            </div>
                            <span class="existence-count"><?=$quantityText?></span>
                        </div>
                    <?else:?>
                        <div class="column">
                            <?foreach ($arResult['OFFERS'] as $key => $arOneOffer):
                                $quantityInfo = NLApparelshopUtils::getProductAmount($arOneOffer['CATALOG_QUANTITY'], $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
                                $quantityText = ($arParams['USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];
                                $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
                                    <div class="existence <?=$quantityInfo['class']?>" id="<? echo $arItemIDs['QUANTITY_MAX'].$arOneOffer['ID']; ?>" style="display: <? echo $strVisible; ?>;">
                                        <div class="existence-icon">
                                            <div class="existence-icon-active"></div>
                                        </div>
                                        <span class="existence-count"><?=$quantityText?></span>
                                    </div>
                            <?endforeach;?>
                        </div>
                    <?endif;?>
                <?endif;?>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row" id="<? echo $arItemIDs['PROP_DIV']; ?>">
            <?if ($arParams['USE_PRODUCT_QUANTITY'] == 'Y'):?>
                <div class="column large-4">
                    <?if ((isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) || $canBuy):?>
                        <div class="product-count">
                            <div class="product-info-caption"><? echo GetMessage('CATALOG_QUANTITY'); ?></div>
                            <div class="input-group">
                                <div class="input-group-button">
                                    <button class="button decrement" type="button" id="<? echo $arItemIDs['QUANTITY_DOWN']; ?>">-</button>
                                </div>
                                <input id="<? echo $arItemIDs['QUANTITY']; ?>" class="input-group-field" type="number" name="count" min="1" value="<? echo (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) ? 1 : $arResult['CATALOG_MEASURE_RATIO']); ?>">
                                <div class="input-group-button">
                                    <button class="button increment" type="button" id="<? echo $arItemIDs['QUANTITY_UP']; ?>">+</button>
                                </div>
                            </div>
                        </div>
                    <?endif;?>
                </div>
            <?endif;?>
            <?$offersParams = array();
            if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && !empty($arResult['OFFERS_PROP'])):
                $treeOfferImg = array();
                $idColorProp = $arResult['SKU_PROPS'][$previewOfferPicCode]['ID'];
                foreach ($arResult['OFFERS'] as $offer) {
                    if (isset($offer['TREE']['PROP_' . $idColorProp]) && $isShowPreviewPict) {
                        $colorValue = $offer['TREE']['PROP_' . $idColorProp];
                        if (!isset($treeOfferImg[$colorValue])) {
                            if ($offer['PREVIEW_PICTURE']['SRC'] != "" && $offer['PREVIEW_PICTURE']['SRC'] != $arResult["EMPTY_PREVIEW"]) {
                                $treeOfferImg[$colorValue] = $offer['PREVIEW_PICTURE']['SRC'];
                            } elseif ($offer['DETAIL_PICTURE']['SRC'] != "" && $offer['DETAIL_PICTURE']['SRC'] != $arResult["EMPTY_PREVIEW"]) {
                                $treeOfferImg[$colorValue] = $offer['DETAIL_PICTURE']['SRC'];
                            } elseif ($offer['MORE_PHOTO'][0]['SRC'] != "" && $offer['MORE_PHOTO'][0]['TYPE'] != "video" && $offer['MORE_PHOTO'][0]['SRC'] != $arResult["EMPTY_PREVIEW"]) {
                                $treeOfferImg[$colorValue] = $offer['MORE_PHOTO'][0]['SRC'];
                            }
                        }
                    }
                }
                $arSkuProps = array();
                $countColumn = 1;
                $countSku = 0;
                foreach ($arResult['SKU_PROPS'] as $arProp) {
                    if (!!isset($arResult['OFFERS_PROP'][$arProp['CODE']])) {
                        $countSku++;
                    }
                }
                $curSku = 0;?>
                <?php
                $bSizeIsVisible = true;
                foreach ($arResult['SKU_PROPS'] as $k => &$arProp) {
                    if (!isset($arResult['OFFERS_PROP'][$arProp['CODE']]))
                        continue;
                    $curSku++;
                    $arSkuProps[] = array(
                        'ID' => $arProp['ID'],
                        'SHOW_MODE' => $arProp['SHOW_MODE'],
                        'VALUES_COUNT' => $arProp['VALUES_COUNT']
                    );
                    if ($countColumn >= 3) {
                        $countColumn = 0;
                    }
                    $classSku = "";
                    $classOption = "";
                    if ($curSku == $countSku) {
                        $classSku .= " end";
                    }
                    if ('TEXT' == $arProp['SHOW_MODE'] || $typePict == 'round') {
                        $classSku .= " large-4";
                        if ($countColumn < 1) {
                            $classSku .= " large-offset-4";
                            $countColumn++;
                        }
                        $countColumn++;
                        $classOption = "color";
                    } else {
                        $classSku .= " large-8";
                        if ($curSku > 1) {
                            $classSku .= " large-offset-4";
                            $countColumn = 2;
                        }
                        $countColumn += 2;
                        $classOption = "image";
                    }
                    if ('TEXT' == $arProp['SHOW_MODE']) {
                        $offersParams[] = $arProp['CODE'];
                        if ("SIZES_CLOTHES" == $arProp['CODE'] || "SIZES_SHOES" == $arProp['CODE']) {
                            $arProp['NAME'] = GetMessage("CT_BCS_CATALOG_SIZE_TITLE");
                        }?>
                        <div class="column large-8 flex-size-chart">
                            <div class="column product-info-option text" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
                                <div class="product-info-caption"><? echo htmlspecialcharsex($arProp['NAME']); ?></div>
                                <fieldset class="inline-block-container" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list">
                                   <?foreach ($arProp['VALUES'] as $arOneValue):
                                        $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);?>
                                        <div class="inline-block-item" data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>">
                                            <input type="radio" name="name_<?=$arProp['ID']?>" value="<?=$arOneValue['ID']?>" id="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="show-for-sr">
                                            <label for="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="inline-block-item" title="<?=$arOneValue['NAME']?>"><span><?=$arOneValue['NAME']?></span></label>
                                        </div>
                                    <?endforeach;?>
                                </fieldset>
                                <div class="bx_slide_left" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                <div class="bx_slide_right" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                            </div>

                            <?php if ($bSizeIsVisible) { ?>
                                <div class="column size_chart popup-open">
                                    <svg style="width: 30px;" viewBox="0 -100 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m442.3125 22.980469c-3.816406-1.601563-8.214844.195312-9.816406 4.015625-1.605469 3.820312.191406 8.214844 4.015625 9.816406 38.441406 16.128906 60.488281 38.710938 60.488281 61.957031 0 21.339844-18.1875 41.859375-51.207031 57.78125-34.765625 16.757813-81.148438 25.984375-130.613281 25.984375-49.464844 0-95.851563-9.226562-130.617188-25.984375-33.019531-15.921875-51.207031-36.441406-51.207031-57.78125 0-21.339843 18.1875-41.863281 51.207031-57.78125 34.765625-16.757812 81.152344-25.988281 130.617188-25.988281 31.460937 0 62.511718 3.859375 89.789062 11.15625 4.003906 1.070312 8.113281-1.308594 9.183594-5.308594 1.070312-4-1.304688-8.113281-5.304688-9.183594-28.527344-7.632812-60.917968-11.664062-93.667968-11.664062-51.675782 0-100.375 9.757812-137.128907 27.476562-38.496093 18.558594-59.695312 43.875-59.695312 71.292969v83.769531h-85.523438c-18.101562 0-32.832031 14.726563-32.832031 32.832032v63.625c0 18.105468 14.730469 32.832031 32.832031 32.832031h282.347657c51.671874 0 100.371093-9.757813 137.125-27.476563 38.496093-18.554687 59.695312-43.875 59.695312-71.289062v-114.292969c0-29.582031-25.398438-57.207031-69.6875-75.789062zm-308.957031 114.246093c10.117187 12.277344 25.179687 23.425782 44.695312 32.835938 9.835938 4.742188 20.535157 8.90625 31.914063 12.476562h-76.609375zm363.644531 75.835938c0 11.8125-5.585938 23.375-16.164062 34.046875v-62.765625c0-4.144531-3.355469-7.5-7.5-7.5-4.144532 0-7.5 3.355469-7.5 7.5v75.058594c-5.902344 4.019531-12.59375 7.847656-20.042969 11.4375-10.285157 4.960937-21.59375 9.25-33.6875 12.847656v-69.09375c0-4.144531-3.359375-7.5-7.5-7.5-4.144531 0-7.5 3.355469-7.5 7.5v73.097656c-16.84375 4.003906-34.921875 6.746094-53.730469 8.117188v-70.921875c0-4.144531-3.359375-7.5-7.5-7.5-4.144531 0-7.5 3.355469-7.5 7.5v71.71875c-4.371094.148437-8.769531.222656-13.195312.222656h-40.535157v-71.402344c0-4.144531-3.359375-7.5-7.5-7.5-4.144531 0-7.5 3.355469-7.5 7.5v71.402344h-53.734375v-71.402344c0-4.144531-3.355468-7.5-7.5-7.5-4.140625 0-7.5 3.355469-7.5 7.5v71.402344h-53.730468v-71.402344c0-4.144531-3.359376-7.5-7.5-7.5-4.140626 0-7.5 3.355469-7.5 7.5v71.402344h-53.730469v-71.402344c0-4.144531-3.359375-7.5-7.5-7.5s-7.5 3.355469-7.5 7.5v71.402344h-20.617188c-9.832031 0-17.832031-8-17.832031-17.832031v-63.625c0-9.835938 8-17.832032 17.832031-17.832032h282.347657c51.671874 0 100.371093-9.757812 137.125-27.476562 19.511718-9.40625 34.578124-20.546875 44.695312-32.820312zm0 0"/><path d="m246.972656 98.769531c0 20.957031 29.324219 36.765625 68.207032 36.765625 38.882812 0 68.203124-15.808594 68.203124-36.765625 0-20.960937-29.320312-36.765625-68.203124-36.765625-38.882813 0-68.207032 15.808594-68.207032 36.765625zm121.410156 0c0 10.273438-22.753906 21.765625-53.203124 21.765625-30.453126 0-53.207032-11.492187-53.207032-21.765625 0-10.277343 22.753906-21.765625 53.207032-21.765625 30.449218 0 53.203124 11.492188 53.203124 21.765625zm0 0"/>
                                    </svg>
                                    <span class="size-chart-title">
                                    ?????????????? ????????????????
                                    </span>
                                </div>
                            <?php
                                $bSizeIsVisible = false;
                            } ?>
                        </div>
                    <?} elseif ('PICT' == $arProp['SHOW_MODE']) {
                        $offersParams[] = $arProp['CODE'];?>
                        <div class="column<?=$classSku?>">
                            <?if ($typePict != 'dropdown'):?>
                                <div class="product-info-option <?=$classOption?>" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
                                    <div class="product-info-caption"><? echo htmlspecialcharsex($arProp['NAME']); ?></div>
                                    <fieldset class="inline-block-container" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list">
                                        <?foreach ($arProp['VALUES'] as $arOneValue):
                                            $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                            $pisSrc = (isset($treeOfferImg[$arOneValue['ID']]) && $typePict != 'round' && $arProp['CODE'] == $previewOfferPicCode) ? $treeOfferImg[$arOneValue['ID']] : $arOneValue['PICT']['SRC'];?>
                                            <div class="inline-block-item" data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>">
                                                <input type="radio" name="name_<?=$arProp['ID']?>" value="<?=$arOneValue['ID']?>" id="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="show-for-sr">
                                                <label for="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="inline-block-item" title="<?=$arOneValue['NAME']?>">
                                                    <?if ($typePict == 'round'):?>
                                                        <span style="background-image:url('<?=$pisSrc?>');"></span>
                                                    <?else:?>
                                                        <img src="<?=$pisSrc?>" alt="<?=$arOneValue['NAME']?>">
                                                    <?endif;?>
                                                </label>
                                            </div>
                                        <?endforeach;?>
                                        <div class="bx_slide_left" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                        <div class="bx_slide_right" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                    </fieldset>
                                </div>
                            <?else:?>
                                <div class="product-info-option list" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_cont">
                                    <div class="product-info-caption"><? echo htmlspecialcharsex($arProp['NAME']); ?></div>
                                    <div class="relative">
                                        <a href="javascript:;" class="dropdown-link" data-toggle="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_dropdown"><?=GetMessage("CT_BCE_CATALOG_SELECT")?></a>
                                        <div class="dropdown-pane" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_dropdown" data-dropdown data-v-offset="15" data-close-on-click="true">
                                            <fieldset class="inline-block-container" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_list">
                                                <?foreach ($arProp['VALUES'] as $arOneValue):
                                                    $arOneValue['NAME'] = htmlspecialcharsbx($arOneValue['NAME']);
                                                    $pisSrc = (isset($treeOfferImg[$arOneValue['ID']]) && $arProp['CODE'] == $previewOfferPicCode) ? $treeOfferImg[$arOneValue['ID']] : $arOneValue['PICT']['SRC'];?>
                                                    <div class="inline-block-item" data-treevalue="<? echo $arProp['ID'].'_'.$arOneValue['ID'] ?>" data-onevalue="<? echo $arOneValue['ID']; ?>">
                                                        <input type="radio" name="name_<?=$arProp['ID']?>" value="<?=$arOneValue['ID']?>" id="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="show-for-sr">
                                                        <label for="id_<?=$strMainID?>_<?=$arProp['ID']?>_<?=$arOneValue['ID']?>" class="table-container" title="<?=$arOneValue['NAME']?>">
                                                            <span class="table-item vertical-top">
                                                                <span class="image"><img src="<?=$pisSrc?>" alt="<?=$arOneValue['NAME']?>"></span>
                                                            </span>
                                                            <span class="table-item">
                                                                <span class="text"><?=$arOneValue['NAME']?></span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                <?endforeach;?>
                                                <div class="bx_slide_left" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_left" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                                <div class="bx_slide_right" id="<? echo $arItemIDs['PROP'].$arProp['ID']; ?>_right" data-treevalue="<? echo $arProp['ID']; ?>"></div>
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            <?endif;?>
                        </div>
                    <?}
                }
                unset($arProp);?>
            <?endif;?>
        </div>
    </div>
    <div class="product-info-block product-info-price">
        <div class="row">
            <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):
                $priceOffers = array();
                $minOffersPrice = 0;
                foreach ($arResult['OFFERS'] as $offer) {
                    $minOfferPrice = 0;
                    if (isset($offer['MIN_PRICE']) || isset($offer['RATIO_PRICE'])) {
                        $minPriceOffer = (isset($offer['RATIO_PRICE']) ? $offer['RATIO_PRICE'] : $offer['MIN_PRICE']);
                        $minOfferPrice = $minPriceOffer["DISCOUNT_VALUE"] / $offer['CATALOG_MEASURE_RATIO'];
                    }
                    $priceOffers[$offer['ID']] = $minOfferPrice;
                    if ($minOffersPrice == 0 || $minOffersPrice > $minOfferPrice) {
                        $minOffersPrice = $minOfferPrice;
                    }
                }?>
                <span class="hide" itemprop="offers" itemscope itemtype="http://schema.org/AggregateOffer">
                    <meta itemprop="offerCount" content="<?=count($arResult['OFFERS'])?>">
                    <meta itemprop="lowPrice" content="<?=$minOffersPrice?>">
                    <meta itemprop="priceCurrency" content="<?=$minPrice['CURRENCY']?>">
                    <?foreach ($arResult['OFFERS'] as $offer):?>
                        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <meta itemprop="sku" content="<?=$offer['ID']?>">
                            <meta itemprop="price" content="<?=$priceOffers[$offer['ID']]?>">
                            <meta itemprop="priceCurrency" content="<?=$offer['MIN_PRICE']['CURRENCY']?>">
                            <?$metaAvailability = ($offer['CAN_BUY']) ? 'InStock' : 'OutOfStock'; //PreOrder?>
                            <link itemprop="availability" href="http://schema.org/<?=$metaAvailability?>">
                        </span>
                    <?endforeach;?>
                </span>
            <?else:?>
                <span class="hide" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                    <meta itemprop="price" content="<?=$minPrice['DISCOUNT_VALUE']?>">
                    <meta itemprop="priceCurrency" content="<?=$minPrice['CURRENCY']?>">
                    <?$metaAvailability = ($canBuy) ? 'InStock' : 'OutOfStock'; //PreOrder?>
                    <link itemprop="availability" href="http://schema.org/<?=$metaAvailability?>">
                </span>
            <?endif;?>
            <div class="large-4 columns" id="<? echo $arItemIDs['PRICE']; ?>">
                <?if ($isPriceComposite == "Y"):?>
                    <?$frame = $this->createFrame($arItemIDs['PRICE'], false)->begin();?>
                <?endif;?>
                    <?$arPrices = array();
                    if ($isPriceMulty) {
                        if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                            $arPrices = $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]['PRICES'];
                        } else {
                            $arPrices = $arResult['PRICES'];
                        }
                    }?>
                    <?if (count($arPrices) > 1):?>
                        <?foreach($arPrices as $code => $arPrice):
                            $arPrice['VALUE'] = $arPrice['VALUE'] * $arResult['CATALOG_MEASURE_RATIO'];
                            $arPrice['DISCOUNT_VALUE'] = $arPrice['DISCOUNT_VALUE'] * $arResult['CATALOG_MEASURE_RATIO'];
                            $maxItemPriceValue = ($arPrice['VALUE'] > $maxPriceValue) ? $arPrice['VALUE'] : $maxPriceValue;
                            $discountPrice = $maxItemPriceValue - $arPrice['DISCOUNT_VALUE'];?>
                            <div class="product-price sale-price">
                                <div class="product-info-caption"><?=$arResult['CAT_PRICES'][$code]['TITLE']?></div>
                                <div class="main"><?=CCurrencyLang::CurrencyFormat($arPrice['DISCOUNT_VALUE'], $arPrice['CURRENCY'])?></div>
                                <?if ('Y' == $arParams['SHOW_OLD_PRICE'] && $discountPrice > 0):?>
                                    <div class="old"><?=CCurrencyLang::CurrencyFormat($maxItemPriceValue, $arPrice['CURRENCY'])?></div>
                                    <div class="economy"><?=GetMessage("CT_BCS_TPL_MESS_ECONOMY")?>: <span><?=CCurrencyLang::CurrencyFormat($discountPrice, $arPrice['CURRENCY'])?></span></div>
                                <?endif;?>
                            </div>
                        <?endforeach;?>
                    <?else:?>
                        <div class="product-price sale-price">
                            <div class="main"><?=$minPrice['PRINT_DISCOUNT_VALUE']?></div>
                            <?if ('Y' == $arParams['SHOW_OLD_PRICE'] && $discount > 0):?>
                                <div class="old" id="<? echo $arItemIDs['OLD_PRICE']; ?>"><?=CCurrencyLang::CurrencyFormat($maxPriceValue, $arResult['MIN_PRICE']['CURRENCY'])?></div>
                                <div class="economy" id="<? echo $arItemIDs['DISCOUNT_PRICE']; ?>"><?=GetMessage("CT_BCS_TPL_MESS_ECONOMY")?>: <span><?=CCurrencyLang::CurrencyFormat($discount, $minPrice['CURRENCY'])?></span></div>
                            <?endif;?>
                        </div>
                    <?endif;?>
                <?if ($isPriceComposite == "Y"):?>
                    <?$frame->beginStub();?>
                    <?$frame->end();?>
                <?endif;?>
            </div>
            <div class="large-8 columns">
                <div class="row large-up-2">
                    <div class="column" id="<? echo $arItemIDs['BASKET_ACTIONS']; ?>">
                        <?$buttonText = ('' != $arParams['MESS_BTN_BUY'] ? $arParams['MESS_BTN_BUY'] : GetMessage('CT_BCE_CATALOG_ADD'));?>
                        <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):?>
                            <?foreach ($arResult['OFFERS'] as $key => $arOffer):
                                $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
                                $canOfferBuy = ($arOffer['CAN_BUY']) ? true : false;?>
                                <a id="<? echo $arItemIDs['BUY_LINK']; ?><?=$arOffer['ID']?>" href="javascript:;" class="product-info-button-primary button add2cart" data-preview="#<? echo $arItemIDs['PICT']; ?>" data-product-id="<?=$arOffer['ID']?>"<?if (!$canOfferBuy):?> disabled="disabled"<?endif;?> style="display: <? echo $strVisible; ?>;">
                                    <svg class="icon">
                                        <use xlink:href="#svg-icon-cart"></use>
                                    </svg>
                                   <span><? echo $buttonText; ?></span>
                                </a>
                            <?endforeach;?>
                        <?else:?>
                            <a id="<? echo $arItemIDs['BUY_LINK']; ?>" href="javascript:;" class="product-info-button-primary button add2cart" data-preview="#<? echo $arItemIDs['PICT']; ?>" data-product-id="<?=$arResult['ID']?>"<?if (!$canBuy):?> disabled="disabled"<?endif;?>>
                                <svg class="icon">
                                    <use xlink:href="#svg-icon-cart"></use>
                                </svg>
                               <span><? echo $buttonText; ?></span>
                            </a>
                        <?endif;?>
                    </div>
                    <div class="column">
                        <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):?>
                            <?foreach ($arResult['OFFERS'] as $key => $arOffer):
                                $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');
                                $minOfferPrice = 0;
                                if (isset($arOffer['MIN_PRICE']) || isset($arOffer['RATIO_PRICE'])) {
                                    $minPriceOffer = (isset($arOffer['RATIO_PRICE']) ? $arOffer['RATIO_PRICE'] : $arOffer['MIN_PRICE']);
                                    $minOfferPrice = $minPriceOffer["DISCOUNT_VALUE"] / $arOffer['CATALOG_MEASURE_RATIO'];
                                    $minOfferCurrency = $minPriceOffer["CURRENCY"];
                                }
                                $canOfferBuy = $arOffer['CAN_BUY'];?>
                                <div id="<? echo $arItemIDs['BUY_1_CLICK_ID']; ?><?=$arOffer['ID']?>" style="display: <? echo $strVisible; ?>;">
                                    <a href="<?=(($canOfferBuy) ? '#buy-to-click' : 'javascript:;')?>" class="product-info-button-primary button secondary go2buy<?=(($canOfferBuy) ? '' : ' disabled')?>"><?=GetMessage('CT_BCS_BUY_1_CLICK')?></a>
                                    <input type="hidden" name="cart" value="<?=base64_encode(json_encode('N'))?>" />
                                    <input type="hidden" name="id" value="<?=base64_encode(json_encode($arResult['ID']))?>" />
                                    <input type="hidden" name="offer_id" value="<?=base64_encode(json_encode($arOffer['ID']))?>" />
                                    <input type="hidden" name="props" value="<?=base64_encode(json_encode($offersParams))?>" />
                                    <input type="hidden" name="price" value="<?=base64_encode(json_encode($minOfferPrice))?>" />
                                    <input type="hidden" name="currency" value="<?=base64_encode(json_encode($minOfferCurrency))?>" />
                                </div>
                            <?endforeach;?>
                        <?else:?>
                            <div id="<? echo $arItemIDs['BUY_1_CLICK_ID']; ?>">
                                <a href="<?=(($canBuy) ? '#buy-to-click' : 'javascript:;')?>" class="product-info-button-primary button secondary go2buy<?=(($canBuy) ? '' : ' disabled')?>"><?=GetMessage('CT_BCS_BUY_1_CLICK')?></a>
                                <input type="hidden" name="cart" value="<?=base64_encode(json_encode('N'))?>" />
                                <input type="hidden" name="id" value="<?=base64_encode(json_encode($arResult['ID']))?>" />
                                <input type="hidden" name="offer_id" value="" />
                                <input type="hidden" name="props" value="" />
                                <input type="hidden" name="price" value="<?=base64_encode(json_encode($arResult['MIN_BASIS_PRICE']["DISCOUNT_VALUE"]))?>" />
                                <input type="hidden" name="currency" value="<?=base64_encode(json_encode($minPrice["CURRENCY"]))?>" />
                            </div>
                        <?endif;?>
                    </div>
                </div>
                <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):?>
                    <?foreach ($arResult['OFFERS'] as $key => $arOffer):
                        $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
                        <div class="row medium-up-2" id="<? echo $arItemIDs['LIKED_COMPARE_ID']; ?><?=$arOffer['ID']?>" style="display: <? echo $strVisible; ?>;">
                            <div class="column">
                                <a href="#" class="button transparent add2liked" data-ajax="<?=SITE_DIR?>nl_ajax/favorite.php" data-product-id="<?=$arOffer['ID']?>">
                                    <svg class="icon">
                                        <use xlink:href="#svg-icon-liked"></use>
                                    </svg>
                                    <span><?=GetMessage('CT_BCS_ADD_2_LIKED')?></span>
                                </a>
                            </div>
                            <?if ($arParams['DISPLAY_COMPARE']):?>
                                <div class="column">
                                    <a href="javascript:void(0);" id="<? echo $arItemIDs['COMPARE_LINK']; ?><?=$arOffer['ID']?>" class="button transparent add2compare" data-product-id="<?=$arOffer['ID']?>">
                                        <svg class="icon">
                                            <use xlink:href="#svg-icon-compare"></use>
                                        </svg>
                                        <span><?=GetMessage('CT_BCS_ADD_2_COMPARE')?></span>
                                    </a>
                                </div>
                            <?endif;?>
                        </div>
                    <?endforeach;?>
                <?else:?>
                    <div class="row medium-up-2" id="<? echo $arItemIDs['LIKED_COMPARE_ID']; ?>">
                        <div class="column">
                            <a href="#" class="button transparent add2liked" data-ajax="<?=SITE_DIR?>nl_ajax/favorite.php" data-product-id="<?=$arResult['ID']?>">
                                <svg class="icon">
                                    <use xlink:href="#svg-icon-liked"></use>
                                </svg>
                                <span><?=GetMessage('CT_BCS_ADD_2_LIKED')?></span>
                            </a>
                        </div>
                        <?if ($arParams['DISPLAY_COMPARE']):?>
                            <div class="column">
                                <a href="javascript:void(0);" id="<? echo $arItemIDs['COMPARE_LINK']; ?>" class="button transparent add2compare" data-product-id="<?=$arResult['ID']?>">
                                    <svg class="icon">
                                        <use xlink:href="#svg-icon-compare"></use>
                                    </svg>
                                    <span><?=GetMessage('CT_BCS_ADD_2_COMPARE')?></span>
                                </a>
                            </div>
                        <?endif;?>
                    </div>
                <?endif;?>
            </div>
        </div>
    </div>
    <?php
    $isDescription = ('' != $arResult['DETAIL_TEXT'] || (!empty($arResult['DISPLAY_PROPERTIES']['DOCS']['VALUE']) && $arResult['DISPLAY_PROPERTIES']['DOCS']['ACTIVE'] == 'Y'));
    ?>
    <?if ($isDescription || '' != $arResult['PROPERTIES']['PODKLADKA']['VALUE'] || '' != $arResult['PROPERTIES']['SOSTAV_TKANI']['VALUE'] || '' != $arResult['PREVIEW_TEXT'] || in_array('action', $itemType) || (in_array('prodday', $itemType) && $discount > 0)):?>
        <div class="product-info-block product-info-desc">
            <?if (in_array('action', $itemType)):?>
                <div class="product-action-banner timer text-center show-for-large">
                    <div class="table-container">
                        <svg class="icon table-item">
                            <use xlink:href="#svg-icon-timer"></use>
                        </svg>
                        <div class="info table-item">
                            <div class="table-container">
                                <div class="table-item time hour"><strong>00</strong> <?=GetMessage("CT_BCS_TPL_MESS_HOUR")?></div>
                                <div class="table-item time min"><strong>00</strong> <?=GetMessage("CT_BCS_TPL_MESS_MINUTE")?></div>
                                <div class="table-item time sec"><strong>00</strong> <?=GetMessage("CT_BCS_TPL_MESS_SECOND")?></div>
                            </div>
                        </div>
                        <?if (!$arResult["CATALOG_MEASURE_NAME"] && isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                            foreach ($arResult['OFFERS'] as $keyOffer => $arOffer) {
                                $arResult["CATALOG_MEASURE_NAME"] = $arOffer["CATALOG_MEASURE_NAME"];
                                break;
                            }
                        }?>
                        <div class="counter table-item"><strong><?=$quantity?></strong> <?=$arResult["CATALOG_MEASURE_NAME"]?></div>
                    </div>
                </div>
            <?endif;?>
            <?if (in_array('prodday', $itemType) && $discount > 0):?>
                <div class="product-action-banner economy text-center show-for-large">
                    <div class="table-container">
                        <div class="icon rub table-item"><?=GetMessage("CT_BCS_TPL_RUB")?></div>
                        <div class="info table-item"><strong id="<? echo $arItemIDs['ACTION_ECONOMY_ID']; ?>"><?=CCurrencyLang::CurrencyFormat($discount, $arResult['MIN_PRICE']['CURRENCY'])?></strong> <?=GetMessage("CT_BCS_TPL_MESS_ECONOMY_2")?></div>
                        <div class="counter table-item">
                            <div class="progress float-center">
                                <div class="progress active" style="width:<?=$payed?>%;"></div>
                            </div>
                            <?=GetMessage("CT_BCS_TPL_MESS_PAYED", array("#PAYED#" => $payed))?>
                        </div>
                    </div>
                </div>
            <?endif;?>
            <?if ('' != $arResult['PREVIEW_TEXT']):?>
                <div itemprop="description"><? echo $arResult['PREVIEW_TEXT']; ?></div>
            <?endif;?>


            <div class="b-props">
                <?php if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {

                    foreach ($arResult['OFFERS'] as $key => $arOneOffer) {
                        $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
                        <div id="<? echo $arItemIDs['PROP_TABLE'].$arOneOffer['ID'] ?>" style="display: <? echo $strVisible; ?>;">
                            <?php
                            $elemntCount = 0;
                            foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty) {
                                $elemntCount++;
                                if ($elemntCount > 3) {
                                    $hidePropClass = 'hidden_prop';
                                } else {
                                    $hidePropClass = '';
                                }
                                if (in_array($arProperty['ID'], $arResult['SHOWED_PROPERTIES']) && $arProperty['ACTIVE'] == 'Y') {
                                    $pValue = (is_array($arProperty['DISPLAY_VALUE']) ? implode(' / ', $arProperty['DISPLAY_VALUE']) : $arProperty['DISPLAY_VALUE']);?>
                                    <div class="<?= $hidePropClass?>"><b><?=$arProperty['NAME']?>: </b> <?=$pValue?></div>
                                <?php }
                            }?>
                            <?if (!empty($arOneOffer['DISPLAY_PROPERTIES'])) {
                                $elemntCount = 0;
                                foreach ($arOneOffer['DISPLAY_PROPERTIES'] as $arOneProp) {
                                    $elemntCount++;
                                    if ($elemntCount > 3) {
                                        $hidePropClass = 'hidden_prop';
                                    } else {
                                        $hidePropClass = '';
                                    }
                                    $pValue = (is_array($arOneProp['DISPLAY_VALUE']) ? implode(' / ', $arOneProp['DISPLAY_VALUE']) : $arOneProp['DISPLAY_VALUE']);?>
                                    <div><b><?=$arOneProp['NAME']?>:</b> <?=$pValue?></div>
                                <?php }
                            };?>

                            <?php if ($hidePropClass != '') {?>
                                <span class="show_all all_props">??????????????????</span>
                            <?php }?>
                        </div>
                    <?php }?>
                <?php } else {?>
                    <table>
                        <?php
                        $elemntCount = 0;
                        foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty) {
                            $elemntCount++;
                            if ($elemntCount > 3) {
                                $hidePropClass = 'hidden_prop';
                            } else {
                                $hidePropClass = '';
                            }
                            if (in_array($arProperty['ID'], $arResult['SHOWED_PROPERTIES']) && $arProperty['ACTIVE'] == 'Y') {
                                $pValue = (is_array($arProperty['DISPLAY_VALUE']) ? implode(' / ', $arProperty['DISPLAY_VALUE']) : $arProperty['DISPLAY_VALUE']);?>
                                <div class="<?=$hidePropClass?>"><b><?=$arProperty['NAME']?>: </b> <?=$pValue?></div>
                            <?php }
                        }?>
                    </table>
                <?php }?>
            </div>

            <div class="description_on_left_sidebar_cart">
                <?php if ('' != $arResult['DETAIL_TEXT']) { ?>
                    <b>????????????????</b>
                    <?php if (mb_strlen($arResult['DETAIL_TEXT']) > 200) {?>
                        <div class="short_descr">
                            <?= TruncateText($arResult['DETAIL_TEXT'], 200);?>
                        </div>
                        <div class="full_descr_text">
                            <?= $arResult['DETAIL_TEXT'];?>
                        </div>
                        <span class="show_all full_descr">??????????????????</span>
                    <?php } else { ?>
                        <p><? echo $arResult['DETAIL_TEXT']; ?></p>
                    <?php }?>
                <?php }?>


                <?if (!empty($arResult['DISPLAY_PROPERTIES']['DOCS']['VALUE']) && $arResult['DISPLAY_PROPERTIES']['DOCS']['ACTIVE'] == 'Y'):
                    $i = 0;?>
                    <dl class="product-doc row xlarge-up-2">
                        <dt><?=getMessage('CT_BCE_CATALOG_DOCS')?></dt>
                        <?if ($arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE']['ID'] > 0):
                            $tmpDocInfo = $arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'];
                            $arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'] = array();
                            $arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'][0] = $tmpDocInfo;?>
                        <?endif;?>
                        <?foreach ($arResult['DISPLAY_PROPERTIES']['DOCS']['FILE_VALUE'] as $docInfo):?>
                            <dd class="column<?if ($i == 0):?> inline-block-container<?endif;?>">
                                <a href="<?=$docInfo['SRC']?>" target="_blank">
                                                <span class="inline-block-item vertical-middle product-doc-icon">
                                                    <svg class="icon">
                                                        <use xlink:href="#svg-icon-doc"></use>
                                                    </svg>
                                                    <span class="extention"><?=NLApparelshopUtils::getFileExtention($docInfo['FILE_NAME'])?></span>
                                                </span>
                                    <span class="inline-block-item vertical-middle product-doc-name">
                                                    <?$docName = $docInfo['DESCRIPTION'];
                                                    if ($docName == '') {
                                                        $originalName = explode('.', $docInfo['ORIGINAL_NAME']);
                                                        unset($originalName[(count($originalName) + 1)]);
                                                        $docName = implode('.', $originalName);
                                                    }
                                                    $docName = ($docName != '') ? $docName : getMessage('CT_BCE_CATALOG_DOC');?>
                                        <?=$docName?> <span>(<?=NLApparelshopUtils::getFileSize($docInfo['FILE_SIZE'])?>)</span>
                                                </span>
                                </a>
                            </dd>
                            <?$i++;
                        endforeach;?>
                    </dl>
                <?endif;?>
            </div>

            <div class="availability_in_stores">
                <div><b>?????????????? ?? ??????????????????: </b></div>
                <div class="show_all availability_show">(????????????????)</div>
                <div class="availability_in_stores_content">

                </div>
            </div>

        </div>
    <?endif;?>

    <script src="//yastatic.net/share2/share.js" charset="utf-8"></script>
    <div class="ya-share2 hide" data-services="facebook,vkontakte,odnoklassniki,twitter,gplus"></div>
</div>
<?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']))
{
    foreach ($arResult['JS_OFFERS'] as $keyOffer => &$arOneJS)
    {
        if ($arOneJS['PRICE']['DISCOUNT_VALUE'] != $arOneJS['PRICE']['VALUE'])
        {
            $arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['PRICE']['DISCOUNT_DIFF_PERCENT'];
            $arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arOneJS['BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
        }
        $strProps = '';
        $arOneJS['DISPLAY_PROPERTIES'] = $strProps;
        if ($arResult['PROPERTIES']['OLD_PRICE']['VALUE'] > 0 && 
            $arResult['PROPERTIES']['OLD_PRICE']['ACTIVE'] == 'Y' &&
            ($arResult['PROPERTIES']['OLD_PRICE']['VALUE'] * $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO']) > $arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE']) {
            $arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE'] = $arResult['PROPERTIES']['OLD_PRICE']['VALUE'] * $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO'];
        }
        $maxItemPriceValue = ($arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE'] > $maxBasisPriceValue) ? $arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE'] : $maxBasisPriceValue;
        $discountOffer = $arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE'] - $arResult['JS_OFFERS'][$keyOffer]['PRICE']['DISCOUNT_VALUE'];
        $arResult['JS_OFFERS'][$keyOffer]['PRICE']['VALUE'] = $maxItemPriceValue;
        $arResult['JS_OFFERS'][$keyOffer]['PRICE']['ECONOMY'] = $maxItemPriceValue - $arResult['JS_OFFERS'][$keyOffer]['PRICE']['DISCOUNT_VALUE'];
        $arResult['JS_OFFERS'][$keyOffer]['BASIS_PRICE']['VALUE'] = $maxItemPriceValue / $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO'];
        $arResult['JS_OFFERS'][$keyOffer]['BASIS_PRICE']['ECONOMY'] = ($maxItemPriceValue - $arResult['JS_OFFERS'][$keyOffer]['PRICE']['DISCOUNT_VALUE']) / $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO'];
        if ($isPriceMulty && count($arResult['OFFERS'][$keyOffer]['PRICES']) > 1) {
            $iPrice = 0;
            $maxBasisItemPriceValue = $maxBasisPriceValue / $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO'];
            foreach($arResult['OFFERS'][$keyOffer]['PRICES'] as $code => $arPrice) {
                $maxItemPriceValue = ($arPrice['VALUE'] > $maxBasisItemPriceValue) ? $arPrice['VALUE'] : $maxBasisItemPriceValue;
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['TITLE'] = $arResult['CAT_PRICES'][$code]['TITLE'];
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['DISCOUNT_VALUE'] = $arPrice['DISCOUNT_VALUE'];
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['VALUE'] = $maxItemPriceValue;
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['ECONOMY'] = $maxItemPriceValue - $arPrice['DISCOUNT_VALUE'];
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['CURRENCY'] = $arPrice['CURRENCY'];
                $arResult['JS_OFFERS'][$keyOffer]['PRICES'][$iPrice]['CATALOG_MEASURE_RATIO'] = $arResult['OFFERS'][$keyOffer]['CATALOG_MEASURE_RATIO'];
                $iPrice++;
            }
        }
    }
    if (isset($arOneJS))
        unset($arOneJS);
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => true,
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'SHOW_SKU_PROPS' => $arResult['SHOW_OFFERS_PROPS'],
            'OFFER_GROUP' => $arResult['OFFER_GROUP'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE' => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            'DROPDOWN_SELECT' => $dropdownSelect
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
            'ECONOMY_HTML' => $arItemHtml['ECONOMY_HTML'],
        ),
        'DEFAULT_PICTURE' => array(
            'PREVIEW_PICTURE' => $arResult['DEFAULT_PICTURE'],
            'DETAIL_PICTURE' => $arResult['DEFAULT_PICTURE']
        ),
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'NAME' => $arResult['~NAME']
        ),
        'BASKET' => array(
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'BASKET_URL' => $arParams['BASKET_URL'],
            'SKU_PROPS' => $arResult['OFFERS_PROP_CODES'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        ),
        'OFFERS' => $arResult['JS_OFFERS'],
        'OFFER_SELECTED' => $arResult['OFFERS_SELECTED'],
        'TREE_PROPS' => $arSkuProps
    );
    if ($arParams['DISPLAY_COMPARE'])
    {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH' => $arParams['COMPARE_PATH']
        );
    }
} else {
    $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
    if ('Y' == $arParams['ADD_PROPERTIES_TO_BASKET'] && !$emptyProductProperties)
    {?>
        <div id="<? echo $arItemIDs['BASKET_PROP_DIV']; ?>" style="display: none;">
            <?if (!empty($arResult['PRODUCT_PROPERTIES_FILL'])) {
                foreach ($arResult['PRODUCT_PROPERTIES_FILL'] as $propID => $propInfo) {?>
                    <input type="hidden" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo htmlspecialcharsbx($propInfo['ID']); ?>">
                    <?if (isset($arResult['PRODUCT_PROPERTIES'][$propID]))
                        unset($arResult['PRODUCT_PROPERTIES'][$propID]);
                }
            }
            $emptyProductProperties = empty($arResult['PRODUCT_PROPERTIES']);
            if (!$emptyProductProperties) {?>
                <table>
                    <?foreach ($arResult['PRODUCT_PROPERTIES'] as $propID => $propInfo) {?>
                        <tr itemprop="additionalProperty" itemscope itemtype="http://schema.org/PropertyValue">
                            <td itemprop="name"><? echo $arResult['PROPERTIES'][$propID]['NAME']; ?></td>
                            <td itemprop="value">
                                <?if ('L' == $arResult['PROPERTIES'][$propID]['PROPERTY_TYPE'] && 'C' == $arResult['PROPERTIES'][$propID]['LIST_TYPE']) {
                                    foreach($propInfo['VALUES'] as $valueID => $value) {
                                        ?><label><input type="radio" name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]" value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"checked"' : ''); ?>><? echo $value; ?></label><br><?
                                    }
                                } else {?>
                                    <select name="<? echo $arParams['PRODUCT_PROPS_VARIABLE']; ?>[<? echo $propID; ?>]">
                                        <?foreach($propInfo['VALUES'] as $valueID => $value) {?>
                                            <option value="<? echo $valueID; ?>" <? echo ($valueID == $propInfo['SELECTED'] ? '"selected"' : ''); ?>><? echo $value; ?></option>
                                        <?}?>
                                    </select>
                                <?}?>
                            </td>
                        </tr>
                    <?}?>
                </table>
            <?}?>
        </div>
    <?}
    if ($arResult['MIN_PRICE']['DISCOUNT_VALUE'] != $arResult['MIN_PRICE']['VALUE'])
    {
        $arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
        $arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'] = -$arResult['MIN_BASIS_PRICE']['DISCOUNT_DIFF_PERCENT'];
    }
    $arJSParams = array(
        'CONFIG' => array(
            'USE_CATALOG' => $arResult['CATALOG'],
            'SHOW_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
            'SHOW_PRICE' => (isset($arResult['MIN_PRICE']) && !empty($arResult['MIN_PRICE']) && is_array($arResult['MIN_PRICE'])),
            'SHOW_DISCOUNT_PERCENT' => ($arParams['SHOW_DISCOUNT_PERCENT'] == 'Y'),
            'SHOW_OLD_PRICE' => ($arParams['SHOW_OLD_PRICE'] == 'Y'),
            'DISPLAY_COMPARE' => $arParams['DISPLAY_COMPARE'],
            'MAIN_PICTURE_MODE' => $arParams['DETAIL_PICTURE_MODE'],
            'SHOW_BASIS_PRICE' => ($arParams['SHOW_BASIS_PRICE'] == 'Y'),
            'ADD_TO_BASKET_ACTION' => $arParams['ADD_TO_BASKET_ACTION'],
            'SHOW_CLOSE_POPUP' => ($arParams['SHOW_CLOSE_POPUP'] == 'Y'),
            'DROPDOWN_SELECT' => $dropdownSelect
        ),
        'VISUAL' => array(
            'ID' => $arItemIDs['ID'],
            'ECONOMY_HTML' => $arItemHtml['ECONOMY_HTML'],
        ),
        'PRODUCT_TYPE' => $arResult['CATALOG_TYPE'],
        'PRODUCT' => array(
            'ID' => $arResult['ID'],
            'PICT' => $arFirstPhoto,
            'NAME' => $arResult['~NAME'],
            'SUBSCRIPTION' => true,
            'PRICE' => $arResult['MIN_PRICE'],
            'BASIS_PRICE' => $arResult['MIN_BASIS_PRICE'],
            'SLIDER_COUNT' => $arResult['MORE_PHOTO_COUNT'],
            'SLIDER' => $arResult['MORE_PHOTO'],
            'CAN_BUY' => $arResult['CAN_BUY'],
            'CHECK_QUANTITY' => $arResult['CHECK_QUANTITY'],
            'QUANTITY_FLOAT' => is_double($arResult['CATALOG_MEASURE_RATIO']),
            'MAX_QUANTITY' => $arResult['CATALOG_QUANTITY'],
            'STEP_QUANTITY' => $arResult['CATALOG_MEASURE_RATIO'],
        ),
        'BASKET' => array(
            'ADD_PROPS' => ($arParams['ADD_PROPERTIES_TO_BASKET'] == 'Y'),
            'QUANTITY' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
            'PROPS' => $arParams['PRODUCT_PROPS_VARIABLE'],
            'EMPTY_PROPS' => $emptyProductProperties,
            'BASKET_URL' => $arParams['BASKET_URL'],
            'ADD_URL_TEMPLATE' => $arResult['~ADD_URL_TEMPLATE'],
            'BUY_URL_TEMPLATE' => $arResult['~BUY_URL_TEMPLATE']
        )
    );
    if ($arParams['DISPLAY_COMPARE'])
    {
        $arJSParams['COMPARE'] = array(
            'COMPARE_URL_TEMPLATE' => $arResult['~COMPARE_URL_TEMPLATE'],
            'COMPARE_PATH' => $arParams['COMPARE_PATH']
        );
    }
    if ($isPriceMulty && count($arResult['PRICES']) > 1) {
        $iPrice = 0;
        foreach($arResult['PRICES'] as $code => $arPrice) {
            $maxItemPriceValue = ($arPrice['VALUE'] > $maxBasisPriceValue) ? $arPrice['VALUE'] : $maxBasisPriceValue;
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['CODE'] = $code;
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['TITLE'] = $arResult['CAT_PRICES'][$code]['TITLE'];
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['DISCOUNT_VALUE'] = $arPrice['DISCOUNT_VALUE'];
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['VALUE'] = $maxItemPriceValue;
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['ECONOMY'] = $maxItemPriceValue - $arPrice['DISCOUNT_VALUE'];
            $arJSParams['PRODUCT']['PRICES'][$iPrice]['CURRENCY'] = $arPrice['CURRENCY'];
            $iPrice++;
        }
    }
    unset($emptyProductProperties);
}?>
<script type="text/javascript">
    <?if ($isPriceComposite == "Y"):?>
        if (window.frameCacheVars === undefined) {
            var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
        } else {
             BX.addCustomEvent("onFrameDataReceived" , function(json) {
                var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
            });
        }
    <?else:?>
        var <? echo $strObName; ?> = new JCCatalogElement(<? echo CUtil::PhpToJSObject($arJSParams, false, true); ?>);
    <?endif;?>
    <?if ($arParams["REQUEST_LOAD"] != "Y"):?>
        BX.message({
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCS_CATALOG_BTN_MESSAGE_BASKET_REDIRECT'); ?>',
            BASKET_URL: '<? echo $arParams["BASKET_URL"]; ?>',
            ADD_TO_BASKET_BUTTON: '<? echo $buttonText; ?>',
            ECONOMY_INFO_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_ECONOMY_INFO'); ?>',
            BASIS_PRICE_MESSAGE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_BASIS_PRICE') ?>',
            TITLE_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_ERROR') ?>',
            TITLE_BASKET_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_TITLE_BASKET_PROPS') ?>',
            BASKET_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_BASKET_UNKNOWN_ERROR') ?>',
            BTN_SEND_PROPS: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_SEND_PROPS'); ?>',
            BTN_MESSAGE_BASKET_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_BASKET_REDIRECT') ?>',
            BTN_MESSAGE_CLOSE: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE'); ?>',
            BTN_MESSAGE_CLOSE_POPUP: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_CLOSE_POPUP'); ?>',
            TITLE_SUCCESSFUL: '<? echo GetMessageJS('CT_BCE_CATALOG_ADD_TO_BASKET_OK'); ?>',
            COMPARE_MESSAGE_OK: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_OK') ?>',
            COMPARE_UNKNOWN_ERROR: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_UNKNOWN_ERROR') ?>',
            COMPARE_TITLE: '<? echo GetMessageJS('CT_BCE_CATALOG_MESS_COMPARE_TITLE') ?>',
            BTN_MESSAGE_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_MESSAGE_COMPARE_REDIRECT') ?>',
            BTN_COMPARE_REDIRECT: '<? echo GetMessageJS('CT_BCE_CATALOG_BTN_COMPARE_REDIRECT') ?>',
            SITE_ID: '<? echo SITE_ID; ?>'
        });
        $(document).ready(function(){
            var NL_ADD_TO_BASKET = '<?=GetMessageJS('ADD_TO_BASKET')?>';
            var NL_ADD_TO_BASKET_URL = '<?=$arParams['BASKET_URL']?>';
            var NL_ADD_TO_BASKET_BUTTON = '<?=$buttonText?>';
        })
    <?else:?>
        $('.product-info-option .dropdown-pane').foundation();
        updateAdd2Basket();
        updateAdd2Liked();
        updateAdd2Compare();
        initOwl();
        initTimer();
        initProductPreviewZoom();
    <?endif;?>
</script>
<?if ($arParams["REQUEST_LOAD"] != "Y"):?>
        </article>
        <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
            if ($arResult['OFFER_GROUP']) {
                foreach ($arResult['OFFER_GROUP_VALUES'] as $offerID) {?>
                    <span id="<? echo $arItemIDs['OFFER_GROUP'].$offerID; ?>" class="set_group_block" style="display: none;">
                    <?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
                        "",
                        array(
                            "IBLOCK_ID" => $arResult["OFFERS_IBLOCK"],
                            "ELEMENT_ID" => $offerID,
                            "PRICE_CODE" => $arParams["PRICE_CODE"],
                            "BASKET_URL" => $arParams["BASKET_URL"],
                            "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                            "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                            "CACHE_TIME" => $arParams["CACHE_TIME"],
                            "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                            "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME'],
                            "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                            "CURRENCY_ID" => $arParams["CURRENCY_ID"]
                        ),
                        $component,
                        array("HIDE_ICONS" => "Y")
                    );?>
                    </span>
                <?}
            }
        } else {
            if ($arResult['MODULES']['catalog'] && $arResult['OFFER_GROUP']) {?>
                <span class="set_group_block">
                <?$APPLICATION->IncludeComponent("bitrix:catalog.set.constructor",
                    "",
                    array(
                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                        "ELEMENT_ID" => $arResult["ID"],
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "BASKET_URL" => $arParams["BASKET_URL"],
                        "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                        "CACHE_TIME" => $arParams["CACHE_TIME"],
                        "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                        "TEMPLATE_THEME" => $arParams['~TEMPLATE_THEME'],
                        "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"]
                    ),
                    $component,
                    array("HIDE_ICONS" => "Y")
                );?>
                </span>
            <?}
        }?>
        <?if ($arParams['SHOW_PRODUCT_SET'] == 'Y' && $arResult['MODULES']['catalog'] && $arResult['PRODUCT_SET']):?>
            <?$APPLICATION->IncludeComponent("bitlate:catalog.product.set",
                "",
                array(
                    "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                    "ELEMENT_ID" => $arResult["ID"],
                    "ELEMENT_TYPE" => $arResult["PRODUCT"]["TYPE"],
                    "CACHE_TYPE" => $arParams["CACHE_TYPE"],
                    "CACHE_TIME" => $arParams["CACHE_TIME"],
                    "CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
                ),
                $component
            );?>
        <?endif;?>
    </div>
</div>
<?$countTabs = 0;
$isFirst = false;
$isParams = false;
foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty) {
    if (in_array($arProperty['ID'], $arResult['SHOWED_PROPERTIES']) && $arProperty['ACTIVE'] == 'Y') {
        $isParams = true;
        break;
    }
    if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS']) && $arResult['SHOW_OFFERS_PROPS']) {
        foreach ($arResult['OFFERS'] as $arOneOffer) {
            if (!empty($arOneOffer['DISPLAY_PROPERTIES'])) {
                $isParams = true;
                break;
            }
        }
    }
}
//TODO ?????????????? ?????? ???????????????????? ??????????????
    $isAmount = false;
    $isParams = false;
    $countTabs = false;

if ($isParams) {
    $countTabs++;
}
$isComments = ($arParams['USE_COMMENTS'] === 'Y');
if ($isComments) {
    $countTabs++;
}
$isAmount = ($arParams["USE_STORE"] == "Y" && count($arParams['STORES']) > 0 && \Bitrix\Main\ModuleManager::isModuleInstalled("catalog"));
if ($isAmount) {
    $countTabs++;
}
?>
<div class="product-accordion-tabs">
    <div class="advanced-container-medium">
        <ul class="tabs row large-up-<?=$countTabs?> show-for-xlarge" id="product-accordion-tabs" data-tabs>
            <?if ($isParams):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>
                <li class="column tabs-title<?=$activeClass?>"><a href="#product-tab-2"><?=getMessage('CT_BCE_CATALOG_PARAMS')?></a></li>
            <?endif;?>
            <?if ($isComments):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>
                <li class="column tabs-title<?=$activeClass?>"><a href="#product-tab-3"><?=getMessage('CT_BCE_CATALOG_REVIEWS')?></a></li>
            <?endif;?>
            <?if ($isAmount):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>
                <li class="column tabs-title"><a href="#product-tab-4"><?=getMessage('CT_BCE_CATALOG_AMOUNT')?></a></li>
            <?endif;?>
        </ul>
        <?$isFirst = false;?>
        <ul class="product-accordion-tabs-content accordion" data-accordion data-tabs-content="product-accordion-tabs" role="tablist">
            <?if ($isParams):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>
                <li class="product-accordion-tabs-item accordion-item<?=$activeClass?>" id="product-tab-2">
                    <a href="#" class="accordion-title hide-for-xlarge" role="tab"><?=getMessage('CT_BCE_CATALOG_PARAMS')?></a>
                    <div class="product-accordion-tabs-wrap accordion-content product-specification" data-tab-content role="tabpanel">
                        <?if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])):
                            foreach ($arResult['OFFERS'] as $key => $arOneOffer):
                                $strVisible = ($key == $arResult['OFFERS_SELECTED'] ? '' : 'none');?>
                                <table id="<? echo $arItemIDs['PROP_TABLE'].$arOneOffer['ID'] ?>" style="display: <? echo $strVisible; ?>;">
                                    <?foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty):
                                        if (in_array($arProperty['ID'], $arResult['SHOWED_PROPERTIES']) && $arProperty['ACTIVE'] == 'Y'):
                                            $pValue = (is_array($arProperty['DISPLAY_VALUE']) ? implode(' / ', $arProperty['DISPLAY_VALUE']) : $arProperty['DISPLAY_VALUE']);?>
                                            <tr><td><?=$arProperty['NAME']?></td><td><?=$pValue?></td></tr>
                                        <?endif;
                                    endforeach;?>
                                    <?if (!empty($arOneOffer['DISPLAY_PROPERTIES'])):
                                        foreach ($arOneOffer['DISPLAY_PROPERTIES'] as $arOneProp):
                                            $pValue = (is_array($arOneProp['DISPLAY_VALUE']) ? implode(' / ', $arOneProp['DISPLAY_VALUE']) : $arOneProp['DISPLAY_VALUE']);?>
                                            <tr><td><?=$arOneProp['NAME']?></td><td><?=$pValue?></td></tr>
                                        <?endforeach;
                                    endif;?>
                                </table>
                            <?endforeach;?>
                        <?else:?>
                            <table>
                                <?foreach ($arResult['DISPLAY_PROPERTIES'] as $arProperty):
                                    if (in_array($arProperty['ID'], $arResult['SHOWED_PROPERTIES']) && $arProperty['ACTIVE'] == 'Y'):
                                        $pValue = (is_array($arProperty['DISPLAY_VALUE']) ? implode(' / ', $arProperty['DISPLAY_VALUE']) : $arProperty['DISPLAY_VALUE']);?>
                                        <tr><td><?=$arProperty['NAME']?></td><td><?=$pValue?></td></tr>
                                    <?endif;
                                endforeach;?>
                            </table>
                        <?endif;?>
                    </div>
                </li>
            <?endif;?>
            <? if ($isComments):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>
                <li class="product-accordion-tabs-item accordion-item<?=$activeClass?>" id="product-tab-3">
                    <a href="#" class="accordion-title hide-for-xlarge" role="tab"><?=getMessage('CT_BCE_CATALOG_REVIEWS')?></a>
                    <div class="product-accordion-tabs-wrap product-comments" data-tab-content role="tabpanel">
                    </div>
                </li>
            <?endif;?>
            <?if ($isAmount):
                $activeClass = (!$isFirst) ? ' is-active' : '';
                $isFirst = true;?>

            <?endif;?>
        </ul>
    </div>
</div>

<div class="b-reviews" style="display: none">
    <div class="content-reviews advanced-container-medium">
        <span class="review-title">????????????</span>

        <div class="product-accordion-tabs-wrap product-comments" data-tab-content role="tabpanel" id="bx-comments-blg_<?=$arResult['ID']?>">
        </div>
    </div>
</div>

<div class="b-hidden-store-amount" style="display:none;">
    <li class="product-accordion-tabs-item accordion-item" id="product-tab-4">
        <a href="#" class="accordion-title hide-for-xlarge" role="tab"><?=getMessage('CT_BCE_CATALOG_AMOUNT')?></a>
        <div class="product-accordion-tabs-wrap accordion-content b-content-store-amount" data-tab-content role="tabpanel">
            <?$APPLICATION->IncludeComponent("bitrix:catalog.store.amount", ".default", array(
                "ELEMENT_ID" => $arResult['ID'],
                "STORE_PATH" => $arParams['STORE_PATH'],
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "36000",
                "MAIN_TITLE" => $arParams['MAIN_TITLE'],
                "USE_MIN_AMOUNT" => "N",
                "REAL_USE_MIN_AMOUNT" => $arParams['USE_MIN_AMOUNT'],
                "MIN_AMOUNT" => $arParams['MIN_AMOUNT'],
                "MAX_AMOUNT" => $arParams['MAX_AMOUNT'],
                "STORES" => $arParams['STORES'],
                "SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
                "SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
                "MESS_GENERAL_STORE" => $arParams['MESS_GENERAL_STORE'],
                "USER_FIELDS" => $arParams['USER_FIELDS'],
                "FIELDS" => $arParams['FIELDS']
            ));?>
        </div>
    </li>
</div>
<?endif;?>

<div class="inner-container advanced-container-medium social-container">
    <div class="product-info product-info-noborder">
        <ul class="product-info-block product-info-social inline-block-container">
            <li class="inline-block-item social_title">
                ????????????????????
            </li>
            <li class="inline-block-item">
                <a href="ya-share2__item_service_facebook" target="_blank">
                    <svg class="icon icon-social-facebook"">
                    <use xlink:href="#svg-icon-social-facebook"></use>
                    </svg>
                </a>
            </li>
            <li class="inline-block-item">
                <a href="ya-share2__item_service_vkontakte" target="_blank">
                    <svg class="icon icon-social-vk">
                        <use xlink:href="#svg-icon-social-vk"></use>
                    </svg>
                </a>
            </li>
            <li class="inline-block-item">
                <a href="ya-share2__item_service_twitter" target="_blank">
                    <svg class="icon icon-social-twitter">
                        <use xlink:href="#svg-icon-social-twitter"></use>
                    </svg>
                </a>
            </li>
            <li class="inline-block-item">
                <a href="ya-share2__item_service_gplus" target="_blank">
                    <svg class="icon icon-social-google">
                        <use xlink:href="#svg-icon-social-google"></use>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="popup-fade">
    <div class="popup">
        <a class="popup-close" href="#">??????????????</a>
        <img class="img-size-chart" src="/sizechart.jpg">
    </div>
</div>