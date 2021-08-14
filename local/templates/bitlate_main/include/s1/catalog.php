<?\Bitrix\Main\Loader::includeModule('bitlate.apparelshop');
$typePict = NLApparelshopUtils::getSkuPictType();
$useLazyLoad = NLApparelshopUtils::getUseLazyLoad();
$APPLICATION->IncludeComponent(
	"bitrix:catalog",
	".default",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_PICT_PROP" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"ALSO_BUY_ELEMENT_COUNT" => "5",
		"ALSO_BUY_MIN_BUYES" => "1",
		"BASKET_URL" => "/personal/cart/",
		"BIG_DATA_RCM_TYPE" => "bestsell",
		"CACHE_FILTER" => "Y",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"COMMON_ADD_TO_BASKET_ACTION" => "",
		"COMMON_SHOW_CLOSE_POPUP" => "N",
		"COMPARE_ELEMENT_SORT_FIELD" => "sort",
		"COMPARE_ELEMENT_SORT_ORDER" => "asc",
		"COMPARE_FIELD_CODE" => array("PREVIEW_PICTURE", "DETAIL_PICTURE"),
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"COMPARE_OFFERS_FIELD_CODE" => array(""),
		"COMPARE_OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"COMPARE_POSITION" => "top left",
		"COMPARE_POSITION_FIXED" => "Y",
		"COMPARE_PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "MANUFACTURE",
			2 => "WEIGHT",
			3 => "COUNTRY",
		),
		"COMPONENT_TEMPLATE" => ".default",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "",
		"DETAIL_ADD_DETAIL_TO_SLIDER" => "N",
		"DETAIL_ADD_TO_BASKET_ACTION" => array("ADD"),
		"DETAIL_BACKGROUND_IMAGE" => "-",
		"DETAIL_BLOG_USE" => "N",
		"DETAIL_BRAND_USE" => "N",
		"DETAIL_BROWSER_TITLE" => "TITLE",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"DETAIL_DETAIL_PICTURE_MODE" => "IMG",
		"DETAIL_DISPLAY_NAME" => "Y",
		"DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
		"DETAIL_FB_USE" => "N",
		"DETAIL_META_DESCRIPTION" => "META_DESCRIPTION",
		"DETAIL_META_KEYWORDS" => "KEYWORDS",
		"DETAIL_OFFERS_FIELD_CODE" => array(""),
		"DETAIL_OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "MANUFACTURE",
			2 => "WEIGHT",
			3 => "COUNTRY",
		),
		"DETAIL_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
		"DETAIL_SHOW_BASIS_PRICE" => "Y",
		"DETAIL_SHOW_MAX_QUANTITY" => "Y",
		"DETAIL_USE_COMMENTS" => "Y",
		"DETAIL_USE_VOTE_RATING" => "Y",
		"DETAIL_VK_USE" => "N",
		"DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_ELEMENT_SELECT_BOX" => "Y",
		"DISPLAY_TOP_PAGER" => "N",

		"FIELDS" => array(
			0 => "TITLE",
			1 => "ADDRESS",
			2 => "PHONE",
			3 => "",
		),
		"FILTER_FIELD_CODE" => array(""),
		"FILTER_NAME" => "",
		"FILTER_OFFERS_FIELD_CODE" => array(""),
		"FILTER_OFFERS_PROPERTY_CODE" => array(""),
		"FILTER_PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"FILTER_PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "MANUFACTURE",
			2 => "WEIGHT",
			3 => "COUNTRY",
		),
		"FILTER_VIEW_MODE" => "VERTICAL",
		"FORUM_ID" => "",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"IBLOCK_ID" => "4",
		"IBLOCK_TYPE" => "catalog",
		"INCLUDE_SUBSECTIONS" => "Y",
		"LABEL_PROP" => "SALELEADER",
		"LINE_ELEMENT_COUNT" => "3",
		"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
		"LINK_IBLOCK_ID" => "",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_PROPERTY_SID" => "",
		"LIST_BROWSER_TITLE" => "UF_BROWSER_TITLE",
		"LIST_META_DESCRIPTION" => "UF_META_DESCRIPTION",
		"LIST_META_KEYWORDS" => "UF_KEYWORDS",
		"LIST_SHOW_MAX_QUANTITY" => "Y",
		"LIST_OFFERS_FIELD_CODE" => array("", ""),
		"LIST_OFFERS_LIMIT" => "0",
		"LIST_OFFERS_PROPERTY_CODE" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "DOCS",
			1 => "MANUFACTURE",
			2 => "WEIGHT",
			3 => "COUNTRY",
		),
		"MESSAGES_PER_PAGE" => "5",
		"MESSAGE_404" => "Элемент не найден",
		"MESS_BTN_ADD_TO_BASKET" => "",
		"MESS_BTN_BUY" => "",
		"MESS_GENERAL_STORE" => "",
		"MIN_AMOUNT" => "10",
		"MAX_AMOUNT" => "20",
		"OFFERS_CART_PROPERTIES" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_FIELD2" => "name",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_ORDER2" => "asc",
		"OFFER_ADD_PICT_PROP" => "MORE_PHOTO",
		"OFFER_TREE_PROPS" => array(
			0 => "RAZMER",
			1 => "RAZMER_1",
			2 => "SIZES_SHOES",
			3 => "SIZES_CLOTHES",
		),
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "Y",
		"PAGER_TEMPLATE" => "catalog",
		"PAGE_ELEMENT_COUNT" => "15",
		"PARTIAL_PRODUCT_PROPERTIES" => "Y",
		"PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_MULTY" => "Y",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"PRODUCT_DISPLAY_MODE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
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
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"REVIEW_AJAX_POST" => "Y",
		"SECTIONS_SHOW_PARENT_NAME" => "Y",
		"SECTIONS_VIEW_MODE" => "LINE",
		"SECTION_ADD_TO_BASKET_ACTION" => "ADD",
		"SECTION_BACKGROUND_IMAGE" => "-",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SECTION_TOP_DEPTH" => "2",
		"SEF_FOLDER" => "/catalog/",
		"SEF_MODE" => "Y",
		"SEF_URL_TEMPLATES" => Array(
			"sections" => "filter/#SMART_FILTER_PATH#/apply/",
			"section" => "#SECTION_CODE#/",
			"element" => "#SECTION_CODE#/#ELEMENT_CODE#.html",
			"compare" => "compare/",
			"search" => "search/",
		),
		"SET_LAST_MODIFIED" => "N",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SHOW_DEACTIVATED" => "N",
		"SHOW_DISCOUNT_PERCENT" => "N",
		"SHOW_EMPTY_STORE" => "Y",
		"SHOW_GENERAL_STORE_INFORMATION" => "N",
		"SHOW_LINK_TO_FORUM" => "Y",
		"SHOW_OLD_PRICE" => "Y",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_TOP_ELEMENTS" => "Y",
		"SIDEBAR_DETAIL_SHOW" => "Y",
		"SIDEBAR_PATH" => "",
		"SIDEBAR_SECTION_SHOW" => "Y",
		"STORES" => array(
			0 => "1",
		),
		"STORE_PATH" => "/company/shops/#store_id#.html",
		"TEMPLATE_THEME" => "",
		"TOP_ADD_TO_BASKET_ACTION" => "ADD",
		"TOP_ELEMENT_COUNT" => "9",
		"TOP_ELEMENT_SORT_FIELD" => "sort",
		"TOP_ELEMENT_SORT_FIELD2" => "id",
		"TOP_ELEMENT_SORT_ORDER" => "asc",
		"TOP_ELEMENT_SORT_ORDER2" => "desc",
		"TOP_LINE_ELEMENT_COUNT" => "3",
		"TOP_OFFERS_FIELD_CODE" => array("", ""),
		"TOP_OFFERS_LIMIT" => "5",
		"TOP_OFFERS_PROPERTY_CODE" => array(""),
		"TOP_PROPERTY_CODE" => array(""),
		"TOP_VIEW_MODE" => "SECTION",
		"URL_TEMPLATES_READ" => "",
		"USER_FIELDS" => array(""),
		"USE_ALSO_BUY" => "N",
		"USE_BIG_DATA" => "N",
		"USE_CAPTCHA" => "Y",
		"USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
		"USE_COMPARE" => "Y",
		"USE_ELEMENT_COUNTER" => "Y",
		"USE_FILTER" => "Y",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"DETAIL_STRICT_SECTION_CHECK" => "N",
		"USE_MIN_AMOUNT" => "Y",
		"USE_PRICE_COUNT" => "N",
		"USE_PRODUCT_QUANTITY" => "Y",
		"USE_REVIEW" => "Y",
		"USE_SALE_BESTSELLERS" => "N",
		"USE_STORE" => "Y",
		"REQUEST_LOAD" => ($_REQUEST['load'] == "Y") ? "Y" : "N",
		"REQUEST_PAGE_EL_COUNT" => $_REQUEST['PAGE_EL_COUNT'],
		"REQUEST_SORT" => $_REQUEST['sort'],
		"REQUEST_VIEW" => $_REQUEST['view'],
		"REQUEST_SEARCH_SECTION" => $_REQUEST['ssection'],
		"PAGE_TO_LIST" => array(
			0 => "16",
			1 => "64",
			2 => "ALL",
		),
		"SORT_LIST_CODES" => array(
            0 => "default",
			1 => "price_asc",
			2 => "price_desc",
		),
		"SORT_LIST_FIELDS" => array(
            0 => "SORT",
			1 => "PROPERTY_MIN_PRICE",
			2 => "PROPERTY_MIN_PRICE",
		),
		"SORT_LIST_ORDERS" => array(
			0 => "asc,nulls",
			1 => "desc,nulls",
            2 => "asc,nulls"
		),
		"SORT_LIST_NAME" => array(
            0 => "---",
			1 => "Цене, сначала недорогие",
			2 => "Цене, сначала дорогие",
		),
		"CATALOG_MAIN_LIST" => "Y",
		"FILTER_NUMBERS_SHOW" => "N",
		"SHOW_PRODUCT_SET" => "N",
		"PARAMS_STRING" => $APPLICATION->GetCurPageParam(),
		"SKU_PICT_TYPE" => $typePict,
		"USE_LAZY_LOAD" => $useLazyLoad,
	)
);?>