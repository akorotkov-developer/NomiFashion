<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

if (!empty($arResult)):
    $previousLevel = 0;?>
    <ul class="vertical menu" data-drilldown data-wrapper="" data-back-button="<li class='js-drilldown-back'><a href='javascript:;'><?=getMessage('BACK')?></a></li>">
        <?php

        $itemCount = 0;
        foreach ($arResult as $itemIdex => $arItem):
            $itemCount++;

            if ($arItem["DEPTH_LEVEL"] > 2) continue;?>
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>
            <?if ($arItem["IS_PARENT"] && $arItem["DEPTH_LEVEL"] < 2):?>
                <li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a href="<?=$arItem["LINK"]?>" rel="nofollow"><?=$arItem["TEXT"]?></a>
                    <ul class="menu vertical">
            <?else:?>
                <?if ($arItem["PERMISSION"] > "D"):?>
                    <?php
                    /**Ищем нет ли у пункта меню дочерних пунктов*/
                    $arChilds = [];
                    foreach ($arResult['TREE_CHILD'] as $arTreeItem) {
                        if ($arItem['LINK'] == $arTreeItem['LINK']) {
                            if (count($arTreeItem['CHILDS']) > 0) {
                                $arChilds = $arTreeItem['CHILDS'];
                            }
                        }
                    }

                    $liClass = '';
                    if (count($arChilds) > 0) {
                        $liClass .= ' is_arrow_for_open_child';
                    }

                    if ($arItem["SELECTED"]) {
                        $liClass .=  ' active';
                    }
                    ?>

                    <li class="<?= $liClass?>" data-subul="ul-<?= $itemCount?>">
                        <a href="<?=$arItem["LINK"]?>" rel="nofollow"><?=$arItem["TEXT"]?><span></span></a>
                    </li>

                    <?php
                    if (count($arChilds) > 0) {
                        echo '<ul class="child_menu_mobile" data-ul="ul-' . $itemCount . '">';

                        foreach ($arChilds as $childItem) {
                            if ($childItem['SELECTED']) {
                                $classActive = 'active';
                            } else {
                                $classActive = '';
                            }
                            echo '<li class="' . $classActive . '"><a href="' . $childItem['LINK'] . '">' . $childItem['TEXT'] . '</a></li>';
                        }

                        echo '</ul>';
                    }
                    ?>
                <?else:?>
                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                        <li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a href="" rel="nofollow" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                    <?else:?>
                        <li<?if ($arItem["SELECTED"]):?> class="active"<?endif?>><a href="" rel="nofollow" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
                    <?endif?>
                <?endif?>
            <?endif?>
            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>
        <?endforeach;?>
        <?if ($previousLevel > 1):?>
            <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
        <?endif?>
    </ul>
<?endif?>