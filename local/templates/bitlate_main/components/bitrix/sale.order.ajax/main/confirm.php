<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<article id="order-complete" class="inner-container cart-container cart-container-pay">
	<?if (!empty($arResult["ORDER"])) {?>
		<div class="fancybox-icon float-center">
			<div class="fancybox-icon-check"></div>
		</div>
		<div class="text-center">
			<div class="cart-caption"><?=GetMessage("SOA_TEMPL_ORDER_SUC", Array("#ORDER_DATE#" => $arResult["ORDER"]["DATE_INSERT"], "#ORDER_ID#" => $arResult["ORDER"]["ACCOUNT_NUMBER"]))?></div>
			<div class="cart-caption-desc"><?=GetMessage("SOA_TEMPL_ORDER_SUC1", Array("#LINK#" => $arParams["PATH_TO_PERSONAL"])) ?></div>
		</div>
		<?if ($arResult["ORDER"]["IS_ALLOW_PAY"] === 'Y') {
			if (!empty($arResult["PAYMENT"])) {
				foreach ($arResult["PAYMENT"] as $payment) {
					if ($payment["PAID"] != 'Y') {
						if (!empty($arResult['PAY_SYSTEM_LIST'])
							&& array_key_exists($payment["PAY_SYSTEM_ID"], $arResult['PAY_SYSTEM_LIST'])
						) {
							$arPaySystem = $arResult['PAY_SYSTEM_LIST'][$payment["PAY_SYSTEM_ID"]];

							if (empty($arPaySystem["ERROR"])) {?>
								<div class="cart-content sale_order_full_table price">
									<div class="float-center large-7 xlarge-5">
										<div class="ps_logo text-center">
											<h2 class="pay_name"><?=GetMessage("SOA_TEMPL_PAY")?></h2>
											<?=CFile::ShowImage($arPaySystem["LOGOTIP"], 100, 100, "border=0", "", false);?>
											<p class="paysystem_name"><?=$arPaySystem["NAME"] ?></p>
										</div>
									</div>
									<div class="sale-paysystem-wrapper">
										<? if (strlen($arPaySystem["ACTION_FILE"]) > 0 && $arPaySystem["NEW_WINDOW"] == "Y" && $arPaySystem["IS_CASH"] != "Y"): ?>
											<?
											$orderAccountNumber = urlencode(urlencode($arResult["ORDER"]["ACCOUNT_NUMBER"]));
											$paymentAccountNumber = $payment["ACCOUNT_NUMBER"];
											?>
											<script>
												window.open('<?=$arParams["PATH_TO_PAYMENT"]?>?ORDER_ID=<?=$orderAccountNumber?>&PAYMENT_ID=<?=$paymentAccountNumber?>');
											</script>
										<?=GetMessage("SOA_TEMPL_PAY_LINK", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&PAYMENT_ID=".$paymentAccountNumber))?>
										<? if (CSalePdf::isPdfAvailable() && $arPaySystem['IS_AFFORD_PDF']): ?>
										<br/>
											<?=GetMessage("SOA_TEMPL_PAY_PDF", array("#LINK#" => $arParams["PATH_TO_PAYMENT"]."?ORDER_ID=".$orderAccountNumber."&pdf=1&DOWNLOAD=Y"))?>
										<? endif ?>
										<? else: ?>
											<?=$arPaySystem["BUFFERED_OUTPUT"]?>
										<? endif ?>
									</div>
								</div>
							<? } else {?>
								<div class="text-center">
									<div class="cart-caption-desc"><?=GetMessage("SOA_TEMPL_ORDER_PS_ERROR")?></div>
								</div>
							<?}
						} else {?>
							<div class="text-center">
								<div class="cart-caption-desc"><?=GetMessage("SOA_TEMPL_ORDER_PS_ERROR")?></div>
							</div>
						<?}
					}
				}
			}
		} else {?>
			<div class="text-center">
				<div class="cart-caption-desc"><?=$arParams['MESS_PAY_SYSTEM_PAYABLE_ERROR']?></div>
			</div>
		<?}
	} else {?>
		<div class="text-center">
			<div class="cart-caption"><?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST", Array("#ORDER_ID#" => $arResult["ACCOUNT_NUMBER"]))?></div>
			<div class="cart-caption-desc"><?=GetMessage("SOA_TEMPL_ERROR_ORDER_LOST1")?></div>
		</div>
	<?}?>
</article>
