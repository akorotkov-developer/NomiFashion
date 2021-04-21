<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$errorMessage = '';
if (is_array($arParams["~AUTH_RESULT"])) {
    $errorMessage = $arParams["~AUTH_RESULT"]["MESSAGE"];
} elseif ($arParams["~AUTH_RESULT"] != '') {
    $errorMessage = $arParams["~AUTH_RESULT"];
}
$userConsent = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_CHPASSWORD", "N", SITE_ID);
$userConsentId = intval(COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_CHPASSWORD_ID", "", SITE_ID));
$userConsentIsChecked = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_CHECKED", "N", SITE_ID);
$userConsentIsLoaded = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_LOADED", "N", SITE_ID);?>
<div id="forgot" class="fancybox-block">
    <div class="fancybox-block-caption"><?=GetMessage("AUTH_FORGOT_PASSWORD_1")?></div>
    <?if ($errorMessage != ''):?>
        <div class="callout text-center error" data-closable="" style="max-width: 320px;"><?=$errorMessage?></div>
    <?endif;?>
    <div class="fancybox-block-wrap">
        <script>
            $(document).ready(function() {
                initValidate("#forgot form");
            })
        </script>
        <form name="bform" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="forgot-form form" data-ajax="<?=SITE_DIR?>nl_ajax/forgotpasswd.php">
            <?
            if (strlen($arResult["BACKURL"]) > 0)
            {
            ?>
                <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?
            }
            ?>
            <input type="hidden" name="AUTH_FORM" value="Y">
            <input type="hidden" name="TYPE" value="SEND_PWD">
            <input type="hidden" name="USER_LOGIN" maxlength="50" value="" placeholder="<?=GetMessage("AUTH_LOGIN")?>" />
            <input type="text" name="USER_EMAIL" maxlength="255" placeholder="<?=GetMessage("AUTH_EMAIL")?>" />
            <input type="hidden" name="send_account_info" value="<?=GetMessage("AUTH_SEND")?>" />
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
                            "INPUT_NAME" => 'auth_forgotpasswd_user_consent',
                            "REPLACE" => array(
                                'button_caption' => GetMessage("AUTH_SEND"),
                                'fields' => array(GetMessage("AUTH_EMAIL")),
                            ),
                        )
                    );?>
                </fieldset>
            <?endif;?>
            <button type="submit" class="small-12 button small fancybox-button text-center"><?=GetMessage("AUTH_SEND")?></button>
        </form>
    </div>
</div>