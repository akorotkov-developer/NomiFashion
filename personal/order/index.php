<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>
<article class="inner-container cart-container cart-container-pay cart-container-order">
    <?$APPLICATION->IncludeComponent("bitrix:sale.personal.order", "", array(
        "SEF_MODE" => "Y",
        "SEF_FOLDER" => "/personal/",
        "ORDERS_PER_PAGE" => "999",
        "PATH_TO_PAYMENT" => "/personal/order/payment/",
        "PATH_TO_BASKET" => "/personal/cart/",
        "PATH_TO_CANCEL" => "/personal/order/#ID#/",
        "SET_TITLE" => "Y",
        "SAVE_IN_SESSION" => "N",
        "NAV_TEMPLATE" => "arrows",
        "SEF_URL_TEMPLATES" => array(
            "list" => "index.php",
            "detail" => "order/#ID#/",
            "cancel" => "order/cancel/#ID#/",
        ),
        "SHOW_ACCOUNT_NUMBER" => "Y",
        ),
        false
    );?>
</article>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>