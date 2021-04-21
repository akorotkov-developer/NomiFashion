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
        if ($isSubBreadcrumbs) {
            foreach ($arSectionsTree as $arSection) {
                if ($arSection['IBLOCK_SECTION_ID'] == $arSectionsTree[$link]['IBLOCK_SECTION_ID'] && $arSection['ID'] != $arSectionsTree[$link]['ID']) {
                    $subSections .= '<li><a href="' . $arSection['SECTION_PAGE_URL'] . '">' . $arSection['NAME'] . '</a></li>';
                }
            }
            if ($subSections != '') {
                $subSections = '<ul id="bx_sub_breadcrumb_' . md5($link) . '" class="menu vertical dropdown-pane product-breadcrumbs-dropdown" data-dropdown data-hover="true" data-hover-pane="true">' . $subSections . '</ul>';
            } else {
                $isSubBreadcrumbs = false;
            }
        }
        $strReturn .= '
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'"'. (($isSubBreadcrumbs) ? ' data-toggle="bx_sub_breadcrumb_' . md5($link) . '"' : '') . ' itemprop="item" itemscope itemtype="http://schema.org/Thing"><span itemprop="name">' . $title . '</span></a><meta itemprop="position" content="' . ($index + 1) . '">' . $subSections . '</li>';
    } else {
        $strReturn .= '
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span itemprop="item" itemscope itemtype="http://schema.org/Thing"><span itemprop="name">'.$title.'</span></span><meta itemprop="position" content="' . ($index + 1) . '"></li>';
    }
}

$strReturn .= '</ul>';

return $strReturn;