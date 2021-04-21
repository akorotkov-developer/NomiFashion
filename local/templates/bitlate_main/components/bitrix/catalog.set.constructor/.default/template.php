<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
$curJsId = $this->randString();
\CModule::IncludeModule('bitlate.apparelshop');
?>
<div id="bx-set-const-<?=$curJsId?>" class="product-pack hide-for-small-only">
    <div class="product-pack-caption change">
        <h2 class="float-left"><?=GetMessage("CATALOG_SET_BUY_SET")?></h2>
        <a href="javascript:;" class="button tiny secondary float-right product-pack-get-variation show-for-xlarge"><?=GetMessage("CATALOG_SET_CONSTRUCT")?></a>
        <div class="clearfix"></div>
    </div>
    <div class="product-pack-caption apply">
        <strong class="product-pack-caption-label float-left"><?=GetMessage("CATALOG_SET_PRODUCT")?></strong>
        <strong><?=GetMessage("CATALOG_SET_ADD_PRODUCTS")?></strong>
        <a href="javascript:;" class="button tiny float-right product-pack-set-variation show-for-xlarge"><?=GetMessage("CATALOG_SET_DONE")?></a>
    </div>
    <div class="product-pack-wrap product-grid">
        <div class="item column text-center product-pack-main">
            <div class="product-pack-char right">+</div>
            <?$pic = false;
            if ($arResult["ELEMENT"]["PREVIEW_PICTURE"] > 0) {
                $pic = NLApparelshopUtils::getResizeImg($arResult["ELEMENT"]["PREVIEW_PICTURE"], array('width' => 170, 'height' => 150));
            } elseif ($arResult["ELEMENT"]["DETAIL_PICTURE"]['src']) {
                $pic['src'] = $arResult["ELEMENT"]["DETAIL_PICTURE"]["src"];
            }
            if ($pic === false) {
                $pic['src'] = SITE_TEMPLATE_PATH . "/images/no_photo.png";
            }?>
            <div class="img-wrap">
                <img src="<?=$pic['src']?>" class="thumbnail" alt="" id="thumb-product-pack-main-<?=$curJsId?>">
            </div>
            <div class="name">
                <a href="#"><span><?=$arResult["ELEMENT"]["NAME"]?></span></a>
            </div>
            <div class="price bx-added-item-new-price"><?=$arResult["ELEMENT"]["PRICE_PRINT_DISCOUNT_VALUE"]?><?if (!($arResult["ELEMENT"]["PRICE_VALUE"] == $arResult["ELEMENT"]["PRICE_DISCOUNT_VALUE"])):?><span class="old"><?=$arResult["ELEMENT"]["PRICE_PRINT_VALUE"]?></span><?endif?></div>
            <?if ($arResult["ELEMENT"]["BASKET_QUANTITY"] != 1):?>
                <div class="product-pack-count"><?=$arResult["ELEMENT"]["BASKET_QUANTITY"]; ?> <?=$arResult["ELEMENT"]["MEASURE"]["SYMBOL_RUS"]; ?></div>
            <?endif;?>
        </div>
        <div class="owl-carousel product-pack-carousel float-left" data-role="set-items">
            <?foreach($arResult["SET_ITEMS"]["DEFAULT"] as $key => $arItem):?>
                <div class="item column text-center"
                    data-id="<?=$arItem["ID"]?>"
                    data-img="<?=$arItem["DETAIL_PICTURE"]["src"]?>"
                    data-url="<?=$arItem["DETAIL_PAGE_URL"]?>"
                    data-name="<?=$arItem["NAME"]?>"
                    data-price="<?=$arItem["PRICE_DISCOUNT_VALUE"]?>"
                    data-print-price='<?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?>'
                    data-old-price="<?=$arItem["PRICE_VALUE"]?>"
                    data-print-old-price='<?=$arItem["PRICE_PRINT_VALUE"]?>'
                    data-diff-price="<?=$arItem["PRICE_DISCOUNT_DIFFERENCE_VALUE"]?>"
                    data-measure="<?=$arItem["MEASURE"]["SYMBOL_RUS"]; ?>"
                    data-quantity="<?=$arItem["BASKET_QUANTITY"]; ?>"
                >
                    <a href="javascript:;" class="product-pack-change remove" data-role="set-delete-btn"></a>
                    <div class="product-pack-char left show-for-large">+</div>
                    <?$pic = false;
                    if ($arItem["PREVIEW_PICTURE"] > 0) {
                        $pic = NLApparelshopUtils::getResizeImg($arItem["PREVIEW_PICTURE"], array('width' => 170, 'height' => 150));
                    } elseif ($arItem["DETAIL_PICTURE"]['src']) {
                        $pic['src'] = $arItem["DETAIL_PICTURE"]["src"];
                    }
                    if ($pic === false) {
                        $pic['src'] = SITE_TEMPLATE_PATH . "/images/no_photo.png";
                    }?>
                    <div class="img-wrap">
                        <img src="<?=$pic['src']?>" class="thumbnail" alt="">
                    </div>
                    <div class="name">
                        <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$arItem["NAME"]?></span></a>
                    </div>
                    <div class="price bx-added-item-new-price"><?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?><?if ($arItem["PRICE_VALUE"] != $arItem["PRICE_DISCOUNT_VALUE"]):?><span class="bx-added-item-old-price old"><?=$arItem["PRICE_PRINT_VALUE"]?></span><?endif?></div>
                    <?if ($arItem["BASKET_QUANTITY"] != 1):?>
                        <div class="product-pack-count"><?=$arItem["BASKET_QUANTITY"]; ?> <?=$arItem["MEASURE"]["SYMBOL_RUS"]; ?></div>
                    <?endif;?>
                </div>
            <?endforeach?>
        </div>
        <div class="item column product-pack-sum">
            <div class="product-pack-char left show-for-large">=</div>
            <div class="product-pack-sum-wrap table-container">
                <div class="table-item">
                    <div class="product-price">
                        <div class="main" data-role="set-price"><?=$arResult["SET_ITEMS"]["PRICE"]?></div>
                        <div class="old" data-role="set-old-price"><?if ($arResult["SET_ITEMS"]["OLD_PRICE"]):?><?=$arResult["SET_ITEMS"]["OLD_PRICE"] ?><?endif;?></div>
                        <div class="economy" data-role="set-diff-price"><?if ($arResult["SET_ITEMS"]["PRICE_DISCOUNT_DIFFERENCE"]):?><?=GetMessage("CATALOG_SET_DISCOUNT_DIFF")?> <span><?=$arResult["SET_ITEMS"]["PRICE_DISCOUNT_DIFFERENCE"] ?></span><?endif;?></div>
                    </div>
                    <a href="javascript:;" data-role="set-buy-btn" class="btn btn-add btn-sm button tiny" data-preview="#thumb-product-pack-main-<?=$curJsId?>"><?=GetMessage("CATALOG_SET_BUY")?></a>
                </div>
            </div>
        </div>
    </div>
    <div class="product-pack-variation">
        <div class="product-pack-caption pack">
            <strong><?=GetMessage("CATALOG_SET_POPUP_TITLE")?></strong><?=GetMessage("CATALOG_SET_POPUP_DESC")?>
        </div>
        <div class="owl-carousel product-carousel product-grid" data-role="set-other-items">
            <?$first = true;
            foreach($arResult["SET_ITEMS"]["OTHER"] as $key => $arItem):?>
            <div class="item column text-center bx-catalog-set-item-container-<?=$curJsId?>"
                data-id="<?=$arItem["ID"]?>"
                data-img="<?=$arItem["DETAIL_PICTURE"]["src"]?>"
                data-url="<?=$arItem["DETAIL_PAGE_URL"]?>"
                data-name="<?=$arItem["NAME"]?>"
                data-price="<?=$arItem["PRICE_DISCOUNT_VALUE"]?>"
                data-print-price='<?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?>'
                data-old-price="<?=$arItem["PRICE_VALUE"]?>"
                data-print-old-price='<?=$arItem["PRICE_PRINT_VALUE"]?>'
                data-diff-price="<?=$arItem["PRICE_DISCOUNT_DIFFERENCE_VALUE"]?>"
                data-measure="<?=$arItem["MEASURE"]["SYMBOL_RUS"]; ?>"
                data-quantity="<?=$arItem["BASKET_QUANTITY"]; ?>"<?
            if (!$arItem['CAN_BUY'] && $first)
            {
                echo 'data-not-avail="yes"';
                $first = false;
            }
            ?>
            >
                <a href="javascript:;" class="product-pack-change add" data-role="set-add-btn"></a>
                <div class="product-pack-char left show-for-large">+</div>
                <?$pic = false;
                if ($arItem["PREVIEW_PICTURE"] > 0) {
                    $pic = NLApparelshopUtils::getResizeImg($arItem["PREVIEW_PICTURE"], array('width' => 170, 'height' => 150));
                } elseif ($arItem["DETAIL_PICTURE"]['src']) {
                    $pic['src'] = $arItem["DETAIL_PICTURE"]["src"];
                }
                if ($pic === false) {
                    $pic['src'] = SITE_TEMPLATE_PATH . "/images/no_photo.png";
                }?>
                <div class="img-wrap">
                    <img src="<?=$pic['src']?>" class="thumbnail" alt="">
                </div>
                <div class="name">
                    <a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><span><?=$arItem["NAME"]?></span></a>
                </div>
                <div class="price"><?=$arItem["PRICE_PRINT_DISCOUNT_VALUE"]?><?if ($arItem["PRICE_VALUE"] != $arItem["PRICE_DISCOUNT_VALUE"]):?><span class="old"><?=$arItem["PRICE_PRINT_VALUE"]?></span><?endif?></div>
                <?if ($arItem["BASKET_QUANTITY"] != 1):?>
                    <div class="product-pack-count"><?=$arItem["BASKET_QUANTITY"]; ?> <?=$arItem["MEASURE"]["SYMBOL_RUS"]; ?></div>
                <?endif;?>
            </div>
            <?endforeach?>
        </div>
    </div>
    <div class="product-pack-mobile-button text-center hide-for-xlarge">
        <a href="javascript:;" class="button secondary product-pack-get-variation"><?=GetMessage("CATALOG_SET_POPUP_TITLE_BAR")?></a>
        <a href="javascript:;" class="button product-pack-set-variation"><?=GetMessage("CATALOG_SET_DONE")?></a>
    </div>
