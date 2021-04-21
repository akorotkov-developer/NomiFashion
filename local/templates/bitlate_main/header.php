<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
if (!CModule::IncludeModule('bitlate.apparelshop')) return false;
$templateOptions = NLApparelshopUtils::initTemplateOptions();
global $USER;
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta name="yandex-verification" content="1ec34f802266e3ae" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?$APPLICATION->SetAdditionalCSS("https://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900,900italic&subset=cyrillic-ext,cyrillic,latin");?>
    <?$APPLICATION->SetAdditionalCSS("/local/templates/".SITE_TEMPLATE_ID."/themes/".$templateOptions['theme']."/css/main.css");?>
    <?$APPLICATION->SetAdditionalCSS("/local/templates/".SITE_TEMPLATE_ID."/css/custom.css");?>
    <?$APPLICATION->SetAdditionalCSS("/local/templates/".SITE_TEMPLATE_ID."/css/site.css");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/foundation.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/isotope.pkgd.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/slideout.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/owl.carousel.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/fancybox.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/fancybox-thumbs.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/zoomsl.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/selectbox.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.inputmask.bundle.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.lazy.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/yandex.maps.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/main.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/colorpicker.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/jquery.validate.min.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/custom.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/site.js");?>
    <?$APPLICATION->AddHeadScript("/local/templates/".SITE_TEMPLATE_ID."/js/scripts.js");?>
    <?if (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'company/contacts') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'company/shops') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'shop/delivery') === 0):?>
        <?$APPLICATION->AddHeadScript("https://api-maps.yandex.ru/2.1/?lang=ru_RU");?>
    <?endif;?>
    <?$APPLICATION->ShowHead()?>
    <title><?$APPLICATION->ShowTitle();?></title>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_favicon.php");?>
    <meta property="og:title" content="<?$APPLICATION->ShowTitle();?>"/>
    <?$APPLICATION->ShowProperty("og_description");?>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?=NLApparelshopUtils::getServerProtocol() . $_SERVER['HTTP_HOST'] . $APPLICATION->GetCurUri()?>" />
    <?$APPLICATION->ShowProperty("og_img");?>
    <?$APPLICATION->ShowProperty("og_width");?>
    <?$APPLICATION->ShowProperty("og_height");?>
    <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_head.php");?>
<!-- Facebook Pixel Code -->
      <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.agent='plinsales';n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', 333165997565256);
        fbq('track', 'PageView');
      </script>
      <noscript><img height="1" width="1" style="display:none"
        src="https://www.facebook.com/tr?id=333165997565256&ev=PageView&noscript=1"
      /></noscript>
    <!-- End Facebook Pixel Code -->
<!-- Yandex.Metrika counter -->
<script type="text/javascript" >
   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

   ym(73454092, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true,
        ecommerce:"dataLayer"
   });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/73454092" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
