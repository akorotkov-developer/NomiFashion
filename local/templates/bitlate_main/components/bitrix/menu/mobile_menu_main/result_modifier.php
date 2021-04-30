<?php
if (!function_exists('buildMenuTree')) {
    //Меню ввиду многомерного массива
    function buildMenuTree(array $items, $depthLevel = 1)
    {
        $result = [];

        $offset = 0;
        $continueCount = 0;
        foreach ($items as $key => $item) {
            $offset++;
            if ($continueCount > 0) {
                $continueCount--;
                continue;
            }
            if ($item['IS_PARENT']) {
                $newItems = array_slice($items, $offset);
                $item['CHILDS'] = buildMenuTree($newItems, reset($newItems)['DEPTH_LEVEL']);
                $continueCount = count($item['CHILDS']);
            }
            if ($item['DEPTH_LEVEL'] < $depthLevel) {
                break;
            }
            $result[$key] = $item;
        }

        return $result;
    }
}

$arTree = buildMenuTree($arResult);
$arChildStore = [];
foreach ($arTree as $arItem) {
    if ($arItem['TEXT'] == 'Магазин') {
        $arChildStore = $arItem['CHILDS'];
    }
}
$arResult['TREE_CHILD'] = $arChildStore;

