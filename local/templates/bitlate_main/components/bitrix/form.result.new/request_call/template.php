<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$userConsent = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_REQUEST_CALL", "N", SITE_ID);
$userConsentId = intval(COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_REQUEST_CALL_ID", "", SITE_ID));
$userConsentIsChecked = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_CHECKED", "N", SITE_ID);
$userConsentIsLoaded = COption::GetOptionString("bitlate.apparelshop", "NL_USER_CONSENT_IS_LOADED", "N", SITE_ID);
?>
<div id="request-callback" class="fancybox-block">
    <div class="fancybox-block-caption"><?=$arResult["FORM_TITLE"]?></div>
    <div class="fancybox-block-wrap">
        <?if ($arResult["isFormNote"] == "Y" && $arResult["FORM_NOTE"]):
            $message = COption::GetOptionString("bitlate.apparelshop", "NL_REQUEST_CALL_OKKADD_MESS", "", SITE_ID);?>
            <?=htmlspecialcharsbx($message)?>
        <?elseif ($arResult["isFormErrors"] == "Y" && $arResult["FORM_ERRORS"][0] != ""):?>
            <?=$arResult["FORM_ERRORS"][0]?>
        <?endif;?>
        <?if ($arResult["isFormNote"] != "Y")
        {
        ?>
            <?=str_replace('<form', '<form class="form fancybox-block-form" data-ajax="' . SITE_DIR . 'nl_ajax/request_call.php"', $arResult["FORM_HEADER"])?>
            <?
            $rules = '';
            $fields = array();
            $btnCaption = (strlen(trim($arResult["arForm"]["BUTTON"])) <= 0) ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"];
            foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion)
            {
                if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden')
                {
                    echo $arQuestion["HTML_CODE"];
                }
                else
                {?>
                    <?$class = array();
                    if (is_array($arResult["FORM_ERRORS"]) && array_key_exists($FIELD_SID, $arResult['FORM_ERRORS'])) {
                        $class[] = "error";
                    }
                    if (strpos(strtolower($FIELD_SID), 'phone') !== false) {
                        $class[] = "phone";
                    }
                    $fields[] = $arQuestion["CAPTION"];?>
                    <?=$arQuestion["IS_INPUT_CAPTION_IMAGE"] == "Y" ? "<br />".$arQuestion["IMAGE"]["HTML_CODE"] : ""?>
                    <?if ($arResult["arQuestions"][$FIELD_SID]["TITLE_TYPE"] == "text"):
                        $inputName = "form_text_{$arResult["arQuestions"][$FIELD_SID]["ID"]}";
                        $isRequired = ($arQuestion["REQUIRED"] == "Y") ? true : false;
                        if ($isRequired) {
                            $rules .= $inputName . ': {required: true}, ';
                        }?>
                        <input type="text" class="<?=implode(' ', $class)?>" name="<?=$inputName?>" placeholder="<?=$arQuestion["CAPTION"]?>" value="<?=htmlspecialcharsbx($arResult["arrVALUES"][$inputName])?>" />
                    <?else:?>
                        <?=$arQuestion["HTML_CODE"]?></td>
                    <?endif;?>
            <?
                }
            } //endwhile
            ?>
            <?
            if($arResult["isUseCaptcha"] == "Y")
            {
            ?>
                <div class="table-container captha-block">
                    <div class="table-item vertical-top">
                        <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" />
                        <input type="text" name="captcha_word" size="30" maxlength="50" value="" placeholder="<?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?>">
                    </div>
                    <div class="table-item vertical-top text-right captha"><img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="115" height="45" class="photo"></div>
                </div>
            <?
            } // isUseCaptcha
            ?>
            <?if ($userConsent == "Y" && $userConsentId > 0):
                $rules .= 'request_callback_user_consent: {required: true}, ';?>
                <fieldset class="block-main-user-consent-request checkbox-accept column">
                    <?$APPLICATION->IncludeComponent(
                        "bitrix:main.userconsent.request",
                        "",
                        array(
                            "ID" => $userConsentId,
                            "IS_CHECKED" => $userConsentIsChecked,
                            "AUTO_SAVE" => "Y",
                            "IS_LOADED" => $userConsentIsLoaded,
                            "INPUT_NAME" => 'request_callback_user_consent',
                            "REPLACE" => array(
                                'button_caption' => $btnCaption,
                                'fields' => $fields,
                            ),
                        )
                    );?>
                </fieldset>
            <?endif;?>
            <?$rules = "{" . trim($rules, ', ') . "}";?>
            <script>
                $(document).ready(function(){
                    initValidateWithRules("#request-callback form", <?=$rules?>);
                })
            </script>
            <input type="hidden" name="web_form_submit" value="<?=htmlspecialcharsbx($btnCaption);?>" />
            <button <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" class="small-12 button small fancybox-button text-center"><?=htmlspecialcharsbx($btnCaption);?></button>
            <?=$arResult["FORM_FOOTER"]?>
        <?
        } //endif (isFormNote)
        ?>
    </div>
</div>