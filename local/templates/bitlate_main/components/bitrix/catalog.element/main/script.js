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
            $(this).siblings('.full_descr_text').show();
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
        $($('.b-content-store-amount')).appendTo($('.availability_in_stores_content'));
        /*$('.availability_in_stores_content').html($('.products_count_info').html());*/
        $('.availability_in_stores_content').show();
    });

    $('.b-reviews>.content-reviews').appendTo( $('.sect-reviews') );

    // Клик по ссылке "Закрыть".
    $('.popup-open').click(function() {
        $('.popup-fade').fadeIn();
        return false;
    });

    $('.popup-close').click(function() {
        $(this).parents('.popup-fade').fadeOut();
        return false;
    });

    $(document).keydown(function(e) {
        if (e.keyCode === 27) {
            e.stopPropagation();
            $('.popup-fade').fadeOut();
        }
    });

    $('.popup-fade').click(function(e) {
        if ($(e.target).closest('.popup').length == 0) {
            $(this).fadeOut();
        }
    });
});