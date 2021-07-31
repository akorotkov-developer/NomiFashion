<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<?php
use Bitrix\Sale;

//Если оплата прошла успешно, нужно изменить статус заказа на
if ($_REQUEST['Success'] == 'true' && $_REQUEST['OrderId']) {
    $orderId = $_REQUEST['OrderId'];

    $order = Sale\Order::load($orderId);
    $paymentCollection = $order->getPaymentCollection();

    $onePayment = $paymentCollection[0];
    $onePayment->setPaid("Y");

    $order->setField('STATUS_ID', 'P');

    $order->save();

    echo "<h1 style='text-align: center; margin: 100px; color: darkgreen;'>Ваш заказ успешно оплачен и и формируется к отправке</h1>";
}
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>