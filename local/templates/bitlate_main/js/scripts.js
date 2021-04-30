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
    $('.show_all_bottom_menu').on('click', function() {
        var hiddenTextBlock = $('.bottom-menu-catalog-menu');

        if ($(this).attr('data-opened') == 'true') {
            hiddenTextBlock.removeClass('opened');
            $(this).attr('data-opened', false);
            $(this).text('Показать все');
        } else {
            if (!hiddenTextBlock.hasClass('opened')) {
                hiddenTextBlock.addClass('opened');
            }
            $(this).attr('data-opened', true);
            $(this).text('Скрыть');
        }
    });

    /**Пройдемся по верхнему меню и перенесем лишние пункты меню в бургер*/
    var totalWidth = 0;
    var i = 0;
    $(".top_menu li").each(function (index, el) {
        totalWidth += $(el).innerWidth();
        if (totalWidth > 1100) {
            i++;
            $(".hidden_ul_main_menu").append($(el));
        }
        if (i == 0) {
            $('.main-menu-right-button').hide();
        }
    });

    /**Зададим data-special для всех блоков*/
    $(".top_child").each(function (index, el) {
        if ($(el).parents('.b-hidden-menu').length == 0) {
            var text = $(el).siblings('a').html();
            $(el).find('ul').attr('data-special', text);
        }
    });

    /**Клик по октрыванию мобильного подменю*/
    $('.is_arrow_for_open_child.is-submenu-item').on('click', function(event) {
        var dataUl = $(this).attr('data-subul');

        var subUl = $('ul[data-ul="' + dataUl + '"]');

        if (subUl.is(':hidden')) {
            subUl.fadeIn();
            if (!$(this).find('span').hasClass('active')) {
                $(this).find('span').addClass('active');
            }
        } else {
            $(this).find('span').removeClass('active');
            subUl.fadeOut();
        }

        event.preventDefault();
    });
});