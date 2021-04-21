<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc,
    Bitrix\Main\Page\Asset;

if (!$arResult["ID"]) {
    return false;
}
$paymentTitle = array();
if (is_array($arResult['PAYMENT'])) {
    foreach ($arResult['PAYMENT'] as $payment) {
        $paymentTitle[] = $payment['PAY_SYSTEM_NAME'];
    }
} elseif ($arResult["PAY_SYSTEM"]["NAME"]) {
    $paymentTitle[] = $arResult["PAY_SYSTEM"]["NAME"];
}
$paymentTitle = implode(', ', $paymentTitle);
?>
<?if(strlen($arResult["ERROR_MESSAGE"])):?>
	<?=ShowError($arResult["ERROR_MESSAGE"]);?>
<?else:?>
<div class="fancybox-block" style="display:block;">
    <div class="fancybox-block-caption"><?=str_replace("#ID#", $arResult["ID"], GetMessage("SPOD_ORDER"))?> <span><?=$arResult["DATE_INSERT_FORMATED"]?></span></div>
    <div class="fancybox-block-wrap fancybox-block-wrap-order">
        <div><strong><?=GetMessage("SPOD_ORDER_STATUS")?>:</strong> <?=$arResult["STATUS"]["NAME"]?></div>
        <div class="price-block"><strong><?=GetMessage("SPOD_ORDER_PRICE")?>:</strong> <?=$arResult["PRICE_FORMATED"]?></div>
        <div><strong><?=GetMessage("SPOD_ORDER_DELIVERY")?>:</strong> <?=$arResult["DELIVERY"]["NAME"]?></div>
        <div><strong><?=GetMessage("SPOD_PAY_SYSTEM")?>:</strong> <?=$paymentTitle?></div>
    </div>
    <div class="fancybox-block-wrap fancybox-block-wrap-product">
        <ul class="product-list-mini">
            <li><strong><?=GetMessage("SPOD_ORDER_BASKET")?></strong></li>
            <?foreach($arResult["BASKET"] as $prod):
                $hasLink = !empty($prod["DETAIL_PAGE_URL"]);?>
                <li>
                    <?if($hasLink):?>
                        <a href="<?=$prod["DETAIL_PAGE_URL"]?>" class="product-list-mini-link table-container" target="_blank">
                    <?endif?>
                    <div class="product-list-mini-preview table-item">
                        <?if($prod['PICTURE']['SRC']):?>
                            <img src="<?=$prod['PICTURE']['SRC']?>" alt="">

                        <?endif?>
                    </div>
                    <div class="table-item">
                        <span class="product-list-mini-desc"><?=$prod["NAME"]?></span>
                        <span class="product-list-mini-details">
                            <?=GetMessage("SPOD_QUANTITY")?>: <?=$prod["QUANTITY"]?><?=GetMessage("SPOD_DEFAULT_MEASURE")?>.<br>
                            <?if($arResult['HAS_PROPS']):
                                $actuallyHasProps = is_array($prod["PROPS"]) && !empty($prod["PROPS"]);
                                if($actuallyHasProps):?>
                                    <?foreach($prod["PROPS"] as $prop):?>
                                        <nobr><?=$prop["NAME"]?>:</nobr> <?=$prop["VALUE"]?><br>
                                    <?endforeach?>
                                <?endif?>
                            <?endif?>
                        </span>
                        <span class="product-list-mini-desc price-block"><?=CCurrencyLang::CurrencyFormat($prod["PRICE"] * $prod["QUANTITY"], $prod["CURRENCY"])?></span>
                    </div>
                    <?if($hasLink):?>
                        </a>
                    <?endif?>
                </li>
            <?endforeach;?>
        </ul>
    </div>
    <div class="fancybox-block-wrap cart-content">
        <?foreach ($arResult['PAYMENT'] as $payment):
            if (($payment["PAY_SYSTEM"]["PSA_ACTION_FILE"] || $payment['BUFFERED_OUTPUT']) && $payment['ACCOUNT_NUMBER']) {
                $isPaymentDetail = true;
            } elseif ($arResult["PAY_SYSTEM"]["NAME"] && file_exists($payment["PAY_SYSTEM"]["PSA_ACTION_FILE"]) && is_file($payment["PAY_SYSTEM"]["PSA_ACTION_FILE"])) {
                $isPaymentDetail = false;
            } else {
                $isPaymentDetail = false;
            }
            if (!$isPaymentDetail):?>
                <?if ($payment["CAN_REPAY"]=="Y"):?>
                    <div class="bx_payment_block">
                        <?if($payment["PAY_SYSTEM"]["PSA_NEW_WINDOW"] != "Y"):?>
                                <?
                                $ORDER_ID = $ID;

                                try
                                {
                                    include($payment["PAY_SYSTEM"]["PSA_ACTION_FILE"]);
                                }
                                catch(\Bitrix\Main\SystemException $e)
                                {
                                    if($e->getCode() == CSalePaySystemAction::GET_PARAM_VALUE)
                                        $message = GetMessage("SOA_TEMPL_ORDER_PS_ERROR");
                                    else
                                        $message = $e->getMessage();

                                    ShowError($message);
                                }
                                ?>
                                <script>
                                    $(".bx_payment_block input[type=submit]").addClass("button small");
                                </script>
                        <?endif?>
                        <?if($payment["PAY_SYSTEM"]["PSA_NEW_WINDOW"] == "Y"):?>
                            <a href="<?=$payment["PAY_SYSTEM"]["PSA_ACTION_FILE"]?>" class="button small" target="_blank"><?=GetMessage("SPOD_REPEAT_PAY")?></a>
                            <div class="clear-all"></div>
                        <?endif?>
                    </div>
                <?endif?>
            <?else:?>
                <div class="row sale-order-detail-payment-options-methods-information-block">
                    <img src="<?=htmlspecialcharsbx($payment['PAY_SYSTEM']["SRC_LOGOTIP"])?>" />
                    <p>
                        <?
                        $paymentData[$payment['ACCOUNT_NUMBER']] = array(
                            "payment" => $payment['ACCOUNT_NUMBER'],
                            "order" => $arResult['ACCOUNT_NUMBER'],
                            "allow_inner" => $arParams['ALLOW_INNER'],
                            "only_inner_full" => $arParams['ONLY_INNER_FULL']
                        );
                        $paymentSubTitle = Loc::getMessage('SPOD_TPL_BILL')." ".Loc::getMessage('SPOD_NUM_SIGN').$payment['ACCOUNT_NUMBER'];
                        if(isset($payment['DATE_BILL']))
                        {
                            $paymentSubTitle .= " ".Loc::getMessage('SPOD_FROM')." ".$payment['DATE_BILL']->format($arParams['ACTIVE_DATE_FORMAT']);
                        }
                        $paymentSubTitle .=",";
                        echo htmlspecialcharsbx($paymentSubTitle);
                        $status = '';
                        if ($payment['PAID'] === 'Y')
                        {
                            $status = Loc::getMessage('SPOD_PAYMENT_PAID');
                        }
                        elseif ($arResult['IS_ALLOW_PAY'] == 'N')
                        {
                            $status = Loc::getMessage('SPOD_TPL_RESTRICTED_PAID');
                        }
                        else
                        {
                            $status = Loc::getMessage('SPOD_PAYMENT_UNPAID');
                        }
                        ?>
                        <?=$payment['PAY_SYSTEM_NAME']?> (<?=$status?>)
                    </p>
                    <?
                    if ($arResult['IS_ALLOW_PAY'] === 'N' && $payment['PAID'] !== 'Y')
                    {
                        ?>
                        <div class="sale-order-detail-status-restricted-message-block">
                            <span class="sale-order-detail-status-restricted-message"><?=Loc::getMessage('SOPD_TPL_RESTRICTED_PAID_MESSAGE')?></span>
                        </div>
                        <?
                    }
                    ?>
                    <?
                    if ($payment['PAY_SYSTEM']["IS_CASH"] !== "Y")
                    {
                        if ($payment['PAY_SYSTEM']['PSA_NEW_WINDOW'] === 'Y' && $arResult["IS_ALLOW_PAY"] !== "N")
                        {
                            ?>
                            <a class="button small"
                               target="_blank"
                               href="<?=htmlspecialcharsbx($payment['PAY_SYSTEM']['PSA_ACTION_FILE'])?>">
                                <?= Loc::getMessage('SPOD_REPEAT_PAY') ?>
                            </a>
                            <?
                        }
                    }
                    ?>
                </div>
                <?
                if ($payment["PAID"] !== "Y"
                    && $payment['PAY_SYSTEM']["IS_CASH"] !== "Y"
                    && $payment['PAY_SYSTEM']['PSA_NEW_WINDOW'] !== 'Y'
                    && $arResult['CANCELED'] !== 'Y'
                    && $arResult["IS_ALLOW_PAY"] !== "N")
                {
                    ?>
                    <div class="row sale-order-detail-payment-options-methods-template col-md-12 col-sm-12 col-xs-12">
                        <span class="sale-paysystem-close active-button">
                            <span class="sale-paysystem-close-item sale-order-payment-cancel"></span><!--sale-paysystem-close-item-->
                        </span><!--sale-paysystem-close-->
                        <?=$payment['BUFFERED_OUTPUT']?>
                            <!--<a class="sale-order-payment-cancel">--><?//= Loc::getMessage('SPOD_CANCEL_PAY') ?><!--</a>-->
                    </div>
                    <?
                }
                ?>
                <?
                if ($arResult["CAN_CANCEL"] === "Y")
                {
                    ?>
                    <a href="<?=$arResult["URL_TO_CANCEL"]?>" class="button small order-cancel-button">
                        <?= Loc::getMessage('SPOD_ORDER_CANCEL') ?>
                    </a>
                    <script>
                        $(document).ready(function(){
                            $(".order-cancel-button").fancybox({
                                type: 'ajax',
                                href: "<?=SITE_DIR?>nl_ajax/history_order_cancel.php?ID=<?=$arResult["ID"]?>&CANCEL=Y",
                                padding: 0
                            });
                        });
                    </script>
                    <?
                }
                ?>
            <?endif?>
        <?endforeach;?>
    </div>
</div>
<?endif;?>
