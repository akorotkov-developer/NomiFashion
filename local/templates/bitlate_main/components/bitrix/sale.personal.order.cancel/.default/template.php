<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<div class="fancybox-block" style="display:block;">
	<div class="fancybox-block-caption"><?=str_replace("#ID#", $arResult["ID"], GetMessage("SALE_CANCEL_TITLE"))?> <span><?=$arResult["DATE_INSERT_FORMATED"]?></span></div>
	<div class="fancybox-block-wrap fancybox-block-wrap-order">
	<?if(strlen($arResult["ERROR_MESSAGE"])<=0):?>
		<form method="post" action="<?=POST_FORM_ACTION_URI?>" class="form" id="order-cancel">
			
			<input type="hidden" name="CANCEL" value="Y">
			<?=bitrix_sessid_post()?>
			<input type="hidden" name="ID" value="<?=$arResult["ID"]?>">
			
			<?=GetMessage("SALE_CANCEL_ORDER1") ?>
			
			<a href="<?=$arResult["URL_TO_DETAIL"]?>"><?=GetMessage("SALE_CANCEL_ORDER2")?> #<?=$arResult["ACCOUNT_NUMBER"]?></a>?
			<b><?= GetMessage("SALE_CANCEL_ORDER3") ?></b><br /><br />
			<?= GetMessage("SALE_CANCEL_ORDER4") ?>:<br />
			
			<textarea name="REASON_CANCELED"></textarea>
			<input type="submit" name="action" value="<?=GetMessage("SALE_CANCEL_ORDER_BTN") ?>" class="small-12 button small fancybox-button text-center">
			<div class="clearfix"></div>
		</form>
	<?else:?>
		<?=ShowError($arResult["ERROR_MESSAGE"]);?>
	<?endif;?>

	</div>
</div>