</div>
<?
$arJsParams = array(
	"numSliderItems" => count($arResult["SET_ITEMS"]["OTHER"]),
	"numSetItems" => count($arResult["SET_ITEMS"]["DEFAULT"]),
	"jsId" => $curJsId,
	"parentContId" => "bx-set-const-".$curJsId,
	"ajaxPath" => $this->GetFolder().'/ajax.php',
	"currency" => $arResult["ELEMENT"]["PRICE_CURRENCY"],
	"mainElementPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_VALUE"],
	"mainElementOldPrice" => $arResult["ELEMENT"]["PRICE_VALUE"],
	"mainElementDiffPrice" => $arResult["ELEMENT"]["PRICE_DISCOUNT_DIFFERENCE_VALUE"],
	"mainElementBasketQuantity" => $arResult["ELEMENT"]["BASKET_QUANTITY"],
	"lid" => SITE_ID,
	"iblockId" => $arParams["IBLOCK_ID"],
	"basketUrl" => $arParams["BASKET_URL"],
	"setIds" => $arResult["DEFAULT_SET_IDS"],
	"offersCartProps" => $arParams["OFFERS_CART_PROPERTIES"],
	"itemsRatio" => $arResult["BASKET_QUANTITY"],
	"noFotoSrc" => $this->GetFolder().'/images/no_foto.png',
	"messages" => array(
		"EMPTY_SET" => GetMessage('CT_BCE_CATALOG_MESS_EMPTY_SET'),
		"ADD_BUTTON" => GetMessage("CATALOG_SET_BUTTON_ADD"),
		"ECONOMY" => GetMessage("CATALOG_SET_DISCOUNT_DIFF")
	)
);
?>
<script type="text/javascript">
	BX.ready(function(){
		new BX.Catalog.SetConstructor(<?=CUtil::PhpToJSObject($arJsParams, false, true, true)?>);
	});
</script>