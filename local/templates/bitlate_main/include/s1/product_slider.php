<?global $arSliderFilter;
$arSliderFilter = $FILTER;
\Bitrix\Main\Loader::includeModule('bitlate.apparelshop');
$template = ($TITLE == 'set') ? 'set' : NLApparelshopUtils::getComponentTemplate('board');
$typePict = NLApparelshopUtils::getSkuPictType();
$useLazyLoad = NLApparelshopUtils::getUseLazyLoad();
$APPLICATION->IncludeComponent(
	"bitrix:catalog.section",
	$template,
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "4",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "active_from",
		"ELEMENT_SORT_ORDER2" => "asc",
		"PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "MANUFACTURE",
			2 => "WEIGHT",
			3 => "COUNTRY",
		),
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"SET_LAST_MODIFIED" => "N",
		"INCLUDE_SUBSECTIONS" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"FILTER_NAME" => "arSliderFilter",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "N",
		"MESSAGE_404" => "",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"DISPLAY_COMPARE" => "Y",
		"PAGE_ELEMENT_COUNT" => "10",
		"LINE_ELEMENT_COUNT" => "3",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_MULTY" => "Y",
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",

		"PRICE_VAT_INCLUDE" => "Y",
		"USE_PRODUCT_QUANTITY" => "Y",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PRODUCT_PROPERTIES" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "RAZMER_2",
			3 => "RAZMER_3",
			4 => "MANUFACTURE",
			5 => "RAZMER_4",
			6 => "RAZMER_5",
			7 => "RAZMER_6",
			8 => "RAZMER_7",
			9 => "RAZMER_8",
			10 => "RAZMER_9",
			11 => "RAZMER_10",
		),
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => $TITLE,
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "catalog",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",

		"OFFERS_CART_PROPERTIES" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"OFFERS_FIELD_CODE" => array(""),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "name",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFERS_LIMIT" => "0",

		"SECTION_ID" => ($SECTION > 0) ? $SECTION : "",
		"SECTION_CODE" => "",
		"SECTION_URL" => "/catalog/#SECTION_CODE#/",
		"DETAIL_URL" => "/catalog/#SECTION_CODE#/#ELEMENT_CODE#.html",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "",
		'HIDE_NOT_AVAILABLE' => "Y",
		'HIDE_NOT_AVAILABLE_OFFERS' => "Y",

		'LABEL_PROP' => "SALELEADER",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		'PRODUCT_DISPLAY_MODE' => "Y",

		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		'OFFER_TREE_PROPS' => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		'SHOW_DISCOUNT_PERCENT' => "N",
		"SHOW_OLD_PRICE" => "Y",
		"MESS_BTN_BUY" => "",
		'MESS_BTN_ADD_TO_BASKET' => "",

		'TEMPLATE_THEME' => "slider",
		"ADD_SECTIONS_CHAIN" => "N",
		'ADD_TO_BASKET_ACTION' => "ADD",
		'SHOW_CLOSE_POPUP' => "N",
		"COMPARE_PATH" => "/catalog/compare/",
		'SHOW_ALL_WO_SECTION' => 'Y',
		'SUB_SLIDER' => ($SUB_SLIDER == "Y") ? "Y" : "N",
		'SLIDER_ZINDEX' => (intval($SLIDER_ZINDEX) > 0) ? intval($SLIDER_ZINDEX) : "0",
		'REQUEST_LOAD' => 'N',
		"SKU_PICT_TYPE" => $typePict,
		"USE_LAZY_LOAD" => $useLazyLoad,
	),
	$component
);?>