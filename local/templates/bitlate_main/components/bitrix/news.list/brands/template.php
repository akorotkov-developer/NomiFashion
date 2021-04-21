<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
\CModule::IncludeModule('bitlate.apparelshop');?>
<?if (!empty($arResult['ITEMS'])):?>
    <div class="main-brand hide-for-small-only">
        <div class="container row">
            <h2 class="main-brand-caption"><?=$arParams['PAGER_TITLE']?></h2>
            <div class="main-brand-carousel owl-carousel is-lazy" data-slideout-ignore>
                <?foreach ($arResult['ITEMS'] as $index => $arItem):
                    $pic = false;
                    if (intval($arItem['PREVIEW_PICTURE'])) {
                        $pic = NLApparelshopUtils::getResizeImg($arItem['PREVIEW_PICTURE'], array('width' => 100, 'height' => 60));
                    }
                    if ($pic !== false):?>
                        <?
                        $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        ?>
                        <a class="item" href="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                            <img src="<?=NLApparelshopUtils::getLoadSrc($pic['src'])?>" data-src="<?=$pic['src']?>" alt="<?=$arItem['NAME']?>" class="<?=NLApparelshopUtils::getLoadOwlClass()?>">
                        </a>
                    <?endif;?>
                <?endforeach;?>
            </div>
        </div>
    </div>
<?endif;?>