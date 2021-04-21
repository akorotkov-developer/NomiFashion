<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="cart-content" <?if ($curStep == 'delivery'):?> style="display:none;"<?endif;?>>
    <script type="text/javascript">
        function changePaySystem(param)
        {
            if (BX("account_only") && BX("account_only").value == 'Y') // PAY_CURRENT_ACCOUNT checkbox should act as radio
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = true;
                        $("#PAY_CURRENT_ACCOUNT_HIDDEN").val("Y")
                        BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                        $("#PAY_CURRENT_ACCOUNT").prop("checked", true);
                        $("#PAY_CURRENT_ACCOUNT").val("Y");
                        BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');

                        // deselect all other
                        var el = document.getElementsByName("PAY_SYSTEM_ID");
                        for(var i=0; i<el.length; i++)
                            el[i].checked = false;
                    }
                }
                else
                {
                    BX("PAY_CURRENT_ACCOUNT").checked = false;
                    $("#PAY_CURRENT_ACCOUNT_HIDDEN").val("N");
                    BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                    $("#PAY_CURRENT_ACCOUNT").prop("checked", false);
                    $("#PAY_CURRENT_ACCOUNT").val("N");
                    BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                }
            }
            else if (BX("account_only") && BX("account_only").value == 'N')
            {
                if (param == 'account')
                {
                    if (BX("PAY_CURRENT_ACCOUNT"))
                    {
                        BX("PAY_CURRENT_ACCOUNT").checked = !BX("PAY_CURRENT_ACCOUNT").checked;

                        if (BX("PAY_CURRENT_ACCOUNT").checked)
                        {
                            $("#PAY_CURRENT_ACCOUNT_HIDDEN").val("Y");
                            BX("PAY_CURRENT_ACCOUNT").setAttribute("checked", "checked");
                            $("#PAY_CURRENT_ACCOUNT").prop("checked", true);
                            $("#PAY_CURRENT_ACCOUNT").val("Y");
                            BX.addClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                        else
                        {
                            $("#PAY_CURRENT_ACCOUNT_HIDDEN").val("N");
                            BX("PAY_CURRENT_ACCOUNT").removeAttribute("checked");
                            $("#PAY_CURRENT_ACCOUNT").prop("checked", false);
                            $("#PAY_CURRENT_ACCOUNT").val("N");
                            BX.removeClass(BX("PAY_CURRENT_ACCOUNT_LABEL"), 'selected');
                        }
                    }
                }
            }

            submitForm();
        }
    </script>
    <?if (!empty($arResult["PAY_SYSTEM"]) && is_array($arResult["PAY_SYSTEM"]) || $arResult["PAY_FROM_ACCOUNT"] == "Y") {?>
        <fieldset class="radio float-center large-7 xlarge-5">
            <legend><?=GetMessage("SOA_TEMPL_PAY_SYSTEM")?></legend>
        </fieldset>
    <?}
        if ($arResult["PAY_FROM_ACCOUNT"] == "Y")
        {
            $accountOnly = ($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y") ? "Y" : "N";
            ?>
            <fieldset class="checkbox float-center large-7 xlarge-5">
                <input type="hidden" id="account_only" value="<?=$accountOnly?>" />
                <input type="hidden" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT_HIDDEN" value="N">
                <input type="checkbox" name="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT" class="show-for-sr" value="Y"<?if($arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y") echo " checked=\"checked\"";?>>
                <label for="PAY_CURRENT_ACCOUNT" id="PAY_CURRENT_ACCOUNT_LABEL" onclick="changePaySystem('account');" class="<?if($arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y") echo "selected"?>">
                    <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT")?>
                    <span class="desc">
                        <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT1")." <span class=\"secondary price-block\">".$arResult["CURRENT_BUDGET_FORMATED"]?></span><br />
                        <? if ($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y"):?>
                            <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT3")?>
                        <? else:?>
                            <?=GetMessage("SOA_TEMPL_PAY_ACCOUNT2")?>
                        <? endif;?>
                    </span>
                </label>
            </fieldset>
            <?
        }

        uasort($arResult["PAY_SYSTEM"], "cmpBySort"); // resort arrays according to SORT value?>
        <fieldset class="radio float-center large-7 xlarge-5">
        <?foreach($arResult["PAY_SYSTEM"] as $arPaySystem) {
            if (strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) > 0 || intval($arPaySystem["PRICE"]) > 0) {
                if (count($arResult["PAY_SYSTEM"]) == 1) {?>
                    <input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
                    <input type="radio"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        class="show-for-sr"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();"
                        />
                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
                        <?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
                            <?=$arPaySystem["PSA_NAME"];?>
                        <?endif;?>
                        <span class="desc">
                            <?if (intval($arPaySystem["PRICE"]) > 0)
                                echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
                            else
                                echo $arPaySystem["DESCRIPTION"];?>
                        </span>
                    </label>
                <?} else {?>
                    <input type="radio"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        class="show-for-sr"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();" />
                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
                        <?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
                            <?=$arPaySystem["PSA_NAME"];?>
                        <?endif;?>
                        <span class="desc">
                            <?if (intval($arPaySystem["PRICE"]) > 0)
                                echo str_replace("#PAYSYSTEM_PRICE#", SaleFormatCurrency(roundEx($arPaySystem["PRICE"], SALE_VALUE_PRECISION), $arResult["BASE_LANG_CURRENCY"]), GetMessage("SOA_TEMPL_PAYSYSTEM_PRICE"));
                            else
                                echo $arPaySystem["DESCRIPTION"];?>
                        </span>
                    </label>
                <?}
            }

            if (strlen(trim(str_replace("<br />", "", $arPaySystem["DESCRIPTION"]))) == 0 && intval($arPaySystem["PRICE"]) == 0) {
                if (count($arResult["PAY_SYSTEM"]) == 1) {?>
                    <input type="hidden" name="PAY_SYSTEM_ID" value="<?=$arPaySystem["ID"]?>">
                    <input type="radio"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        class="show-for-sr"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();"
                        />
                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
                        <?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
                            <?=$arPaySystem["PSA_NAME"];?>
                        <?endif;?>
                    </label>
                <?} else {?>
                    <input type="radio"
                        id="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>"
                        name="PAY_SYSTEM_ID"
                        value="<?=$arPaySystem["ID"]?>"
                        class="show-for-sr"
                        <?if ($arPaySystem["CHECKED"]=="Y" && !($arParams["ONLY_FULL_PAY_FROM_ACCOUNT"] == "Y" && $arResult["USER_VALS"]["PAY_CURRENT_ACCOUNT"]=="Y")) echo " checked=\"checked\"";?>
                        onclick="changePaySystem();" />

                    <label for="ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>" onclick="BX('ID_PAY_SYSTEM_ID_<?=$arPaySystem["ID"]?>').checked=true;changePaySystem();">
                        <?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
                            <?if ($arParams["SHOW_PAYMENT_SERVICES_NAMES"] != "N"):?>
                                <?=$arPaySystem["PSA_NAME"];?>
                            <?else:?>
                                <?="&nbsp;"?>
                            <?endif;?>
                        <?endif;?>
                    </label>
                <?}
            }
        }
        ?>
    <?if (!empty($arResult["PAY_SYSTEM"]) && is_array($arResult["PAY_SYSTEM"]) || $arResult["PAY_FROM_ACCOUNT"] == "Y") {?>
        </fieldset>
    <?}?>
</div>