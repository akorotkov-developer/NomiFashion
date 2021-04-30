<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */
global $APPLICATION;

//delayed function must return a string
if(empty($arResult))
    return "";

$strReturn = '';

$strReturn .= '<ul class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';
$arSectionsTree = array();
if (CModule::IncludeModule('bitlate.apparelshop')) {
    $arSectionsTree = NLApparelshopUtils::getSectionsTree(COption::GetOptionString("bitlate.apparelshop", "NL_CATALOG_ID", false, SITE_ID));
}

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++) {
    $title = htmlspecialcharsex($arResult[$index]["TITLE"]);

    if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1) {
        $link = $arResult[$index]["LINK"];
        $isSubBreadcrumbs = ($arSectionsTree[$link] != '') ? true : false;
        $subSections = "";

        $strReturn .= '
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="item" itemscope itemtype="http://schema.org/Thing"><span itemprop="name">' . $title . '</span></a><meta itemprop="position" content="' . ($index + 1) . '">' . $subSections . '</li>';
    } else {
        $strReturn .= '
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item" itemscope itemtype="http://schema.org/Thing"><span itemprop="name">'.$title.'</span></span><meta itemprop="position" content="' . ($index + 1) . '"></li>';
    }
}

$strReturn .= '</ul>';

return $strReturn;