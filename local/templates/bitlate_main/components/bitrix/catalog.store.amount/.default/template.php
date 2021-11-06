<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
CModule::IncludeModule('bitlate.apparelshop');
$isSku = (isset($arResult["IS_SKU"]) && $arResult["IS_SKU"] == 1);
$isEmpty = true;
$messGeneralStore = ($arParams['MESS_GENERAL_STORE'] != '') ? $arParams['MESS_GENERAL_STORE'] : GetMessage("BALANCE");
?>

<?if (!empty($arResult["STORES"])):?>
    <ul class="product-existence">
        <?foreach($arResult["STORES"] as $arProperty):
            if (isset($arProperty['REAL_AMOUNT']) && $arProperty['REAL_AMOUNT'] > 0) {
                $isEmpty = false;
            }?>
            <li class="row" style="display: <? echo ($arParams['SHOW_EMPTY_STORE'] == 'N' && isset($arProperty['REAL_AMOUNT']) && $arProperty['REAL_AMOUNT'] <= 0 ? 'none' : ''); ?>;">
                <div class="small-6 medium-9 columns">
                    <?if ($arParams['SHOW_GENERAL_STORE_INFORMATION'] == "Y"):?>
                        <?=$messGeneralStore?>
                    <?elseif (isset($arProperty["TITLE"])):
                        $arProperty["TITLE"] = str_replace('( )', '', $arProperty["TITLE"]);
                        ?>
                        <?=$arProperty["TITLE"]?><?if (isset($arProperty["PHONE"])):?><a href="tel:<?=$arProperty["PHONE"]?>" class="product-existence-phone"><?=GetMessage('S_PHONE')?> <?=$arProperty["PHONE"]?><?endif;?></a>
                    <?endif;?>
                </div>
                <?$amount = (isset($arProperty['REAL_AMOUNT'])) ? $arProperty['REAL_AMOUNT'] : $arProperty['AMOUNT'];
                $quantityInfo = NLApparelshopUtils::getProductAmount($amount, $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
                $quantityText = ($arParams['REAL_USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];?>
                <div class="small-6 medium-3 columns" id="<?=$arResult['JS']['ID']?>_<?=$arProperty['ID']?>">
                    <div class="existence <?=$quantityInfo['class']?> float-right" title="<?=$quantityText?>">
                        <div class="existence-icon">
                            <div class="existence-icon-active"></div>
                        </div>
                        <span class="existence-count"><?=$quantityText?></span>
                    </div>
                </div>
            </li>
        <?endforeach;?>
    </ul>
    <?if ($arParams['SHOW_EMPTY_STORE'] == 'N' && ($arParams['SHOW_GENERAL_STORE_INFORMATION'] == "N" || $isSku)):?>
        <ul class="product-existence" id="product-store-empty"<?if ($isSku || (!$isSku && !$isEmpty)):?> style="display: none;"<?endif;?>>
            <li class="row">
                <div class="small-6 medium-9 columns">
                    <?=$messGeneralStore?>
                </div>
                <?$amount = 0;
                $quantityInfo = NLApparelshopUtils::getProductAmount($amount, $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
                $quantityText = ($arParams['REAL_USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];?>
                <div class="small-6 medium-3 columns">
                    <div class="existence <?=$quantityInfo['class']?> float-right" title="<?=$quantityText?>">
                        <div class="existence-icon">
                            <div class="existence-icon-active"></div>
                        </div>
                        <span class="existence-count"><?=$quantityText?></span>
                    </div>
                </div>
            </li>
        </ul>
    <?endif;?>
<?endif;?>
<?if ($isSku):
    if (is_array($arResult['JS']['SKU'])) {
        foreach ($arResult['JS']['SKU'] as $offerId => $stores) {
            $arResult['JS']['SKU_MESS'][$offerId] = array();
            foreach ($stores as $storeId => $amount) {
                $quantityInfo = NLApparelshopUtils::getProductAmount(intval($amount), $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
                $quantityText = ($arParams['REAL_USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];
                $arResult['JS']['SKU_MESS'][$offerId][$storeId] = '<div class="existence ' . $quantityInfo['class'] . ' float-right" title="' . $quantityText . '"><div class="existence-icon"><div class="existence-icon-active"></div></div><span class="existence-count">' . $quantityText . '</span></div>';
            }
        }
    }
    $quantityInfo = NLApparelshopUtils::getProductAmount(0, $arParams['MIN_AMOUNT'], $arParams['MAX_AMOUNT']);
    $quantityText = ($arParams['REAL_USE_MIN_AMOUNT'] == "Y") ? $quantityInfo['text'] : $quantityInfo['products'];
    $arResult['JS']['MESSAGES']['ABSENT'] = '<div class="existence ' . $quantityInfo['class'] . ' float-right" title="' . $quantityText . '"><div class="existence-icon"><div class="existence-icon-active"></div></div><span class="existence-count">' . $quantityText . '</span></div>';
    ?>
    <script type="text/javascript">
        var obStoreAmount = new JCCatalogStoreSKU(<? echo CUtil::PhpToJSObject($arResult['JS'], false, true, true); ?>);
    </script>
<?endif;?>