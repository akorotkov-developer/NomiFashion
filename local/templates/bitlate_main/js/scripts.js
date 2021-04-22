$( document ).ready(function() {
    $('.show_hidden_text_on_main_page').on('click', function() {
        var hiddenTextBlock = $('.hidden_text_on_main_page_content');

        if ($(this).attr('data-opened') == 'true') {
            hiddenTextBlock.removeClass('opened');
            $(this).attr('data-opened', false);
            $(this).text('Читать далее');
        } else {
            if (!hiddenTextBlock.hasClass('opened')) {
                hiddenTextBlock.addClass('opened');
            }
            $(this).attr('data-opened', true);
            $(this).text('Свернуть');
        }
    });
});