</head>
<body>
    <?$APPLICATION->ShowPanel();?>
    <div style="height: 0; width: 0; position: absolute; visibility: hidden">
        <?require($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH . "/include/header_svg.php");?>
    </div>
    
    <nav id="mobile-menu" class="mobile-menu hide-for-xlarge">
        <div class="mobile-menu-wrapper">
            <a href="<?=SITE_DIR?>personal/" class="button mobile-menu-profile relative">
                <svg class="icon">
                    <use xlink:href="#svg-icon-profile"></use>
                </svg>
                <?=getMessage('PERSONAL_CABINET')?>
            </a>
            <div class="is-drilldown">
                <!--noindex-->
                <?$APPLICATION->IncludeComponent('bitrix:menu', "mobile_menu_main", array(
                        "ROOT_MENU_TYPE" => "main",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "Y",
                        "ALLOW_MULTI_SELECT" => "N",
                        "SUB_CLASS" => "mobile-menu-main",
                    )
                );?>
                <!--/noindex-->
                <?$APPLICATION->IncludeComponent('bitrix:menu', "mobile_menu_main", array(
                        "ROOT_MENU_TYPE" => "site",
                        "MENU_CACHE_TYPE" => "Y",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MAX_LEVEL" => "2",
                        "USE_EXT" => "Y",
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "bottom",
                        "DELAY" => "N",
                    )
                );?>
                <form action="<?=$templateOptions['url_catalog_search']?>" class="mobile-menu-search relative">
                    <button type="submit">
                        <svg class="icon">
                            <use xlink:href="#svg-icon-search"></use>
                        </svg>
                    </button>
                    <input type="text" placeholder="<?=getMessage('SEARCH_STRING')?>" name="q" />
                </form>
            </div>
        </div>
    </nav>
    <?$headerClass = "";
    if ($templateOptions['main_menu_pos'] == 'fix') {
        $headerClass .= ' menu-fixed';
    }
    if ($templateOptions['use_lazy_load'] == 'Y') {
        $headerClass .= ' page-lazy';
    }?>
    <div id="page" class="<?=trim($headerClass)?>">
        <div id="bx_custom_menu">
            <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_custom_menu", false);
            $frame->begin();?>
                <?if (NLApparelshopUtils::isShowCustom() && NLApparelshopUtils::isCustomPage()):?>
                    <?$APPLICATION->IncludeComponent("bitlate:custom.menu","",Array(
                        'CUR_THEME' => $templateOptions['theme'],
                        'CUR_MAIN_MENU_POS' => $templateOptions['main_menu_pos'],
                        'CUR_SKU_PICT_TYPE' => $templateOptions['sku_pict_type'],
                        'CUR_USE_LAZY_LOAD' => $templateOptions['use_lazy_load'],
                        'MODULE_NAME' => 'bitlate.apparelshop',
                    ));?>
                <?endif;?>
            <?$frame->beginStub();?>
            <?$frame->end();?>
        </div>
        <header>
            <div class="header-line-top hide-for-small-only hide-for-medium-only hide-for-large-only">
                <div class="container row">
                    <?$APPLICATION->IncludeComponent('bitrix:menu', "top", array(
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MAX_LEVEL" => "1",
                            "USE_EXT" => "N",
                            "ALLOW_MULTI_SELECT" => "N"
                        )
                    );?>
                    <div class="float-right inline-block-container">
                        <?if ($templateOptions['use_compare'] == "Y"):?>
                            <div class="inline-block-item relative">
                                <?$APPLICATION->IncludeFile(
                                    SITE_DIR . "include/compare_list.php",
                                    Array()
                                );?>
                            </div>
                        <?endif;?>
                        <div class="inline-block-item relative">
                            <?$APPLICATION->IncludeComponent("bitlate:catalog.favorite.line","",Array());?>
                        </div>
                        <div class="inline-block-item relative" id="bx_personal_menu">
                            <?$frame = new \Bitrix\Main\Page\FrameHelper("bx_personal_menu", false);
                            $frame->begin();?>
                                <a href="<?if ($USER->IsAuthorized()):?><?=SITE_DIR?>personal/<?else:?>#login<?endif;?>" class="button transparent header-line-top-profile fancybox" data-toggle="profile-dropdown">
                                    <svg class="icon">
                                        <use xlink:href="#svg-icon-profile"></use>
                                    </svg>
                                    <?if ($USER->IsAuthorized()):?>
                                        <?=getMessage('PERSONAL_CABINET')?>
                                    <?else:?>
                                        <?=getMessage('ENTER')?>
                                    <?endif;?>
                                </a>
                                <?if ($USER->IsAuthorized()):?>
                                    <div class="dropdown-pane bottom" id="profile-dropdown" data-dropdown data-hover="true" data-hover-pane="true">
                                        <ul>
                                            <li><a href="<?=SITE_DIR?>personal/"><?=getMessage('PERSONAL_CABINET')?></a></li>
                                            <li><a href="<?=$APPLICATION->GetCurPageParam('logout=yes', array('logout'));?>"><?=getMessage('EXIT')?></a></li>
                                        </ul>
                                    </div>
                                <?endif;?>
                            <?$frame->beginStub();?>
                                <a href="#" class="button transparent header-line-top-profile">
                                    <svg class="icon">
                                        <use xlink:href="#svg-icon-profile"></use>
                                    </svg>
                                    <?=getMessage('ENTER')?>
                                </a>
                            <?$frame->end();?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="advanced-container inline-block-container relative header-mobile-fixed">
                <a href="javascript:;" class="header-mobile-toggle inline-block-item vertical-middle hide-for-xlarge">
                    <svg class="icon">
                        <use xlink:href="#svg-icon-m-toggle"></use>
                    </svg>
                </a>
                <a href="<?=SITE_DIR?>" class="header-logo inline-block-item vertical-middle">
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR . "include/logo.php",
                        Array(
                            "PATH_TO_LOGO" => "/local/templates/" . SITE_TEMPLATE_ID . "/themes/" . $templateOptions['theme'] . "/images/logo.png",
                        )
                    );?>
                </a>
                <div class="header-block-right show-for-xlarge">
                    <div class="inline-block-item" id="title-search">
                        <?$APPLICATION->IncludeFile(
                            SITE_DIR . "include/search_title.php",
                            Array()
                        );?>
                    </div>
                    <div class="header-phone inline-block-item">
                        <div class="inline-block-container">
                            <svg class="icon">
                                <use xlink:href="#svg-icon-phone"></use>
                            </svg>
                            <div class="inline-block-item">
                                <div class="header-phone-number"><?$APPLICATION->IncludeComponent(
                                    "bitrix:main.include",
                                    "",
                                    Array(
                                        "AREA_FILE_SHOW" => "file",
                                        "AREA_FILE_SUFFIX" => "inc",
                                        "PATH" => SITE_DIR . "include/phone.php"
                                    )
                                );?></div>
                                <div class="header-phone-link"><a href="#request-callback" class="fancybox"><?=getMessage('REQUEST_CALL')?></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="header-cart header-block-info inline-block-item">
                        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "", array(
                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "SHOW_PRODUCTS" => "Y",
                                "POSITION_FIXED" =>"N",
                                "HIDE_ON_BASKET_PAGES" => "N",
                            ),
                            false,
                            array()
                        );?>
                    </div>
                </div>
                <ul class="header-fixed-block">
                    <li class="header-cart header-block-info header-fixed-item">
                        <?$APPLICATION->IncludeComponent("bitrix:sale.basket.basket.line", "mini", array(
                                "PATH_TO_BASKET" => SITE_DIR."personal/cart/",
                                "PATH_TO_PERSONAL" => SITE_DIR."personal/",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "SHOW_PRODUCTS" => "Y",
                                "POSITION_FIXED" =>"N",
                                "HIDE_ON_BASKET_PAGES" => "N",
                            ),
                            false,
                            array()
                        );?>
                    </li>
                    <li class="header-liked header-block-info header-fixed-item">
                        <?$APPLICATION->IncludeComponent("bitlate:catalog.favorite.line","mini",Array());?>
                    </li>
                    <?if ($templateOptions['use_compare'] == "Y"):?>
                        <li class="header-compare header-block-info header-fixed-item">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR . "include/compare_list.php",
                                Array(
                                    'TYPE' => 'mini',
                                )
                            );?>
                        </li>
                    <?endif;?>
                </ul>
            </div>
            <?$APPLICATION->IncludeComponent("bitrix:menu", "header_main_menu", array(
                    "ROOT_MENU_TYPE" => "main",
                    "MENU_CACHE_TYPE" => "Y",
                    "MENU_CACHE_TIME" => "36000000",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "MENU_CACHE_GET_VARS" => array(
                    ),
                    "MAX_LEVEL" => "2",
                    "USE_EXT" => "Y",
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "DELAY" => "N",
                ),
                false
            );?>
        </header>
        <?$classSection = "";
        $isSearch = ($APPLICATION->GetCurDir() == $templateOptions['url_catalog_search'] && isset($_REQUEST['q']));
        if ($APPLICATION->GetCurDir() == SITE_DIR) {
        } elseif (($APPLICATION->GetCurDir() == SITE_DIR . 'personal/' || $APPLICATION->GetCurDir() == SITE_DIR . 'personal/profile/') && $USER->IsAuthorized()) {
            $classSection = "profile";
        } elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/make/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/payment/') === 0) {
            $classSection = "cart";
        } elseif (ERROR_404 == "Y") {
            $classSection = "not-found";
        } elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'auth/') === 0) {
            $classSection = "fancy";
        } else {
            $classSection = "inner";
        }
        if (ERROR_404 != "Y" && (strpos($APPLICATION->GetCurDir(), $templateOptions['url_catalog']) === false || $isSearch)):?>
            <section class="<?=$classSection?>">
                <?if ($APPLICATION->GetCurDir() == SITE_DIR):?>
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR . "include/main_banner.php",
                        Array(
                            'MAIN_SLIDER_TYPE' => " lapping",
                        )
                    );?>
                    <div class="main-product-tabs">
                        <div class="advanced-container-medium">
                            <select class="select-tabs hide-for-large">
                                <option value="#product-tab-recomend"><?=getMessage('TITLE_TAB_RECOMEND')?></option>
                                <option value="#product-tab-news"><?=getMessage('TITLE_TAB_NEWS')?></option>
                                <option value="#product-tab-hits"><?=getMessage('TITLE_TAB_HITS')?></option>
                                <option value="#product-tab-discount"><?=getMessage('TITLE_TAB_DISCOUNT')?></option>
                            </select>
                            <ul class="tabs inline-block-container text-center show-for-large" id="main-product-tabs" data-tabs>
                                <li class="tabs-title inline-block-item float-none is-active"><a href="#product-tab-recomend"><span><?=getMessage('TITLE_TAB_RECOMEND')?></span></a></li>
                                <li class="tabs-title inline-block-item float-none"><a href="#product-tab-news"><span><?=getMessage('TITLE_TAB_NEWS')?></span></a></li>
                                <li class="tabs-title inline-block-item float-none"><a href="#product-tab-hits"><span><?=getMessage('TITLE_TAB_HITS')?></span></a></li>
                                <li class="tabs-title inline-block-item float-none"><a href="#product-tab-discount"><span><?=getMessage('TITLE_TAB_DISCOUNT')?></span></a></li>
                            </ul>
                        </div>
                        <div class="container row tabs-content" data-tabs-content="main-product-tabs">
                            <?$arTabs = array('recomend', 'news', 'hits', 'discount');
                            foreach ($arTabs as $type):?>
                                <div class="tabs-panel<?if ($type == 'recomend'):?> is-active<?endif;?>" id="product-tab-<?=$type?>">
                                    <div class="products-flex-grid product-grid product-grid-<?=$type?>">
                                        <?$APPLICATION->IncludeFile(
                                            SITE_DIR . "include/popup/product_tab.php",
                                            Array(
                                                'TYPE' => $type,
                                            )
                                        );?>
                                </div>
                            <?endforeach;?>
                        </div>
                    </div>
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR . "include/news_advantages_brands.php",
                        Array(
                            'NEWS_TYPE' => 3,
                        )
                    );?>
                <?elseif (($APPLICATION->GetCurDir() == SITE_DIR . 'personal/' || $APPLICATION->GetCurDir() == SITE_DIR . 'personal/profile/') && $USER->IsAuthorized()):?>
                    <div class="inner-bg">
                        <div class="advanced-container-medium">
                            <article class="profile-container">
                                <h1 class="text-center"><?$APPLICATION->ShowTitle(false)?></h1>
                <?elseif ($APPLICATION->GetCurDir() == SITE_DIR . 'personal/cart/' || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/order/') === 0):?>
                    <div class="inner-bg">
                        <div class="advanced-container-medium">
                <?elseif ($isSearch):?>
                    <div class="advanced-container-medium">
                        <nav>
                            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "0", 
                                    "PATH" => "", 
                                )
                            );?>
                        </nav>
                        <article class="inner-container">
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                <?elseif (strpos($APPLICATION->GetCurDir(), SITE_DIR . 'personal/') === 0 || strpos($APPLICATION->GetCurDir(), SITE_DIR . 'auth/') === 0):?>
                    <div class="inner-bg">
                        <article class="inner-container float-center table-container">
                <?else:?>
                    <div class="advanced-container-medium">
                        <nav>
                            <?$APPLICATION->IncludeComponent("bitrix:breadcrumb","",Array(
                                    "START_FROM" => "0", 
                                    "PATH" => "", 
                                )
                            );?>
                        </nav>
                        <article class="inner-container">
                            <h1><?$APPLICATION->ShowTitle(false)?></h1>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "left", array(
                                    "ROOT_MENU_TYPE" => "left",
                                    "MENU_CACHE_TYPE" => "Y",
                                    "MENU_CACHE_TIME" => "36000000",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => array(
                                    ),
                                    "MAX_LEVEL" => "1",
                                    "USE_EXT" => "N",
                                    "ALLOW_MULTI_SELECT" => "N",
                                    "DELAY" => "N",
                                ),
                                false
                            );?>
                            <div class="inner-content <?=NLApparelshopUtils::getLeftMenu()?>">
                <?endif;?>
        <?endif;?>