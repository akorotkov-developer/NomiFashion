var productGridOptions = {
    // options
    itemSelector: '.products-flex-item',
    masonry: {
        columnWidth: 240
    },
    animationOptions: {
        duration: 0,
        easing: 'linear',
        queue: false
    },
    getSortData: {
        order: '[data-order]'
    },
    sortBy : 'order'
};

var profileGridOptions = {
    itemSelector: '.profile-column-item',
    animationOptions: {
        duration: 0,
        easing: 'linear',
        queue: false
    },
    getSortData: {
        order: '[data-order]'
    },
    sortBy : 'order'
}

var profileGridOptions2 = {
    itemSelector: '.block-item',
    animationOptions: {
        duration: 0,
        easing: 'linear',
        queue: false
    },
    getSortData: {
        order: '[data-order]'
    },
    sortBy : 'order'
}

var breakpoints = {
    small: 0,
    medium: 518,
    large: 758,
    xlarge: 998,
    xxlarge: 1238
}

function initOwl() {
    var $mainSlider       = $('.main-slider'),
        $mainSliderMobile = $('.main-slider-mobile'),
        $mainBanner       = $('.main-banner'),
        $mainNews         = $('.main-news-carousel'),
        $mainBrand        = $('.main-brand-carousel'),
        $productPreview   = $('.product-slider'),
        $productPack      = $('.product-pack-carousel'),
        $productSet       = $('.product-set-carousel'),
        $productCompare   = $('.product-compare-carousel'),
        $productSeeIt     = $('.product-carousel'),
        $innerGallery     = $('.inner-carousel'),
        $innerTeam        = $('.inner-team');


    if ($mainSlider.length) {
        var itemLength = $mainSlider.find('.item').length,
            params = {
                items: 1,
                center: true,
                navText: [],
                autoplay: true
            },
            medium = $mainSlider.parent().hasClass('medium');
        if (itemLength > 1) {
            params['loop'] = true;
            params['nav'] = (medium) ? false : true;
        } else {
            params['loop'] = false;
            params['dots'] = false;
        }
        $mainSlider.owlCarousel(params);
    }
    if ($mainSliderMobile.length) {
        var itemLength = $mainSliderMobile.find('.item').length,
            params = {
                items: 1,
                center: true,
                navText: [],
                autoplay: true
            },
            medium = $mainSliderMobile.parent().hasClass('medium');
        if (itemLength > 1) {
            params['loop'] = true;
            params['nav'] = (medium) ? false : true;
        } else {
            params['loop'] = false;
            params['dots'] = false;
        }
        $mainSliderMobile.owlCarousel(params);
    }
    if ($mainBanner.length) {
        $mainBanner.each(function(){
            var $self = $(this),
                isLazy = ($self.hasClass('is-lazy')),
                isRightBanner = ($self.closest('.main-slider-banner').hasClass('banner-right')),
                itemLength = $self.find('.item').length,
                params = {
                    loop: true,
                    items: 1,
                    margin: 20,
                    lazyLoad: isLazy,
                    navText: [],
                    responsive: {}
                };
            params['responsive'][breakpoints['large']] = {
                items: 2
            };
            params['responsive'][breakpoints['xlarge']] = {
                items: (isRightBanner) ? 1 : 3,
                loop: false,
                dots: false,
                mouseDrag: isRightBanner,
                touchDrag: isRightBanner,
                freeDrag: !isRightBanner,
            };
            switch (itemLength) {
                case 1:
                    params['loop'] = false;
                    params['dots'] = false;
                    break;
                case 2:
                    params['responsive'][breakpoints['large']]['loop'] = false;
                    params['responsive'][breakpoints['large']]['dots'] = false;
                    break;
            }
            $(this).owlCarousel(params);
        });
    }
    if ($mainNews.length) {
        $mainNews.each(function(){
            var $self = $(this),
                isLazy = ($self.hasClass('is-lazy')),
                itemLength = $self.find('.item').length,
                params = {
                    items: 1,
                    margin: 23,
                    lazyLoad: isLazy,
                    nav: true,
                    navText: [],
                    responsive: {},
                };
            params['responsive'][breakpoints['large']] = {
                items: 2,
            };
            params['responsive'][breakpoints['xlarge']] = {
                items: 3,
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: 4,
            };
            switch (itemLength) {
                case 1:
                    params['nav'] = false;
                    params['dots'] = false;
                    break;
                case 2:
                    params['responsive'][breakpoints['large']]['dots'] = false;
                    params['responsive'][breakpoints['xlarge']]['dots'] = false;
                    params['responsive'][breakpoints['xxlarge']]['dots'] = false;
                    break;
                case 3:
                    params['responsive'][breakpoints['xlarge']]['dots'] = false;
                    params['responsive'][breakpoints['xxlarge']]['dots'] = false;
                    break;
                case 4:
                    params['responsive'][breakpoints['xxlarge']]['dots'] = false;
                    break;
            }
            $self.owlCarousel(params);
        });
    }
    if ($mainBrand.length) {
        $mainBrand.each(function(){
            var $self = $(this),
                isLazy = ($self.hasClass('is-lazy')),
                itemLength = $(this).find('.item').length,
                params = {
                    items: 4,
                    loop: true,
                    lazyLoad: isLazy,
                    navText: [],
                    responsive: {}
                };
            params['responsive'][breakpoints['large']] = {
                items: 6,
            };
            params['responsive'][breakpoints['xlarge']] = {
                items: 8,
                dots: false,
            };
            if (itemLength <= 4) {
                params['dots'] = false;
                params['loop'] = false;
            } else if (itemLength <= 6) {
                params['responsive'][breakpoints['large']]['dots'] = false;
                params['responsive'][breakpoints['large']]['loop'] = false;
            } else if (itemLength <= 8) {
                params['responsive'][breakpoints['xlarge']]['dots'] = false;
                params['responsive'][breakpoints['xlarge']]['loop'] = false;
            } else {
                params['responsive'][breakpoints['xlarge']]['nav'] = true;
            }
            $self.owlCarousel(params);
        });
    }
    if ($productPreview.length) {
        $productPreview.each(function(){
            var params = {
                items: 2,
                nav: true,
                dots: false,
                navText: [],
                responsive: {},
            };
            params['responsive'][breakpoints['medium']] = {
                items: 4,
            };
            $(this).owlCarousel(params);
        });
    }
    if ($productSeeIt.length) {
        $productSeeIt.each(function(){
            var $self = $(this),
                isLazy = ($self.hasClass('is-lazy')),
                variation = $self.parent().hasClass('product-pack-variation'),
                inner = $self.hasClass('product-carousel-inner'),
                itemLength = $self.children('.item').length,
                params = {
                    items: 1,
                    margin: 50,
                    lazyLoad: isLazy,
                    dragEndSpeed: 100,
                    navText: [],
                    rewind: !variation,
                    responsive: {},
                    mouseDrag: false
                };

            params['responsive'][breakpoints['medium']] = {
                items: 2
            };
            params['responsive'][breakpoints['large']] = {
                items: 3
            };
            params['responsive'][breakpoints['xlarge']] = {
                items: inner ? 3 : 4,
                nav: true,
                dots: false,
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: inner ? 4 : 5,
                nav: true,
                dots: false,
            };
            if (!variation) {
                switch (itemLength) {
                    case 1:
                        params['loop'] = false;
                        params['dots'] = false;
                    case 2:
                        params['responsive'][breakpoints['medium']]['loop'] = false;
                        params['responsive'][breakpoints['medium']]['dots'] = false;
                    case 3:
                        params['responsive'][breakpoints['large']]['loop'] = false;
                        params['responsive'][breakpoints['large']]['dots'] = false;
                    case 4:
                        params['responsive'][breakpoints['xlarge']]['loop'] = false;
                        params['responsive'][breakpoints['xlarge']]['nav'] = false;
                    case 5:
                        params['responsive'][breakpoints['xxlarge']]['loop'] = (itemLength === 5 && inner);
                        params['responsive'][breakpoints['xxlarge']]['nav'] = (itemLength === 5 && inner);
                        break;
                }
            }
            $self.owlCarousel(params);
        });
    }
    if ($productPack.length) {
        $productPack.each(function(){
            var $self = $(this),
                params = {
                    items: 1,
                    margin: -1,
                    responsive: {}
                };
            params['responsive'][breakpoints['xlarge']] = {
                items: 2
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: 3
            };
            $self.owlCarousel(params);
        });
    }
    if ($productSet.length) {
        $productSet.each(function(){
            var $self = $(this),
                params = {
                    items: 1,
                    margin: -1,
                    responsive: {}
                };
            params['responsive'][breakpoints['medium']] = {
                items: 2
            };
            params['responsive'][breakpoints['large']] = {
                items: 3
            };
            params['responsive'][breakpoints['xlarge']] = {
                items: 4
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: 5
            };
            $self.owlCarousel(params);
        });
    }
    if ($productCompare.length) {
        var itemLength = $productCompare.children('.item').length,
            $compareTd = $('.compare-table-td'),
            heightArr = [],
            params = {
            items: 1,
            margin: -1,
            navText: [],
            responsive: {},
            mouseDrag: false
        };
        params['responsive'][breakpoints['medium']] = {
            items: 2
        };
        params['responsive'][breakpoints['xlarge']] = {
            items: 3,
            nav: true,
            dots: false
        };
        params['responsive'][breakpoints['xxlarge']] = {
            items: 4,
            nav: true,
            dots: false
        };
        switch (itemLength) {
            case 1:
                params['dots'] = false;
            case 2:
                params['responsive'][breakpoints['medium']]['dots'] = false;
                break;
        }
        
        $compareTd.each(function(){
            var $td = $(this),
                index = $td.index(),
                heightColumn = $td.find('.column:not(.transparent)').outerHeight();

            if ((heightColumn > heightArr[index]) || (heightArr[index] === undefined)) {
                heightArr[index] = heightColumn;
            }
        });
        $compareTd.each(function(){
            var $td = $(this),
                index = $td.index(),
                $column = $td.find('.column:not(.transparent, .hide-for-large)');

            if ($column.length) {
                $column.css('height', heightArr[index]);
            }
        });
        
        $productCompare.owlCarousel(params);
    }
    if ($innerGallery.length) {
        $innerGallery.each(function() {
            var $self = $(this),
                itemLength = $self.children('.item').length,
                params = {
                    items: 2,
                    margin: 15,
                    loop: true,
                    navText: [],
                    responsive: {},
                };

            params['responsive'][breakpoints['large']] = {
                nav: true,
                dots: false,
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: 3,
                nav: true,
                dots: false,
            };
            switch (itemLength) {
                case 1:
                case 2:
                    params['loop'] = false;
                    params['dots'] = false;
                    params['responsive'][breakpoints['large']]['nav'] = false;
                case 3:
                    params['responsive'][breakpoints['xxlarge']]['nav'] = false;
                    break;
            }
            $self.owlCarousel(params);
        });
    }
    if ($innerTeam.length) {
        $innerTeam.each(function() {
            var $self = $(this),
                itemLength = $self.children('.item').length,
                params = {
                    items: 1,
                    loop: true,
                    navText: [],
                    responsive: {},
                };

            params['responsive'][breakpoints['medium']] = {
                items: 2,
            };
            params['responsive'][breakpoints['large']] = {
                items: 3,
            };
            params['responsive'][breakpoints['xxlarge']] = {
                items: 4,
                nav: true,
                dots: false,
            };
            switch (itemLength) {
                case 1:
                case 2:
                    params['loop'] = false;
                    params['dots'] = false;
                case 4:
                    params['responsive'][breakpoints['xxlarge']]['nav'] = false;
                    break;
            }
            $self.owlCarousel(params);
        });
    }
}

