<?if (CModule::IncludeModule('bitlate.apparelshop')) {
    $APPLICATION->IncludeFile(
        SITE_DIR . "include/favorites.php",
        Array(
            'USER_FAVORITES' => NLApparelshopUtils::getFavorits(),
        )
    );
    die();
}?>