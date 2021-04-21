function showPicker(e){
    var $target = $(e.target),
        $parent = $target.parent(),
        $picker = $($target.data('colorpicker').picker[0]),
        targetPos = $target.position(),
        parentPos = $parent.position();

    $picker.css({
        top: parentPos.top + ($parent.hasClass('checked') ? 4 : 0) + $target.outerHeight(),
        left: parentPos.left + 17 + targetPos.left
    });
    $('.colorpicker-icon').removeClass('checked');
}
function hidePicker($primary, $secondary, $target){
    $target.addClass('change');

    if ($primary.hasClass('change') && $secondary.hasClass('change')) {
        $('.colorpicker-icon').addClass('checked');
        $('.radio-color input[type="radio"]').prop('checked', false);
        applyChange();
    }
}

function applyChange(){
    $.fancybox.helpers.overlay.open({
        closeClick: false,
        parent: $('body')
    });
    $.fancybox.showLoading();
}

function showCustomTooltip(){
    setTimeout(function(){
        if ($('html').hasClass('slideout-open')) {
            showCustomTooltip();
        } else {
            var $toggle = $('#custom-menu .toggle');
            if ($toggle.attr('data-toggle') !== undefined) {
                $toggle.foundation('show');
            }
        }
    }, 3000);
}

$(document).ready(function(){
    if ($("#custom-menu").length > 0) {
        showCustomTooltip();

        var $customMenu = $('#custom-menu'),
            $tooltip = $('.tooltip-fixed'),
            BxPanel,
            customCalc = function(){
                var panelTop = 0,
                    offsetTop = 0,
                    bxPanelHeight = 0,
                    pageYOffset = window.pageYOffset,
                    headerHeight = $('header').innerHeight(),
                    foundationScreen = Foundation.MediaQuery.current;

                if (BxPanel !== undefined) {
                    bxPanelHeight = BxPanel.DIV.clientHeight;
                    offsetTop += bxPanelHeight;

                    if (pageYOffset >= offsetTop && BxPanel.isFixed() === false) {
                        panelTop += 0;
                    } else if (BxPanel.isFixed() === true) {
                        panelTop += bxPanelHeight;
                    } else {
                        panelTop = panelTop + bxPanelHeight - pageYOffset;
                    }
                }
                if ($.inArray(foundationScreen, ['small', 'medium', 'large']) !== -1) {
                    if (window.var.isMenuFixed) {
                        panelTop += headerHeight;
                    } else {
                        offsetTop += headerHeight;
                        if (offsetTop >= pageYOffset) {
                            panelTop = offsetTop - pageYOffset;
                        }
                    }
                }
                if (window.var.isMenuFixed) {
                    if ($.inArray(foundationScreen, ['xlarge', 'xxlarge']) !== -1) {
                        if (pageYOffset > window.var.menuPositionTop) {
                            panelTop += window.var.menuHeight;
                        }
                    }
                }
                $customMenu.css({
                    top: panelTop,
                    height: window.innerHeight - panelTop
                });
                $tooltip.css({top: panelTop + 5.5});
            };
        window.onscroll = customCalc;
        window.onresize = customCalc;
        if (window.BX !== undefined) {
            BX.ready(function(){
                if (BX.admin !== undefined) {
                    BxPanel = BX.admin.panel;
                }
                BX.addCustomEvent('onTopPanelCollapse',BX.delegate(customCalc,this));
                BX.addCustomEvent('onTopPanelFix',BX.delegate(customCalc,this));
            });
        }
        setTimeout(customCalc, 100);
    }

    $(document).on('click', '#custom-menu .toggle', function(){
        var $self = $(this);

        if ($self.attr('data-toggle') !== undefined) {
            $(this).foundation('hide');
        }
        $('#custom-menu').toggleClass('active').promise().done(function(){
            if (customCalc !== undefined) {
                customCalc();
            }
        });
    });

    $('#custom-menu .toggle').on('hide.zf.tooltip', function(){
        $(this).foundation('destroy');
    });

    $(document).on('change', '.custom-option:not(.jq-selectbox)', function(){
        window.location.href = $(this).val();
        applyChange();
    });
});