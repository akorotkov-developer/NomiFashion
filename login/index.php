<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Вход на сайт");
?>
<div class="fancybox-block fancybox-block-login" style="display: block;">
    <div class="fancybox-block-caption">Вход</div>
    <div class="fancybox-block-wrap">
        <p>Вы зарегистрированы и успешно авторизовались.</p>
        <p><a href="/" class="small-12 button small fancybox-button text-center">Вернуться на главную страницу</a></p>
    </div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>