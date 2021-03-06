<?$APPLICATION->IncludeComponent(
	"bitrix:search.title",
	"catalog",
	array(
		"NUM_CATEGORIES" => "3",
		"TOP_COUNT" => "3",
		"ORDER" => "rank",
		"USE_LANGUAGE_GUESS" => "N",
		"CHECK_DATES" => "N",
		"SHOW_OTHERS" => "N",
		"PAGE" => "/catalog/search/",
		"SHOW_INPUT" => "Y",
		"INPUT_ID" => "title-search-input",
		"CONTAINER_ID" => "search-dropdown",
		"CATEGORY_0_TITLE" => getMessage('TITLE_NEWS'),
		"CATEGORY_0" => array(
			0 => "iblock_news",
		),
		"PRICE_CODE" => array(
			0 => "Розничная цена",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"SHOW_PREVIEW" => "Y",
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => "",
		"PREVIEW_WIDTH" => "52",
		"PREVIEW_HEIGHT" => "50",
		"CATEGORY_1_TITLE" => getMessage('TITLE_ACTIONS'),
		"CATEGORY_1" => array(
			0 => "iblock_news",
		),
		"CATEGORY_2_TITLE" => getMessage('TITLE_GOODS'),
		"CATEGORY_2" => array(
			0 => "iblock_catalog",
		),
		"CATEGORY_0_iblock_news" => array(
			0 => '3',
		),
		"CATEGORY_1_iblock_news" => array(
			0 => '7',
		),
		"CATEGORY_2_iblock_catalog" => array(
			0 => '4',
		),
	),
	false
);?>