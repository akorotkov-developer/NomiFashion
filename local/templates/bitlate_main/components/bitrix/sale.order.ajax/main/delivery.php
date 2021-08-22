<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<script type="text/javascript">
	function fShowStore(id, showImages, formWidth, siteId)
	{
		var strUrl = '<?=$templateFolder?>' + '/map.php';
		var strUrlPost = 'delivery=' + id + '&showImages=' + showImages + '&siteId=' + siteId + '&formWidth=' + formWidth;

		var storeForm = new BX.CDialog({
					'title': '<?=GetMessage('SOA_ORDER_GIVE')?>',
					head: '',
					'content_url': strUrl,
					'content_post': strUrlPost,
					'width': formWidth,
					'height':450,
					'resizable':false,
					'draggable':false
				});

		var button = [
				{
					title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
					id: 'crmOk',
					'action': function ()
					{
						GetBuyerStore();
						BX.WindowManager.Get().Close();
					}
				},
				BX.CDialog.btnCancel
			];
		storeForm.ClearButtons();
		storeForm.SetButtons(button);
		storeForm.Show();
	}

	function GetBuyerStore()
	{
		BX('BUYER_STORE').value = BX('POPUP_STORE_ID').value;
		//BX('ORDER_DESCRIPTION').value = '<?=GetMessage("SOA_ORDER_GIVE_TITLE")?>: '+BX('POPUP_STORE_NAME').value;
		BX('store_desc').innerHTML = BX('POPUP_STORE_NAME').value;
		BX.show(BX('select_store'));
	}

	function showExtraParamsDialog(deliveryId)
	{
		var strUrl = '<?=$templateFolder?>' + '/delivery_extra_params.php';
		var formName = 'extra_params_form';
		var strUrlPost = 'deliveryId=' + deliveryId + '&formName=' + formName;

		if(window.BX.SaleDeliveryExtraParams)
		{
			for(var i in window.BX.SaleDeliveryExtraParams)
			{
				strUrlPost += '&'+encodeURI(i)+'='+encodeURI(window.BX.SaleDeliveryExtraParams[i]);
			}
		}

		var paramsDialog = new BX.CDialog({
			'title': '<?=GetMessage('SOA_ORDER_DELIVERY_EXTRA_PARAMS')?>',
			head: '',
			'content_url': strUrl,
			'content_post': strUrlPost,
			'width': 500,
			'height':200,
			'resizable':true,
			'draggable':false
		});

		var button = [
			{
				title: '<?=GetMessage('SOA_POPUP_SAVE')?>',
				id: 'saleDeliveryExtraParamsOk',
				'action': function ()
				{
					insertParamsToForm(deliveryId, formName);
					BX.WindowManager.Get().Close();
				}
			},
			BX.CDialog.btnCancel
		];

		paramsDialog.ClearButtons();
		paramsDialog.SetButtons(button);
		//paramsDialog.adjustSizeEx();
		paramsDialog.Show();
	}

	function insertParamsToForm(deliveryId, paramsFormName)
	{
		var orderForm = BX("ORDER_FORM"),
			paramsForm = BX(paramsFormName);
			wrapDivId = deliveryId + "_extra_params";

		var wrapDiv = BX(wrapDivId);
		window.BX.SaleDeliveryExtraParams = {};

		if(wrapDiv)
			wrapDiv.parentNode.removeChild(wrapDiv);

		wrapDiv = BX.create('div', {props: { id: wrapDivId}});

		for(var i = paramsForm.elements.length-1; i >= 0; i--)
		{
			var input = BX.create('input', {
				props: {
					type: 'hidden',
					name: 'DELIVERY_EXTRA['+deliveryId+']['+paramsForm.elements[i].name+']',
					value: paramsForm.elements[i].value
					}
				}
			);

			window.BX.SaleDeliveryExtraParams[paramsForm.elements[i].name] = paramsForm.elements[i].value;

			wrapDiv.appendChild(input);
		}

		orderForm.appendChild(wrapDiv);

		BX.onCustomEvent('onSaleDeliveryGetExtraParams',[window.BX.SaleDeliveryExtraParams]);
	}

	if(typeof submitForm === 'function')
		BX.addCustomEvent('onDeliveryExtraServiceValueChange', function(){
		    submitForm();
		});
</script>