function removeOwlItem($self){
    var $owlCarousel = $self.closest('.owl-carousel'),
        $item = $self.closest('.owl-item'),
        index = $item.index();

    $item.find('.product-pack-change').toggleClass('remove add');
    var item = $item.html();
    $owlCarousel.trigger('remove.owl.carousel', index);
    $owlCarousel.trigger('refresh.owl.carousel');
    $owlCarousel.trigger('next.owl.carousel');
    return item;
}

function setPackVariation(target) {
    var $parentSet = target.parents('.set_group_block'),
        $mobileButton = $parentSet.find('.product-pack-mobile-button');
    $parentSet.find('.product-pack').removeClass('edit');
    $parentSet.find('.product-pack-caption.apply').hide();
    $mobileButton.children('.product-pack-set-variation').css('display','none');
    $mobileButton.children('.product-pack-get-variation').show();
    $parentSet.find('.product-pack-caption.change').show();
    $parentSet.find('.product-pack-variation').slideUp();
}

$(document).ready(function() {
    $(document).foundation();

    /*
    //Старый способ вывод карточек товара
    var $productGrid = $('.products-flex-grid').isotope(productGridOptions);
    */

    var windowWidth = $(window).width(),
        foundationScreenOld = Foundation.MediaQuery.current,
        slideout = new Slideout({
            'panel': document.getElementById('page'),
            'menu': document.getElementById('mobile-menu'),
            'padding': 260,
            'tolerance': 70
        }),
        scrTop = 0,
        $scrollUpDown = $(".scroll-up-down"),
        $cookie = $('.cookie'),
        $page = $('#page'),
        $mobileMenu = $('#mobile-menu'),
        $headerMenu = $('.header-main-menu'),
       /* $headerMenuFixed = $('.header-menu-fixed'),*/
        $headerMobileFixed = $('.header-mobile-fixed'),
        $headerMenuWrap = $('#header-main-menu-wrap');
    window['var'] = {
        menuOffsetTop: 0,
        menuScrollTop: 0,
        /*menuPositionTop: $headerMenuFixed.position().top,*/
        /*menuHeight: $headerMenuFixed.outerHeight(),*/
        isMenuFixed: $page.hasClass('menu-fixed')
    };
    window['func'] = {};
    window['colors'] = {
        primary: '#264f85',
        secondary: '#d8192b'
    };
    
    initOwl();
    
    //Все, что связано с шаблоном
    if ($.inArray(foundationScreenOld, ['xlarge', 'xxlarge']) !== -1) {
        slideout.disableTouch();
    }
    
    $scrollUpDown.css('marginBottom', ($cookie.is(':visible') ? $cookie.outerHeight() : 0));
    
    initCatalogSelect();
    initSelect('select');
    $('input.phone').inputmask('+7 (999) 999-9999');
    $('input.zip').inputmask({"mask": "999 999", "removeMaskOnSubmit" : 1});
    $('.fancybox:not([disabled],.disabled)').fancybox({
        padding: 0
    });
    
    $(document).on('click', '.fancybox-cancel', function(e){
        $.fancybox.close();
        e.preventDefault();
    });
    
    $(document).on('click', '.preview-button', function(e){
        var $self = $(this);
        $.fancybox({
            type: 'ajax',
            href: $self.attr('data-href'),
            padding: 0
        });
        e.preventDefault();
    });
    
    $(document).on('click', '.show-href', function(e){
        var $self = $(this);
        $self.closest('.fancybox-block').hide();
        $($self.attr('href')).show();
        e.preventDefault();
    });
    
    $(document).click(function(e){
        var $dropdown = $('.dropdown-custom.is-open');
    
        if ($dropdown.length && !$dropdown.has(e.target).length) {
            $dropdown.removeClass('is-open');
        }
    });
    
/*    function mainMenuArrowPosition(){
        var $menu = $('.header-main-menu-other'),
            left = $menu.offset().left,
            width = $menu.width();
        $('.header-main-menu-other .header-main-menu-dropdown-arrow').css({'left': left + width/2 - 10});
    }*/
    
    function hsMainMenuItems(action) {
        if ($headerMenu.is(':visible')) {
            var $menuBlock = $('.header-main-menu-block'),
                $menuBase = $('.header-main-menu-base'),
                $menuFull = $('#header-main-menu-full'),
                $menuFullCont = $menuFull.find('.container'),
                $menuOther = $('.header-main-menu-other'),
                $mainSlider = $('.main-slider'),
                maxWidth = parseInt($menuBlock.css('maxWidth')),
                maxHeight = (($mainSlider.length) ? $mainSlider.height() + 20 : 450) - 45,
                baseWidth = $menuBase.width() - 16,
                baseHeight = $menuBase.height(),
                isVertical = ($headerMenu.parent('.header-main-menu-dropdow-wrap').length);
    
            function hideMainMenuItems(){
                if ($menuOther.hasClass('hide')) {
                    $menuOther.removeClass('hide');
                }
                var $replaceItem = $menuBase.find('.header-main-menu-category:last-child');
                if ($replaceItem.length) {
                    $menuFullCont.prepend($replaceItem);
                    hsMainMenuItems('hide');
                }
            }
            function showMainMenuItems(){
                var $replaceItem = $menuFullCont.find('.header-main-menu-category:first-child');
                if ($replaceItem.length) {
                    $menuBase.append($replaceItem);
                    hsMainMenuItems('show');
                }
            }
    
            if (action === 'hide') {
                if (isVertical) {
                    if (baseHeight > maxHeight) {
                        hideMainMenuItems();
                        $menuFull.on('closeme.zf.dropdown', function(){
                            return false;
                        });
                    }
                } else {
                    if (baseWidth > maxWidth) {
                        hideMainMenuItems();
                    }
                }
            }
            if (action === 'show') {
                if (isVertical) {
                    if (baseHeight <= maxHeight) {
                        showMainMenuItems();
                    } else {
                        hsMainMenuItems('hide');
                    }
                } else {
                    if (baseWidth <= maxWidth) {
                        showMainMenuItems();
                    } else {
                        hsMainMenuItems('hide');
                    }
                }
            }
            mainMenuArrowPosition();
        }
    }
    
    window.func.headerFixed = function(){
        var top = '';
    
        if ($.inArray(foundationScreenOld, ['xlarge', 'xxlarge']) !== -1) {
            if (scrTop > window.var.menuPositionTop + window.var.menuScrollTop) {
                $/*headerMenuFixed.css('top', window.var.menuOffsetTop);*/
                $page.addClass('is-fixed');
            } else {
                /*$headerMenuFixed.css('top', 0);*/
                $page.removeClass('is-fixed');
            }
        }
        if ($.inArray(foundationScreenOld, ['small', 'medium', 'large']) !== -1) {
            $page.addClass('is-fixed');
            /*$headerMenuFixed.css('top', top);*/
            if (window.var.menuScrollTop) {
                top = (scrTop > window.var.menuScrollTop) ? 0 : window.var.menuScrollTop - scrTop;
            }
        }
        $headerMobileFixed.css('top', top);
    };
    
    if (window.var.isMenuFixed) {
        window.func.headerFixed();
        slideout.on('beforeopen', function(){
            $headerMobileFixed.css('top', (scrTop > window.var.menuScrollTop) ? scrTop - window.var.menuScrollTop : 0);
        });
        slideout.on('close', function(){
            $headerMobileFixed.css('top', (window.var.menuScrollTop) ? ((scrTop > window.var.menuScrollTop) ? 0 : window.var.menuScrollTop - scrTop) : '');
        });
        if (window.BX !== undefined && BX.admin !== undefined) {
            var BxPanel,
                headerFixedBX = function () {
                    var bxPanelHeight = BxPanel.DIV.clientHeight,
                        mobileTop = 0;
    
                    if (BxPanel.isFixed()) {
                        window.var.menuOffsetTop = bxPanelHeight;
                        window.var.menuScrollTop = 0;
                        mobileTop += bxPanelHeight;
                    } else {
                        window.var.menuOffsetTop = 0;
                        window.var.menuScrollTop = bxPanelHeight;
                        mobileTop = (scrTop >= bxPanelHeight) ? 0 : bxPanelHeight - scrTop;
                    }
                    $mobileMenu.css({
                        top: mobileTop,
                        height: window.innerHeight - mobileTop
                    });
                    window.func.headerFixed();
                };
    
            BX.ready(function () {
                BxPanel = BX.admin.panel;
                BX.addCustomEvent('onTopPanelCollapse', BX.delegate(headerFixedBX, this));
                BX.addCustomEvent('onTopPanelFix', BX.delegate(headerFixedBX, this));
                headerFixedBX();
            });
        }
    }
    
    /*hsMainMenuItems('hide');*/
    
    function hideCustomMenu()
    {
        var $cMenu = $('#custom-menu');
        if ($cMenu.length) {
            var $toggle = $cMenu.find('.toggle');
    
            $cMenu.removeClass('active');
            if ( $toggle.attr('data-toggle') !== undefined) {
                $toggle.foundation('hide');
            }
        }
    }
    
    function menuFilterToggle(inMobile)
    {
        $('#catalog-filter').appendTo((inMobile) ? $mobileMenu : $('#catalog-filter-wrapper'));
        $mobileMenu.find('.mobile-menu-wrapper').toggleClass('hide');
        $('html').toggleClass('slideout-filter');
    }
    
    function menuFilterToggleOnce()
    {
        menuFilterToggle(true);
        slideout.open();
        slideout.once('close', function(){
            menuFilterToggle();
        });
    }
    
    $('.header-mobile-toggle').on('click', function() {
        hideCustomMenu();
        if (slideout.isOpen() && $('html').hasClass('slideout-filter')) {
            slideout.close();
            slideout.once('close', function(){
                slideout.open();
            });
        } else {
            slideout.toggle();
        }
    });
    
    $(document).on('click', '.filter-mobile-toggle', function(e){
        hideCustomMenu();
        if (slideout.isOpen()) {
            if ($('html').hasClass('slideout-filter')) {
                slideout.close();
            } else {
                slideout.close();
                slideout.once('close', function(){
                    menuFilterToggleOnce();
                });
            }
        } else {
            menuFilterToggleOnce();
            initSlider();
        }
        e.preventDefault();
    });
    
    $(document).on('open.zf.drilldown', function(){
        $mobileMenu.animate({scrollTop: 0}, 200);
    });
    
    $scrollUpDown.click(function(e){
        $("body,html").animate({scrollTop: 0}, 200);
        e.preventDefault();
    });
    
    $cookie.click(function(e){
        $scrollUpDown.css('marginBottom', 0);
        e.preventDefault();
    });
    
    $(window).resize(function() {
        var windowWidthNew = $(this).width(),
            foundationScreenNew = Foundation.MediaQuery.current;
        if (windowWidthNew > windowWidth) {
            hsMainMenuItems('show');
        }
        if (windowWidthNew < windowWidth) {
            hsMainMenuItems('hide');
        }
        if (foundationScreenOld !== foundationScreenNew) {
            if (($.inArray(foundationScreenOld, ['small', 'medium', 'large']) !== -1)
                && ($.inArray(foundationScreenNew, ['xlarge', 'xxlarge']) !== -1)) {
                if (slideout.isOpen()) {
                    slideout.close();
                }
                slideout.disableTouch();
            }
            if (($.inArray(foundationScreenNew, ['small', 'medium', 'large']) !== -1)
                && ($.inArray(foundationScreenOld, ['xlarge', 'xxlarge']) !== -1)) {
                if ($page.hasClass('is-fixed')) {
                    $page.removeClass('is-fixed');
                }
                slideout.enableTouch();
            }
            foundationScreenOld = foundationScreenNew;
            if (window.var.isMenuFixed) {
                $page.removeClass('is-fixed');
                /*window.var.menuHeight = $headerMenuFixed.outerHeight();*/
                /*window.var.menuPositionTop = $headerMenuFixed.position().top;*/
                if (headerFixedBX !== undefined) {
                    headerFixedBX();
                } else {
                    window.func.headerFixed();
                }
            }
            $scrollUpDown.css('marginBottom', ($cookie.is(':visible') ? $cookie.outerHeight() : 0));
        }
        windowWidth = windowWidthNew;
    
        $('.tracker').data('largeimage', false);
        checkAccordionTabs(foundationScreenNew);
    });
    
    $(window).scroll(function() {
        scrTop = window.pageYOffset;
        if (scrTop > 250) {
            $scrollUpDown.fadeIn();
        } else {
            $scrollUpDown.fadeOut();
        }
        if (window.var.isMenuFixed) {
            if (headerFixedBX !== undefined) {
                headerFixedBX();
            } else {
                window.func.headerFixed();
            }
        }
    });
    
    //Позиционирование блоков в ЛК
    
    $('.profile-column-container').isotope(profileGridOptions);
    $('.b-blocks-container').isotope(profileGridOptions2);

    //Сетка продуктов на главной
    
    $('.main-product-tabs .tabs').on('change.zf.tabs', function(e, $tab) {
        var index = $tab.index();
    
        $tab.closest('.main-product-tabs').find('.select-tabs option').eq(index).prop('selected', true).trigger('refresh');
        $productGrid.isotope();
    });
    
    $(document).on('change', '.main-product-tabs select.select-tabs', function(){
        var target = $(this).find('option:selected').val();
        $('.main-product-tabs .tabs').foundation('selectTab', $(target));
    });
    
    // Сворачивание блоков в блоке Фильтров в Каталоге
    $('.catalog-filters__block .heading').click(function (e) {
        e.preventDefault();
        $(this).parents('.catalog-filters__block').toggleClass('showed').find('.body').slideToggle();
        if (!$(this).hasClass('showed')) {
            initSlider();
        }
    });
    
    $(document).on('click', '.breadcrumbs a[data-toggle]', function(e){
        var $self = $(this);
    
        if (($.inArray(foundationScreenOld, ['small', 'medium', 'large']) !== -1)) {
            if (!$self.hasClass('visited')) {
                $self.addClass('visited');
                e.preventDefault();
            }
        }
    });
    
    $('.product-breadcrumbs-dropdown').on('hide.zf.dropdown', function(e, $handle){
        $('a[data-toggle="' + $handle.attr('id') + '"]').removeClass('visited');
    });
    
    /*$('#catalog-filter .slider').on('changed.zf.slider', function(e, $handle){
        var $target = $(e.target),
            changed = $target.data('changed');

        if (changed > 0) {
            fadeFilterLoading($('#' + $handle.attr('aria-controls')));
        }
        $target.data('changed', changed + 1);
    });*/

    $('body').on('click', function(e){
        var $target = $(e.target),
            $filterTip = $('.filter-tip');

        if (!$target.closest('.filter-tip').length && $filterTip.length) {
            $filterTip.hide();
        }
    });
    
    //Все, что связано с карточкой товара
    
    initProductPreviewZoom();
    
    initTimer();
    
    initSlider();
    
    if ($("#page").hasClass("page-lazy")) {
        setTimeout (function() {
            initLazyLoad();
        }, 500);
    }
    
    $(document).on('click', '.product-preview-zoom', function(e){
        var previews = [],
            activeIndex = 0;
        $('.product-slider:visible .item').each(function(){
            var $self = $(this);
            previews.push($self.attr('href'));
            if ($self.hasClass('active')) {
                activeIndex = $self.parent().index();
            }
        });
        $.fancybox(previews, {
            index: activeIndex,
            helpers    : {
                thumbs    : {
                    width    : 61,
                    height    : 61
                }
            }
        });
        e.preventDefault();
    });
    
    $(document).on('click', '.product-slider .item', function(e){
        var $self = $(this);
        if (!$self.hasClass('active')) {
            $self.parents('.product-preview').find('.product-slider .item').removeClass('active');
            $self.parents('.product-preview').find('.product-preview-main img').attr('src', $self.attr('href'));
            $self.addClass('active');
        }
        e.preventDefault();
    });
    
    $(document).on('click', '.product-info-social a', function(e){
        $('.' + $(this).attr('href')).click();
        e.preventDefault();
    });
    
    //Все, что связано с блоком "Набор"
    
    $(document).on('click', '.product-pack-get-variation', function(e){
        var $parentSet = $(this).parents('.set_group_block'),
            $variation = $parentSet.find('.product-pack-variation'),
            $carouselVariation = $parentSet.find('.product-carousel'),
            $mobileButton = $parentSet.find('.product-pack-mobile-button');

        $parentSet.find('.product-pack').addClass('edit');
        $parentSet.find('.product-pack-caption.change').hide();
        $mobileButton.children('.product-pack-get-variation').hide();
        $mobileButton.children('.product-pack-set-variation').css('display','inline-block');
        $parentSet.find('.product-pack-caption.apply').show();
        if ($carouselVariation.data('owl.carousel') !== undefined) {
            if ($carouselVariation.data('owl.carousel')._items.length > 0) {
                $variation.slideDown();
            }
        }

        e.preventDefault();
    });
    
    $(document).on('click', '.product-pack-set-variation', function(e){
        setPackVariation($(this));
        e.preventDefault();
    });
    
    //Синхронизация Аккардиона и Табов
    
    function checkAccordionTabs(foundationScreen){
        var $content = $('.product-accordion-tabs-content'),
            $items   = $('.product-accordion-tabs-item'),
            $wraps   = $('.product-accordion-tabs-wrap');
    
        if ($.inArray(foundationScreen, ['small', 'medium', 'large']) != -1) {
            if ($content.hasClass('tabs-content')) {
                $content.removeClass('tabs-content').addClass('accordion').attr('data-accordion');
                $items.addClass('accordion-item').removeClass('tabs-panel');
                $wraps.addClass('accordion-content').hide();
                $items.filter('.is-active').children('.product-accordion-tabs-wrap').show();
            }
        } else {
            if ($content.hasClass('accordion')) {
                $content.removeAttr('data-accordion').removeClass('accordion').addClass('tabs-content');
                $items.removeClass('accordion-item').addClass('tabs-panel');
                $wraps.removeClass('accordion-content').show();
            }
        }
    }
    
    checkAccordionTabs(foundationScreenOld);
    
    $(document).on('click', '.product-accordion-tabs .accordion-title', function(){
        var $self = $(this),
            $tabsTitle  = $('.product-accordion-tabs .tabs-title'),
            $activeLink = $tabsTitle.children('a[href="#' + $self.attr('id') + '"]');
        $tabsTitle.removeClass('is-active');
        $tabsTitle.children().removeAttr('aria-selected');
        $activeLink.attr('aria-selected', 'true');
        $activeLink.parent().addClass('is-active');
        setTimeout(function(){
            $("body,html").animate({scrollTop: $self.offset().top}, 200);
        }, 250);
    });

});