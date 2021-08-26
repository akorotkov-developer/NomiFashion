$(document).ready(function () {
    //Показать характеристики товаров
    $('body').on('click', '.all_props', function (e) {
        if ($(this).text() == 'Подробнее') {
            $('.hidden_prop').show();
            $(this).text('Скрыть');
        } else {
            $('.hidden_prop').hide();
            $(this).text('Подробнее');
        }
    });

    //Показать описание
    $('body').on('click', '.full_descr', function (e) {
        if ($(this).text() == 'Подробнее') {
            $('.full_descr_text').show();
            $('.short_descr').hide();
            $(this).text('Скрыть');
        } else {
            $('.full_descr_text').hide();
            $('.short_descr').show();
            $(this).text('Подробнее');
        }
    });

    //Показать наличие в магазинах
    $('body').on('click', '.availability_show', function (e) {
        $(this).hide();
        $('.availability_in_stores_content').show();
    });
});