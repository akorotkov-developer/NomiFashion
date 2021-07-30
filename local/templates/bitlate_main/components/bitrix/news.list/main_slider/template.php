<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?if (!empty($arResult['ITEMS'])):?>
    <div class="owl-carousel main-slider">
        <?foreach ($arResult['ITEMS'] as  $arItem):
            if (intval($arItem['PREVIEW_PICTURE'])):
                $pic = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width' => 1900, 'height' => 574), BX_RESIZE_IMAGE_EXACT, true);
                $detailUrl = $arResult['RELATED_ITEMS'][$arItem['PROPERTIES']['RELATED_ITEM']['VALUE']]['DETAIL_PAGE_URL'];
                $blockSelector = ($detailUrl) ? 'a' : 'div';?>
                <?
                $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                ?>
                <div class="item vertical-middle" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                    <?php if ($arItem['PROPERTIES']['BANNER_LINK']['VALUE']) { ?>
                        <a href="<?= $arItem['PROPERTIES']['BANNER_LINK']['VALUE']?>">
                    <?php } ?>
                        <<?=$blockSelector?><?if ($detailUrl):?> href="<?=$detailUrl?>"<?endif;?> class="background sdfsdfds <?=($arItem['PROPERTIES']['STYLE']['VALUE_XML_ID'] == 'white') ? 'white' : 'black'?>" style="background-image:url(<?=$pic['src']?>);">
                            <span class="container row">
                                <span class="main-slider-caption <?php if ($arItem['PROPERTIES']['HIDE_TITLE_DESKTOP']['VALUE'] != '') { echo 'displaynone';}?>">
                                    <?=$arItem['~NAME']?>
                                </span>
                                <span class="main-slider-desc"><?=$arItem['PREVIEW_TEXT']?></span>
                                <?if ($detailUrl):?>
                                    <span class="button hide-for-small-only"><?=GetMessage("MORE")?></span>
                                <?endif;?>
                            </span>
                        </<?=$blockSelector?>>
                    <?php if ($arItem['PROPERTIES']['BANNER_LINK']['VALUE']) { ?>
                        </a>
                    <?php } ?>
                </div>
            <?endif;
        endforeach;?>
    </div>

    <div class="owl-carousel main-slider-mobile">
        <?php foreach ($arResult['ITEMS'] as $i => $arItem) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

            $picMobile = CFile::ResizeImageGet($arItem['PROPERTIES']['IMAGE_BANNER_MOBILE']['VALUE'], array('height' => 450), BX_RESIZE_IMAGE_PROPORTIONAL, true);
            ?>
            <div class="item vertical-middle b-mobile-banner-content" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <div class="background b-inner-content-mobile-banner" style="background-image:url(<?=$picMobile['src']?>); background-size: cover;
                        background-repeat: no-repeat;">
                    <span class="container row">
                        <span class="main-slider-caption <?php if ($arItem['PROPERTIES']['HIDE_TITLE_MOBILE']['VALUE'] != '') { echo 'displaynone';}?>"
                              <?php if ($arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['~VALUE'] != '') {?>style="color: <?= $arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE']?>"<?php }?>>
                            <?=$arItem['PROPERTIES']['TITLE_MOBILE']['~VALUE']?>
                        </span>
                        <span class="main-slider-desc custom_border_<?= $i?>" <?php if ($arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE'] != '') {?>style="color: <?= $arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE']?>"<?php }?>>
                            <?=$arItem['PROPERTIES']['TEXT_BANNER_MOBILE']['~VALUE']['TEXT']?>
                        </span>
                        <?php if ($arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE'] != '') {?>
                            <style>
                                .main-slider-banner .custom_border_<?=$i?> .shop_now {
                                    border: 1px solid <?= $arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE']?>;
                                    color: <?= $arItem['PROPERTIES']['COLOR_TITLE_BANNER_MOBILE']['VALUE']?>
                                }
                            </style>
                        <?php }?>
                    </span>
                </div>
            </div>
        <?php }?>
    </div>
<?endif;?>