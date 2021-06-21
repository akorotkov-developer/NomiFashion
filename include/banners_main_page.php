<?php
$iIblockId = 16;

CModule::IncludeModule('iblock');

$rs = CIBlockElement::GetList(
    [],
    [
        'IBLOCK_ID' => $iIblockId,
        'ACTIVE' => 'Y'
    ],
    false,
    false,
    ['ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_URL']
);

$arBanners = [];
while($ar = $rs->Fetch()) {
    $arBanners[] = $ar;
}
?>

<div class="b-banner-inside-product">
    <?php foreach ($arBanners as $bannerItem) {?>
        <div class="b-banner-inside-product_item">
            <a href="<?= $bannerItem['PROPERTY_URL_VALUE']?>">
                <img src="<?= CFile::GetPath($bannerItem['PREVIEW_PICTURE']);?>">
            </a>
        </div>
    <?php }?>
</div>