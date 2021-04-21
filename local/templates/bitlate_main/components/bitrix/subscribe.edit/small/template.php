<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$userConsent = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_SUBSCRIBE", "N", SITE_ID);
$userConsentId = intval(COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_SUBSCRIBE_ID", "", SITE_ID));
$userConsentIsChecked = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_CHECKED", "N", SITE_ID);
$userConsentIsLoaded = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_LOADED", "N", SITE_ID);?>
<div class="footer-subscribe" data-ajax="<?=SITE_DIR?>nl_ajax/subscribe_small.php">
    <script>
        $(document).ready(function(){
            initValidate("#form_subscr_footer");
        })
    </script>
    <form action="<?=$arParams['FORM_ACTION']?>" method="post" id="form_subscr_footer" class="footer-line-top-subscribe">
        <div class="footer-line-top-caption"><?=GetMessage("CT_BSE_SUBSCRIPTION_FORM_TITLE")?></div>
        <div class="inline-block-container">
            <?echo bitrix_sessid_post();?>
            <?if (count($arResult["RUBRICS"]) == 0):?>
                <input type="hidden" name="RUB_ID[]" value="0" />
            <?else:?>
                <?foreach($arResult["RUBRICS"] as $itemID => $itemValue):?>
                    <input type="hidden" name="RUB_ID[]" value="<?=$itemValue["ID"]?>" />
                <?endforeach;?>
            <?endif;?>
            <input type="hidden" name="ID" value="<?echo $arResult["SUBSCRIPTION"]["ID"];?>" />
            <input type="hidden" name="type" value="footer" />
            <?if($arResult["ID"] > 0 && $arResult["SUBSCRIPTION"]["ACTIVE"] != "Y"):?>
                <input type="hidden" name="action" value="activate" />
                <input id="subscribe-submit-btn-small" style="display:none" type="submit" name="activate" value="<?echo GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION")?>">
            <?else:?>
                <input type="hidden" name="PostAction" value="<?echo ($arResult["ID"]>0? "Update":"Add")?>" />
                <input id="subscribe-submit-btn-small" type="hidden" name="Save" value="<?echo GetMessage("CT_BSE_BTN_SEND")?>" />
            <?endif;?>
            <?$value = GetMessage("CT_BSE_EMAIL_PLACEHOLDER");
            if (count($arResult['ERROR']) > 0) {
                $value = strip_tags(implode('; ', $arResult['ERROR']));
            }
            if (count($arResult['MESSAGE']) > 0) {
                $value = strip_tags(implode('; ', $arResult['MESSAGE']));
            }?>
            <input type="text" placeholder="<?echo $value?>" class="inline-block-item hollow" name="EMAIL" value="" />
            <button type="submit" class="button small inline-block-item"><?echo GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION")?></button>
            <?if ($userConsent == "Y" && $userConsentId > 0):?>
                <fieldset class="block-main-user-consent-request checkbox-accept column">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.userconsent.request",
                        "",
                        array(
                            "ID" => $userConsentId,
                            "IS_CHECKED" => $userConsentIsChecked,
                            "AUTO_SAVE" => "Y",
                            "IS_LOADED" => $userConsentIsLoaded,
                            "INPUT_NAME" => 'subscribe_edit_small_user_consent',
                            "REPLACE" => array(
                                'button_caption' => GetMessage("CT_BSE_BTN_ADD_SUBSCRIPTION"),
                                'fields' => array(GetMessage("CT_BSE_EMAIL_PLACEHOLDER")),
                            ),
                        )
                    );?>
                </fieldset>
            <?endif;?>
        </div>
    </form>
</div>