<input type="hidden" name="BUYER_STORE" id="BUYER_STORE" value="<?=$arResult["BUYER_STORE"]?>" />
<?if(!empty($arResult["DELIVERY"])) {
    $width = ($arParams["SHOW_STORES_IMAGES"] == "Y") ? 850 : 700;?>
    <div class="cart-content" <?if ($curStep != 'delivery'):?> style="display:none;"<?endif;?>>
        <div class="float-center large-7 xlarge-6 relative">

            <div class="cart-content-counter show-for-large"><?=$iBlock?></div>
            <?$iBlock++;?>
            <fieldset class="radio">
                <legend><?=GetMessage("SOA_TEMPL_DELIVERY")?></legend>
                <?foreach ($arResult["DELIVERY"] as $delivery_id => $arDelivery) {
                    if($arDelivery["ISNEEDEXTRAINFO"] == "Y")
                        $extraParams = "showExtraParamsDialog('".$delivery_id."');";
                    else
                        $extraParams = "";

                    if (count($arDelivery["STORE"]) > 0)
                        $clickHandler = "onClick = \"fShowStore('".$arDelivery["ID"]."','".$arParams["SHOW_STORES_IMAGES"]."',$('#order_form_content').width(),'".SITE_ID."')\";";
                    else
                        $clickHandler = "onClick = \"BX('ID_DELIVERY_ID_".$arDelivery["ID"]."').checked=true;".$extraParams." submitForm();\"";
                    ?>

                    <?php if ($arDelivery["NAME"] == 'СДЭК (Доставка курьером)') {?>
                        <div class="info-tooltip-box">
                            <div class="info-tooltip-img">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                            d="M4.4443 18.3147C6.08879 19.4135 8.02219 20 10 20C12.6512 19.9968 15.1929 18.9422 17.0676 17.0676C18.9422 15.1929 19.9968 12.6512 20 10C20 8.02219 19.4135 6.08879 18.3147 4.4443C17.2159 2.79981 15.6541 1.51809 13.8268 0.761209C11.9996 0.00433284 9.98891 -0.193701 8.0491 0.192152C6.10929 0.578004 4.32746 1.53041 2.92894 2.92894C1.53041 4.32746 0.578004 6.10929 0.192152 8.0491C-0.193701 9.98891 0.00433284 11.9996 0.761209 13.8268C1.51809 15.6541 2.79981 17.2159 4.4443 18.3147Z"
                                            fill="#E1E1E3"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M9.45442 5.77197H10.9089V7.22649H9.45442V5.77197ZM10.909 9.40823V12.3173H12.3635V13.7718H8V12.3173H9.45451V9.40823H8V7.95372H10.909V8.68097V9.40823Z"
                                          fill="#2B2D33"/>
                                </svg>
                            </div>

                            <div class="info-tooltip-text">
                                <p>Доставка с примеркой. В случае выкупа хотя бы 1 позиции заказа доставка бесплатная.На примерку можно заказать до 6 изделий. Верхняя одежда до 4 изделий.Оплата заказа наличными или банковской картой курьеру. При полном отказе доставка оплачивается в размере 300 р. по Москве и 490 р. по России.</p>
                            </div>
                        </div>
                    <?php } ?>

                    <input type="radio"
                        id="ID_DELIVERY_ID_<?= $arDelivery["ID"] ?>"
                        name="<?=htmlspecialcharsbx($arDelivery["FIELD_NAME"])?>"
                        value="<?= $arDelivery["ID"] ?>"<?if ($arDelivery["CHECKED"]=="Y") echo " checked=\"checked\"";?>
                        class="show-for-sr"
                        onclick="submitForm();"
                        />

                    <label for="ID_DELIVERY_ID_<?=$arDelivery["ID"]?>" class="price-block" <?=$clickHandler?>>
                        <?=htmlspecialcharsbx($arDelivery["NAME"])?>
                        <?if(isset($arDelivery["PRICE"])) {?>
                             - <span class="secondary price">
                            <?if (isset($arDelivery['DELIVERY_DISCOUNT_PRICE'])):?>
                                <?echo ((strlen($arDelivery["DELIVERY_DISCOUNT_PRICE_FORMATED"]) > 0) ? (($arDelivery['DELIVERY_DISCOUNT_PRICE'] == 0) ? GetMessage('SALE_DELIV_PRICE_FREE') : $arDelivery["DELIVERY_DISCOUNT_PRICE_FORMATED"]) : number_format($arDelivery["DELIVERY_DISCOUNT_PRICE"], 2, ',', ' '));?>
                                </span> <span class="secondary discount price">(<?echo (strlen($arDelivery["PRICE_FORMATED"]) > 0 ? $arDelivery["PRICE_FORMATED"] : number_format($arDelivery["PRICE"], 2, ',', ' '));?>)
                            <?else:?>
                                <?echo ((strlen($arDelivery["PRICE_FORMATED"]) > 0) ? (($arDelivery["PRICE"] == 0) ? GetMessage('SALE_DELIV_PRICE_FREE') : $arDelivery["PRICE_FORMATED"]) : number_format($arDelivery["PRICE"], 2, ',', ' '));?>
                            <?endif;?>
                            </span>
                            <?if (strlen($arDelivery["PERIOD_TEXT"])>0) {
                                echo '&nbsp;<span>(' . trim($arDelivery["PERIOD_TEXT"]) . ')</span>';
                            }?>
                        <?}
                        elseif(isset($arDelivery["CALCULATE_ERRORS"]))
                        {
                            ShowError($arDelivery["CALCULATE_ERRORS"]);
                        }
                        else
                        {
                            $APPLICATION->IncludeComponent('bitrix:sale.ajax.delivery.calculator', '', array(
                                "NO_AJAX" => $arParams["DELIVERY_NO_AJAX"],
                                "DELIVERY_ID" => $delivery_id,
                                "ORDER_WEIGHT" => $arResult["ORDER_WEIGHT"],
                                "ORDER_PRICE" => $arResult["ORDER_PRICE"],
                                "LOCATION_TO" => $arResult["USER_VALS"]["DELIVERY_LOCATION"],
                                "LOCATION_ZIP" => $arResult["USER_VALS"]["DELIVERY_LOCATION_ZIP"],
                                "CURRENCY" => $arResult["BASE_LANG_CURRENCY"],
                                "ITEMS" => $arResult["BASKET_ITEMS"],
                                "EXTRA_PARAMS_CALLBACK" => $extraParams
                            ), null, array('HIDE_ICONS' => 'Y'));

                        }?>
                        <?if (count($arDelivery["STORE"]) > 0):?>
                            <p <?=$clickHandler?>><span id="select_store"<?if(strlen($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"]) <= 0) echo " style=\"display:none;\"";?>>
                                <span class="select_store"><?=GetMessage('SOA_ORDER_GIVE_TITLE');?>: </span>
                                <span class="ora-store" id="store_desc"><?=htmlspecialcharsbx($arResult["STORE_LIST"][$arResult["BUYER_STORE"]]["TITLE"])?></span>
                            </span></p>
                        <?endif;?>
                    </label>
                    <?php if ($arDelivery['NAME'] == 'СДЭК (Пункты выдачи заказов)') {?>
                        <div class="punkti_somovivoza" <?if ($arDelivery["CHECKED"]=="Y") {echo 'style="display: block"';}?>>
                            <span id="pvz" style="cursor:pointer; color: blue;"></span>
                        </div>
                    <?php }?>

                    <?if ($arDelivery['CHECKED'] == 'Y'):?>
                        <table class="delivery_extra_services">
                            <?php
                            $isY = 'Y';
                            foreach ($arDelivery['EXTRA_SERVICES'] as $extraServiceId => $extraService):
                                if ($isY == 'Y') {
                                    $isY = 'N';
                                } else {
                                    $isY = 'Y';
                                }
                                ?>
                                <?if(!$extraService->canUserEditValue()) continue;?>
                                <tr>
                                    <td class="control store_controls">
                                        <fieldset class="radio radio_store">
                                            <input type="hidden" name="DELIVERY_EXTRA_SERVICES[<?= $arDelivery['ID']?>][<?= $extraServiceId?>]" value="<?= $isY?>">

                                            <input type="radio"
                                                   <?php if ($extraService->getDisplayValue() == 'Да') {echo 'checked="checked"';}?>

                                                   id="store_DELIVERY_EXTRA_SERVICES_<?= $extraServiceId?>"
                                                   name="DELIVERY_EXTRA_SERVICES[<?= $arDelivery['ID']?>][<?= $extraServiceId?>]"
                                                   value="<?= $isY?>"
                                                   class="show-for-sr"
                                            />
                                            <label for="store_DELIVERY_EXTRA_SERVICES_<?= $extraServiceId?>" class="price-block b-l-store" onclick="$(this).siblings('input[type=checkbox]').trigger('click'); setStoresRadioVals('<?= $extraServiceId?>');">
                                                <?=$extraService->getName()?>
                                            </label>

                                            <?= $extraService->getEditControl('DELIVERY_EXTRA_SERVICES['.$arDelivery['ID'].']['.$extraServiceId.']') ?>
                                        </fieldset>
                                    </td>
                                    <td rowspan="2" class="price">
                                        <?if ($price = $extraService->getPrice()) {
                                            echo GetMessage('SOA_TEMPL_SUM_PRICE').': ';
                                            echo '<strong>'.SaleFormatCurrency($price, $arResult['BASE_LANG_CURRENCY']).'</strong>';
                                        }?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="description">
                                        <?=$extraService->getDescription()?>
                                    </td>
                                </tr>
                            <?endforeach?>
                        </table>
                    <?endif?>
                <?}?>
            </fieldset>
        </div>
    </div>
<?}?>

<script>
    function setStoresRadioVals(radioId) {
        var radioButtonId = '#store_DELIVERY_EXTRA_SERVICES_' + radioId;
        var isChecked;
        var checkBoxName;
        var sravCheckBoxName = 'DELIVERY_EXTRA_SERVICES[2][' + radioId + ']'

        if ($(radioButtonId).attr('checked') == 'checked') {
            isChecked = false;
        } else {
            isChecked = true;
        }

        if (isChecked) {
            $('.store_controls').find('input[type="checkbox"]').each(function (index, el) {
                if (checkBoxName != sravCheckBoxName) {
                    if ($(el).attr('checked') == 'checked') {
                        $(el).trigger('click');
                    }
                }
            });
        }
    }
</script>

