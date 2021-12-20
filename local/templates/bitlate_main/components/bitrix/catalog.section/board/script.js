$(document).ready(function () {
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
});